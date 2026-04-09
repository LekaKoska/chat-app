<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\User;
use App\Traits\OwnsResource;

class CommentPolicy
{
    use OwnsResource;

    public function update(User $user, Comment $comment): bool
    {
        return $this->isOwner($user, $comment);
    }

    public function delete(User $user, Comment $comment): bool
    {
        return $this->isOwner($user, $comment);
    }
}
