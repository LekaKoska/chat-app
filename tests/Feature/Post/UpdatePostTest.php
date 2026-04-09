<?php

namespace Tests\Feature\Post;

use App\Enums\PostStatus;
use App\Models\User;
use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;

use Tests\TestCase;

class UpdatePostTest extends TestCase
{
    use RefreshDatabase;

     public function test_user_can_update_own_post_only(): void
    {
        $user = User::factory()->create();
        $post = Post::factory()->create(["user_id" => $user->id, "content" => "Test test", "status" => "published"]);

        $response = $this->actingAs($user)->put("/posts/{$post->id}", ["content" => "New content"]);
        $response->assertRedirect();

         $this->assertDatabaseHas('posts', [
            'id'    => $post->id,
            'content' => 'New content',
        ]);
    }

    public function test_guest_cannot_update_post(): void
    {
        $user = User::factory()->create();
        $post = Post::factory()->create(["user_id" => $user->id, "content" => "test", "status" => PostStatus::Pending->value]);

         $response = $this->put("/posts/{$post->id}", [
        'content' => 'Content of post',
        'status'  => PostStatus::Published->value,
                ]);

    $response->assertRedirect('/login');

     $this->assertDatabaseHas('posts', [
        'id'      => $post->id,
        'content' => 'test',
    ]);

    }

    public function test_other_user_cannot_update_foregin_post(): void
    {
        $user = User::factory()->create();
        $post = Post::factory()->create(["user_id" => $user->id, "content" => "Test", "status" => PostStatus::Published->value]);
        $otheruser = User::factory()->create();

        $response = $this->actingAs($otheruser)->put("/posts/{$post->id}", ["content" => "Updated content"]);

        $response->assertForbidden();

        $this->assertDatabaseHas('posts', [
        'id'      => $post->id,
        'content' => 'Test'
    ]);

    }
}
