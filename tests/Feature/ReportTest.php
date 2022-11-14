<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class ReportTest extends TestCase
{
    /**
     * @return void
     */
    public function test_report(): void
    {
        $user = User::where('type', 'APPROVER')->first();
        $response = $this->actingAs($user)->get('api/report');

        $response->assertStatus(200);
    }
}
