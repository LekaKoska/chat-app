<?php

namespace App\Notifications;

use App\Models\User;
use App\Models\Vote;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Queue\SerializesModels;

class Voting extends Notification implements ShouldQueue
{
    use Queueable, SerializesModels;
    protected User $user;
    protected Vote $vote;

    public function __construct(User $user, Vote $vote)
    {
        $this->user = $user;
        $this->vote = $vote;
    }
    public function via(object $notifiable): array
    {
        return ['database'];
    }
    public function toDatabase(object $notifiable): array
    {
        return [
            'type' => 'post_voted',
            'notification' => "{$this->user->name} voted your post",
            'url' => route('posts.show', $this->vote->post->id),
            'sender' => [
                'id' => $this->user->id,
                'name' => $this->user->name,
                'avatar' => $this->user->avatar ?? null,
                ]
            ];
    }
}
