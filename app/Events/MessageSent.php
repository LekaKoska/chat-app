<?php

namespace App\Events;

use App\Models\Message;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public Message $message;

    public function __construct(Message $message)
    {
        $this->message = $message;
    }

    public function broadcastOn(): array
    {
        // Kreiraj kanal za oba korisnika (sender i receiver)
        $senderId = $this->message->sender_id;
        $receiverId = $this->message->receiver_id;

        // Koristi istu vrijednost kanala za oba korisnika da budu na istom kanalu
        $channelId = 'chat.' . min($senderId, $receiverId) . '.' . max($senderId, $receiverId);

        return [
            new PrivateChannel($channelId),
        ];
    }
}
