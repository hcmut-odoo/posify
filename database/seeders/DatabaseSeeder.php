<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\CategorySeeder;
use Database\Seeders\StoreSeeder;
use Database\Seeders\ProductSeeder;
use Database\Seeders\PaymentModeSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            CategorySeeder::class,
            StoreSeeder::class,
            TaxSeeder::class,
            ProductSeeder::class,
            ResourceSeeder::class,
            PermissionSeeder::class,
            ActionSeeder::class,
            PaymentModeSeeder::class
        ]);
    }
}
