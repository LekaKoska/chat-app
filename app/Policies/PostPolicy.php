<?php

namespace App\Policies;

use App\Enums\PostStatus;
use App\Models\Post;
use App\Models\User;

class PostPolicy
{
    public function new(User $user): bool
    {
        return true;
    }
    public function update(User $user, Post $post): bool
    {
        return $user->id === $post->user_id;
    }
    public function view(User $user, Post $post): bool
    {
        return $post->status === PostStatus::Published;
    }
}
