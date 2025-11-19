<?php

namespace App\Observers;

use App\Models\Comment;
use App\Notifications\PostCommented;
use Illuminate\Support\Facades\Cache;

class CommentObserver
{
    public function created(Comment $comment): void
    {
        Cache::tags(["post:{$comment->post_id}"])->flush();
        $postOwner = $comment->posts->ownerOfPost;

        if ($postOwner->id !== $comment->user_id) {
            $postOwner->notify(new PostCommented(comment: $comment, sender: $comment->user));
        }
    }
}
