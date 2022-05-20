<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use Str;

class RegisterUserTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_user_can_register()
    {
        $password = Str::random(10);
        $data = [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'password' => $password,
            'password_confirmation' => $password
        ];

        $this->postJson(route('auth.register'), $data)
            ->assertCreated();
    }
}
