<?php

namespace App\Observers;

use App\Enums\PostStatus;
use App\Mail\PostPublishedMail;
use App\Mail\PostPublishedToSubscriberMail;
use App\Models\Post;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;

class PostObserver
{
    private function clearCache(): void
    {
        Cache::tags(['posts'])->flush();
    }
    public function created(Post $post): void
    {
        $this->clearCache();
    }
    public function updated(Post $post): void
    {
        $this->clearCache();
        if ($post->wasChanged('status') && $post->status === PostStatus::Published) {

            Mail::to(users: $post->ownerOfPost->email)->send(new PostPublishedMail(post: $post));

            $author = $post->ownerOfPost;

            if ($author->followers) {
                $delay = 5;
                foreach ($author->followers as $subscriber) {
                    Mail::to($subscriber->email)
                        ->later(now()->addSeconds($delay), new PostPublishedToSubscriberMail($post));
                    $delay++;
                }
            }
        }
    }
    public function deleted(): void
    {
        $this->clearCache();
    }
}
