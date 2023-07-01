<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'id' => 1,
                'name' => 'Cà phê',
                'created_at' => '2021-10-30 02:31:28',
                'updated_at' => '2021-10-30 02:31:28',
            ],
            [
                'id' => 18,
                'name' => 'Thưởng thức tại nhà',
                'created_at' => '2021-10-30 02:31:28',
                'updated_at' => '2021-10-30 02:31:28',
            ],
            [
                'id' => 2,
                'name' => 'Đá Xay - Choco - Matcha',
                'created_at' => '2021-10-30 02:31:28',
                'updated_at' => '2021-10-30 02:31:28',
            ],
            [
                'id' => 20,
                'name' => 'Bộ sưu tập quà tặng',
                'created_at' => '2021-10-30 02:31:28',
                'updated_at' => '2021-10-30 02:31:28',
            ],
            [
                'id' => 5,
                'name' => 'Trà Trái Cây - Trà Sữa',
                'created_at' => '2021-10-30 02:31:28',
                'updated_at' => '2021-10-30 02:31:28',
            ],
        ];

        DB::table('categories')->insert($categories);
    }
}

