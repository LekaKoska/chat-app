<?php

namespace App\Providers;

use App\Models\Comment;
use App\Models\Post;
use App\Observers\CommentObserver;
use App\Observers\PostObserver;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        Schema::defaultStringLength(191);
    }
    public function boot(): void
    {
      Post::observe(classes: PostObserver::class);
      Comment::observe(classes: CommentObserver::class);
    }
}
