<?php

namespace App\Policies;

use App\Enums\PostStatus;
use App\Models\Post;
use App\Models\User;
use App\Traits\OwnsResource;

class PostPolicy
{
    use OwnsResource;

    public function new(User $user): bool
    {
        return true;
    }

    public function update(User $user, Post $post): bool
    {
        return $this->isOwner($user, $post);
    }

    public function view(User $user, Post $post): bool
    {
        return $post->status === PostStatus::Published;
    }

    public function delete(User $user, Post $post): bool
    {
        return $this->isOwner($user, $post);
    }
}
