<?php

namespace App\Notifications;

use App\Models\Message;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Queue\SerializesModels;

class NewMessage extends Notification implements ShouldQueue
{
    use Queueable, SerializesModels;
    protected Message $message;
    public function __construct(Message $message)
    {
        $this->message = $message;
    }

    public function via(object $notifiable): array
    {
        return ['database', 'broadcast'];
    }

    public function toArray(object $notifiable): array
    {
        $sender = $this->message->sender()->select('id', 'name', 'avatar')->first();

        return [
            'type' => 'new_message',
            'notification' => ($sender?->name ?: 'User') . ' sent you a message',
            'url' => route('chat.form', $this->message->sender_id),
            'sender' => [
                'id' => $sender?->id ?? $this->message->sender_id,
                'name' => $sender?->name ?? null,
                'avatar' => $sender?->avatar ?? null,
            ],
            'message' => [
                'id' => $this->message->id,
                'text' => $this->message->message,
            ],
        ];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage($this->toArray($notifiable));
    }
}
