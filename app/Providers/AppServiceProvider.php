<?php

namespace App\Providers;

use App\Models\Comment;
use App\Models\FriendConnectionModel;
use App\Models\Post;
use App\Models\Vote;
use App\Observers\CommentObserver;
use App\Observers\FriendRequestObserver;
use App\Observers\PostObserver;
use App\Observers\VoteObserver;
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
      Vote::observe(classes: VoteObserver::class);
      FriendConnectionModel::observe(classes: FriendRequestObserver::class);
    }
}
