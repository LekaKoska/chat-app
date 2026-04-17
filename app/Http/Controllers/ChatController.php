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
}
