<?php

namespace Database\Factories;

use App\Models\Payment;
use App\Models\PaymentApproval;
use App\Models\TravelPayment;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PaymentApproval>
 */
class PaymentApprovalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $payment = $this->payment();
        $userId = User::all()->where('type', 'APPROVER')->random()->id;

        return [
            'user_id' => $userId,
            'payment_type' => $payment,
            'payment_id' => $payment::all()->random()->id,
            'status' => fake()->randomElement(['APPROVED', 'DISAPPROVED']),
        ];
    }

    /**
     * @return mixed
     */
    private function payment(): mixed
    {
        return $this->faker->randomElement([
            Payment::class,
            TravelPayment::class,
        ]);
    }
}
