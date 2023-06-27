<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@pos.com',
            'password' => Hash::make('12345678'),
            'address' => 'HCMC',
            'phone_number' => '0924956363',
            'role' => 'admin',
            'email_verified_at' => now()
        ]);
    }
}
