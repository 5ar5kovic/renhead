<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class PaymentApprovalTest extends TestCase
{
    /**
     * @return void
     */
    public function test_approval(): void
    {
        $user = User::where('type', 'APPROVER')->first();
        $response = $this->actingAs($user)->post('api/payments/1/approve', ['status' => 'APPROVED']);

        $response->assertStatus(201);
    }
}
