<?php

namespace App\Policies;

use App\Models\FriendConnectionModel;
use App\Models\User;

class FriendshipPolicy
{
    public function handleRequest(User $user, FriendConnectionModel $friendship): bool
    {
        return $friendship->receiver_id === $user->id;
    }
}
