<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Http\Requests\MessageRequest;
use App\Models\Message;
use App\Models\User;
use App\Notifications\NewMessage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ChatController extends Controller
{
    public function index(int $receiverId): View
    {
        return view('chat', ['receiverId' => $receiverId]);
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
