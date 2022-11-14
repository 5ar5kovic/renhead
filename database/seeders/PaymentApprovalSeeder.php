<?php

namespace Database\Seeders;

use App\Models\PaymentApproval;
use Illuminate\Database\Seeder;

class PaymentApprovalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PaymentApproval::factory(4000)->create();
    }
}
