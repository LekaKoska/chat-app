<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Queue\SerializesModels;

class FriendRequest extends Notification implements ShouldQueue
{
    use Queueable, SerializesModels;

    protected User $sender;
    public function __construct(User $user)
    {
        $this->sender = $user;
    }
    public function via(object $notifiable): array
    {
        return ['database'];
    }
    public function toDatabase(object $notifiable): array
    {
        return [
            'type' => 'friend_request',
            'notification' => "{$this->sender->name} send friend request",
            'url' => route('friends.request.incoming'),
            'sender' => [
                'id' => $this->sender->id,
                'name' => $this->sender->name,
                'avatar' => $this->user->avatar ?? null,
            ]
        ];
    }
}
