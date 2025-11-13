<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class NewSubscriber extends Notification implements ShouldQueue
{
    use Queueable;

    protected User $subscriber;

    public function __construct(User $subscriber)
    {
        $this->subscriber = $subscriber;
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'type' => 'new_subscriber',
            'notification' => "{$this->subscriber->name} subscribed to your profile",
            'url' => route('profile.info', $this->subscriber->name),
            'sender' => [
                'id' => $this->subscriber->id,
                'name' => $this->subscriber->name,
                'avatar' => $this->subscriber->avatar ?? null,
            ]
        ];
    }
}
