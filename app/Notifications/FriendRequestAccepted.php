<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class FriendRequestAccepted extends Notification
{
    use Queueable;

    protected User $accepter;

    public function __construct(User $accepter)
    {
        $this->accepter = $accepter;
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'type' => 'friend_request_accepted',
            'notification' => "{$this->accepter->name} accepted your friend request",
            'url' => route('friends.request.index'),
            'sender' => [
                'id' => $this->accepter->id,
                'name' => $this->accepter->name,
                'avatar' => $this->accepter->avatar ?? null,
            ]
        ];
    }
}
