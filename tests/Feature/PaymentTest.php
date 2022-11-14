<?php

namespace Tests\Feature;

use App\Models\Payment;
use App\Models\User;
use Tests\TestCase;

class PaymentTest extends TestCase
{
    /**
     * @return void
     */
    public function test_index(): void
    {
        $user = User::first();
        $response = $this->actingAs($user)->get('api/payments');

        $response->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_show(): void
    {
        $user = User::first();
        $response = $this->actingAs($user)->get('api/payments/1');

        $response->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_create(): void
    {
        $user = User::first();
        $response = $this->actingAs($user)->post('/api/payments', [
            'total_amount' => '1'
        ]);
        $response->assertStatus(201);
    }

    /**
     * @return void
     */
    public function test_update(): void
    {
        $user = User::first();
        $payments = Payment::where('user_id', $user->id)->get();
        $response = $this->actingAs($user)->patch('/api/payments/' . $payments[sizeof($payments)-1]->id, [
            'total_amount' => '1'
        ]);

        $response->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_delete(): void
    {
        $user = User::first();
        $payments = Payment::where('user_id', $user->id)->get();
        $response = $this->actingAs($user)->delete('/api/payments/' . $payments[sizeof($payments)-1]->id);

        $response->assertStatus(200);
    }
}
