<?php

namespace Database\Seeders;

use App\Models\TravelPayment;
use Illuminate\Database\Seeder;

class TravelPaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TravelPayment::factory(200)->create();
    }
}
