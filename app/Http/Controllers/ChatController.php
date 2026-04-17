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
        // Provjeri da receiver postoji
        $receiver = User::findOrFail($receiverId);

        // Dohvati sve poruke između dva korisnika
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
        // Dohvati sve konverzacije za trenutnog korisnika
        $conversations = Message::where(function ($query) {
            $query->where('sender_id', Auth::id())
                  ->orWhere('receiver_id', Auth::id());
        })
        ->selectRaw('(CASE WHEN sender_id = ? THEN receiver_id ELSE sender_id END) as participant_id', [Auth::id()])
        ->distinct('participant_id')
        ->latest('created_at')
        ->get();

        // Za svaki participant, dohvati podatke i posljednju poruku
        $chats = collect([]);
        foreach ($conversations as $conv) {
            $participant = User::find($conv->participant_id);
            if (!$participant) continue;

            $lastMessage = Message::where(function ($query) use ($conv) {
                $query->where('sender_id', Auth::id())
                      ->where('receiver_id', $conv->participant_id);
            })->orWhere(function ($query) use ($conv) {
                $query->where('sender_id', $conv->participant_id)
                      ->where('receiver_id', Auth::id());
            })->latest('created_at')->first();

            $chats->push([
                'user' => $participant,
                'lastMessage' => $lastMessage,
                'unreadCount' => Message::where('sender_id', $conv->participant_id)
                    ->where('receiver_id', Auth::id())
                    ->where('read', false)
                    ->count()
            ]);
        }

        return view('chat-history', ['chats' => $chats]);
    }
}
