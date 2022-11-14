<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'email' => fake()->unique()->safeEmail(),
            'first_name' => fake()->name(),
            'last_name' => fake()->lastName(),
            'type' => fake()->randomElement([NULL, 'APPROVER']),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ];
    }
}
