<?php

namespace App\Notifications;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Queue\SerializesModels;

class PostCommented extends Notification implements ShouldQueue
{
    use Queueable, SerializesModels;

    protected Comment $comment;
    protected User $sender;
    public function __construct(Comment $comment, User $sender)
    {
        $this->comment = $comment;
        $this->sender = $sender;
    }
    public function via(object $notifiable): array
    {
        return ['database'];
    }
    public function toDatabase(object $notifiable): array
    {
        return [
            'type' => 'post_commented',
            'notification' => "{$this->sender->name} commented your post",
            'url' => route('posts.show', $this->comment->post_id),
            'sender' => [
                'id' => $this->sender->id,
                'name' => $this->sender->name,
                'avatar' => $this->sender->avatar ?? null,
            ],
        ];
    }
}
