<?php

namespace Tests\Feature;

use App\Models\TravelPayment;
use App\Models\User;
use Tests\TestCase;

class TravelPaymentTest extends TestCase
{
    /**
     * @return void
     */
    public function test_index(): void
    {
        $user = User::first();
        $response = $this->actingAs($user)->get('api/travel-payments');

        $response->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_show(): void
    {
        $user = User::first();
        $response = $this->actingAs($user)->get('api/travel-payments/1');

        $response->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_create(): void
    {
        $user = User::first();
        $response = $this->actingAs($user)->post('/api/travel-payments', [
            'amount' => '1'
        ]);
        $response->assertStatus(201);
    }

    /**
     * @return void
     */
    public function test_update(): void
    {
        $user = User::first();
        $payments = TravelPayment::where('user_id', $user->id)->get();
        $response = $this->actingAs($user)->patch('/api/travel-payments/' . $payments[sizeof($payments)-1]->id, [
            'amount' => '1'
        ]);

        $response->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_delete(): void
    {
        $user = User::first();
        $payments = TravelPayment::where('user_id', $user->id)->get();
        $response = $this->actingAs($user)->delete('/api/travel-payments/' . $payments[sizeof($payments)-1]->id);

        $response->assertStatus(200);
    }
}
