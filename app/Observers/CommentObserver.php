<?php

namespace App\Observers;

use App\Models\Comment;
use App\Notifications\PostCommented;

class CommentObserver
{
    public function created(Comment $comment): void
    {
        $postOwner =  $comment->posts->ownerOfPosts;

        if($postOwner->id !== $comment->user_id)
        {
            $postOwner->notify(new PostCommented(comment: $comment, sender: $comment->user));
        }
    }
}
