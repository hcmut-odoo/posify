<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ApiKeySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $apiKeys = [
            [
                'id' => 1,
                'key' => "01OP23STU459atzAdCFsGHILMvwxNQRV",
                'user_id' => 1,
                'expired_at' => Carbon::now()->addMonth()
            ]
        ];

        DB::table('api_keys')->insert($apiKeys);
    }
}
