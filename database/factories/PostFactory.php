<?php

namespace Database\Factories;

use App\Enums\PostStatus;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
class PostFactory extends Factory
{
    public function definition(): array
    {
        return [
            'content' => fake()->realText(30),
            'status' => PostStatus::Published
        ];
    }
}
