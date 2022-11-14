<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * @return void
     */
    public function test_index()
    {
        $response = $this->actingAs(User::first())->get('api/users');

        $response->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_show()
    {
        $user = User::first();
        $response = $this->actingAs($user)->get('api/users/' . $user->id);

        $response->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_update()
    {
        $user = User::first();
        $response = $this->actingAs($user)->put('/api/users/' . $user->id, [
            'email' => fake()->unique()->safeEmail(),
            'first_name' => fake()->name(),
            'last_name' => fake()->lastName(),
            'type' => fake()->randomElement([NULL, 'APPROVER']),
        ]);
        $response->assertStatus(200);
    }
}
