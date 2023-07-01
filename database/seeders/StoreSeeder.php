<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $stores = [
            [
                'id' => 117,
                'address' => '114 Đường 9A Khu Dân cư Trung Sơn',
                'status' => 'hoạt động',
                'image_url' => 'https://minio.thecoffeehouse.com/image/admin/store/5b21f8cb1acd4d02032668ea_trung_20son_201.jpeg',
                'open_time' => '7:00 - 22:00',
                'phone' => '02871087088',
                'created_at' => '2021-10-30 03:15:23',
                'updated_at' => '2021-10-30 03:15:23',
            ],
            [
                'id' => 129,
                'address' => '93/5 Nguyễn Ảnh Thủ',
                'status' => 'hoạt động',
                'image_url' => 'https://minio.thecoffeehouse.com/image/admin/store/5b21f8cb1acd4d02032668eb_nguyen_20anh_20thu_201.jpeg',
                'open_time' => '7:00 - 22:00',
                'phone' => '02871087088',
                'created_at' => '2021-10-30 03:15:23',
                'updated_at' => '2021-10-30 03:15:23',
            ],
            [
                'id' => 18,
                'address' => '141 Nguyễn Thái Bình',
                'status' => 'hoạt động',
                'image_url' => 'https://minio.thecoffeehouse.com/image/admin/store/5b21f8cb1acd4d02032668ee_5b21f8cb1acd4d02032668ee_nguyen_20thai_20binh_201_20.jpeg',
                'open_time' => '7:00 - 22:00',
                'phone' => '02871087088',
                'created_at' => '2021-10-30 03:15:23',
                'updated_at' => '2021-10-30 03:15:23',
            ],
        ];

        DB::table('stores')->insert($stores);
    }
}

