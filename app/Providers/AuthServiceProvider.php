<?php

namespace App\Providers;

use App\Models\FriendConnectionModel;
use App\Policies\FriendshipPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        FriendConnectionModel::class => FriendshipPolicy::class,
    ];
    public function boot(): void
    {
        Gate::policy(FriendConnectionModel::class, FriendshipPolicy::class);
    }
}
