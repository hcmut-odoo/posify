<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ResourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $resources = [
            [
                'id' => 1,
                'name' => 'Product',
            ],
            [
                'id' => 2,
                'name' => 'Category',
            ],
            [
                'id' => 3,
                'name' => 'User',
            ],
            [
                'id' => 4,
                'name' => 'Order',
            ],
            [
                'id' => 5,
                'name' => 'Invoice',
            ],
            [
                'id' => 6,
                'name' => 'OrderItem',
            ],
            [
                'id' => 7,
                'name' => 'Store',
            ],
            [
                'id' => 8,
                'name' => 'Api',
            ],
            [
                'id' => 9,
                'name' => 'Other',
            ],
            [
                'id' => 10,
                'name' => 'CartItem',
            ],
            [
                'id' => 11,
                'name' => 'OrderItem',
            ],
            [
                'id' => 12,
                'name' => 'Profile',
            ],
            [
                'id' => 13,
                'name' => 'UserGroup',
            ],
            [
                'id' => 14,
                'name' => 'UserRole',
            ],
            [
                'id' => 15,
                'name' => 'RoleGroup',
            ],
            [
                'id' => 16,
                'name' => 'Action',
            ]
        ];

        DB::table('resources')->insert($resources);
    }
}
