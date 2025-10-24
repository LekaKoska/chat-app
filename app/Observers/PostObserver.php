<?php

namespace App\Observers;

use App\Enums\PostStatus;
use App\Mail\PostPublishedMail;
use App\Models\Post;
use Illuminate\Support\Facades\Mail;

class PostObserver
{
    public function updated(Post $post): void
    {
        if ($post->wasChanged('status') && $post->status === PostStatus::Published) {
            Mail::to(users: $post->ownerOfPosts->email)->send(new PostPublishedMail(post: $post));
        }
    }
}
