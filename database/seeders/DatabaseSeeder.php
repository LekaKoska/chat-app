<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use App\Models\ReplyComment;
use App\Models\User;
use App\Models\Vote;
use Database\Factories\CommentFactory;
use Illuminate\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::factory()->count(5)->create();
        $users->each(function ($user) {
            Post::factory()->count(5)->create([
                'user_id' => $user->id
            ]);
        });

        Post::all()->each(function ($post) use ($users) {
            Comment::factory()->count(1)->create([
                'post_id' => $post->id,
                'user_id' => $users->random()->id,
            ]);
        });

        Comment::all()->each(function ($comment) use ($users) {
            ReplyComment::factory()->count(1)->create([
                'comment_id' => $comment->id,
                'user_id' => $users->random()->id,
            ]);
        });
        Post::all()->each(function ($post) use ($users) {
            $users->random(rand(1, 4))->each(function ($user) use ($post) {
                Vote::factory()->create([
                    'post_id' => $post->id,
                    'user_id' => $user->id,
                    'vote' => fake()->randomElement([-1, 1]),
                ]);
            });
        });

    }
}
