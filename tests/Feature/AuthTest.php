<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthTest extends TestCase
{

    /**
     * @return void
     */
    public function test_register()
    {
        $response = $this->post('api/auth/register', [
            'email' => fake()->unique()->safeEmail(),
            'first_name' => fake()->name(),
            'last_name' => fake()->lastName(),
            'type' => fake()->randomElement([NULL, 'APPROVER']),
            'password' => Hash::make('password'),
        ]);

        $response->assertStatus(201);
    }

    /**
     * @return void
     */
    public function test_login()
    {
        $user = User::first();
        $response = $this->post('api/auth/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_logout()
    {
        $response = $this->actingAs(User::first())->post('api/auth/logout');

        $response->assertStatus(200);
    }
}
