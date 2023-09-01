<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentModeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $paymentModes = [
            [
                'id' => 1,
                'name' => 'cash'
            ],
            [
                'id' => 2,
                'name' => 'Payment by check'
            ],
            [
                'id' => 3,
                'name' => 'Bank wire'
            ],
        ];

        DB::table('payment_modes')->insert($paymentModes);
    }
}
