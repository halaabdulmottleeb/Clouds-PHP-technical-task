<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class PaymentPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('payment_plans')->insert([
            [
                'price' => 9.99,
                'type' => 'monthly',
            ],
            [
                'price' => 99.99,
                'type' => 'yearly',
            ],
        ]);
    }
}
