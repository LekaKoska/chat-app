<?php

namespace App\Providers;

use App\Models\FriendConnectionModel;
use App\Models\Post;
use App\Policies\FriendshipPolicy;
use App\Policies\PostPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as BaseAuthServiceProvider;

class AuthServiceProvider extends BaseAuthServiceProvider
{
    protected $policies = [
        FriendConnectionModel::class => FriendshipPolicy::class,
        Post::class => PostPolicy::class,
    ];
    public function boot(): void
    {
        $this->registerPolicies();
    }
}
