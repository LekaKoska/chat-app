<?php

namespace App\Policies;

use App\Models\ReplyComment;
use App\Models\User;
use App\Traits\OwnsResource;

class ReplyPolicy
{
    use OwnsResource;

    public function update(User $user, ReplyComment $replyComment): bool
    {
        return $this->isOwner($user, $replyComment);
    }

    public function delete(User $user, ReplyComment $comment): bool
    {
        return $this->isOwner($user, $comment);
    }
}
