<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginUserTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_login()
    {
        $user = User::factory()->create();

        $credentials = [
            'email' => $user['email'],
            'password' => 'password'
        ];


        $this->postJson(route('auth.login'), $credentials)
            ->assertSuccessful()
            ->assertJsonStructure([
                'user' => [
                    'id',
                    'name',
                    'email',
                    'created_at'
                ],
                'token_type',
                'token'
            ]);
    }

    public function test_if_user_credentials_is_not_authorized()
    {
        $credentials = [
            'email' => 'sample@gmail.com',
            'password' => 'password'
        ];


        $this->postJson(route('auth.login'), $credentials)
            ->assertUnauthorized();
    }
}
