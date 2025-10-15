<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;

class PostPolicy
{
    public function newPost(User $user): bool
    {
        return true;
    }
}
