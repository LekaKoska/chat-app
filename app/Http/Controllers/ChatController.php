<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Http\Requests\MessageRequest;
use App\Models\Message;
use App\Models\User;
use App\Notifications\NewMessage;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ChatController extends Controller
{
    public function index(int $receiverId): View
    {

        $receiver = User::findOrFail($receiverId);


        $messages = Message::where(function ($query) use ($receiverId) {
            $query->where('sender_id', Auth::id())
                  ->where('receiver_id', $receiverId);
        })->orWhere(function ($query) use ($receiverId) {
            $query->where('sender_id', $receiverId)
                  ->where('receiver_id', Auth::id());
        })->orderBy('created_at', 'asc')->get();

        return view('chat', [
            'receiverId' => $receiverId,
            'receiver' => $receiver,
            'messages' => $messages
        ]);
    }

    public function sendMessage(MessageRequest $request): JsonResponse
    {
        $message = Message::create(array_merge(
            $request->validated(),
            ['sender_id' => Auth::id()]));
        broadcast(new MessageSent($message))->toOthers();

        $receiver = User::find($request->receiver_id);
        $receiver->notify(new NewMessage($message));
        return response()->json($message);
    }

    public function conversations(): View
    {

        $messages = Message::where(function ($query) {
            $query->where('sender_id', Auth::id())
                  ->orWhere('receiver_id', Auth::id());
        })
        ->latest('created_at')
        ->get();

        $participantMap = [];
        foreach ($messages as $msg) {
            $participantId = $msg->sender_id === Auth::id() ? $msg->receiver_id : $msg->sender_id;

            if (!isset($participantMap[$participantId])) {
                $participantMap[$participantId] = $msg;
            }
        }

        usort($participantMap, function ($a, $b) {
            return $b->created_at->timestamp - $a->created_at->timestamp;
        });

        $chats = collect([]);
        foreach ($participantMap as $participantId => $lastMsg) {
            $participant = User::find($participantId);
            if (!$participant) continue;

            $unreadCount = Message::where('sender_id', $participantId)
                ->where('receiver_id', Auth::id())
                ->where('read', false)
                ->count();

            $chats->push([
                'user' => $participant,
                'lastMessage' => $lastMsg,
                'unreadCount' => $unreadCount
            ]);
        }

        return view('chat-history', ['chats' => $chats]);
    }
}
