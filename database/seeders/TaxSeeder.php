<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaxSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $taxes = [
            [
                'id' => 1,
                'name' => 'VAT',
                'value' => 10
            ]
        ];

        DB::table('taxes')->insert($taxes);
    }
}
