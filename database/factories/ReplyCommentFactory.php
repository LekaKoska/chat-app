<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
class ReplyCommentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'reply_comment' => fake()->sentence()
        ];
    }
}
