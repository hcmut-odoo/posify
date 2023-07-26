<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userGroups = [
            [
                'id' => 1,
                'name' => 'administrator',
                'description' => 'The group of staffs have hightest permission',
                'permission' => 'admin',
            ],
            [
                'id' => 2,
                'name' => 'staff',
                'description' => 'The group of staffs have limit permissions',
                'permission' => 'staff',
            ]
        ];

        DB::table('user_groups')->insert($userGroups);
    }
}
