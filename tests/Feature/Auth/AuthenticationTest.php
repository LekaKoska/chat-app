<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_register(): void
    {
      $response = $this->post('/register',
            [
                'name' => "Test",
                'email' => "test@gmail.com",
                'password' => 'Password123',
                'password_confirmation' => 'Password123'

            ]);

        $response->assertRedirect("/dashboard");

        $this->assertDatabaseHas('users', [
            'email' => 'test@gmail.com',
        ]);

    }

}
