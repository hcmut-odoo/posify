<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            [
                'name' => 'add'
            ],
            [
                'name' => 'modify'
            ],
            [
                'name' => 'view'
            ],
            [
                'name' => 'delete'
            ]
        ];

        $id = 1;
        foreach ($permissions as &$permission) {
            $permission['id'] = $id;
            $id++;
        }

        DB::table('permissions')->insert($permissions);
    }
}
