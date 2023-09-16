<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Cart;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;

class RunDataSeeder extends Command
{
    protected $signature = 'factory:seed {number}';

    protected $description = 'Seed data into the database';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        try {
            $number = $this->argument('number');
            $numberOrders = $number/3;
            $numberUsers = $number/10;
            $numberOrderItems = $number/3;
            $numberProducts = $number/4;
            $numberCartItems = $number/3;

            DB::beginTransaction();
            $this->warn('Seeding user data...');
            User::factory()->count($numberUsers)->create();
            $this->info('Done...');

            $this->warn('Seeding cart data...');
            Cart::factory()->count($numberUsers)->create();
            $this->info('Done...');

            $this->warn('Seeding product data...');
            Product::factory()->count($number)->create();
            $this->info('Done...');

            $this->warn('Seeding product variant data...');
            ProductVariant::factory()->count($numberProducts*2)->create();
            $this->info('Done...');

            $this->warn('Seeding cart item data...');
            CartItem::factory()->count($numberCartItems)->create();
            $this->info('Done...');

            $this->warn('Seeding order data...');
            Order::factory()->count($numberOrders*3)->create();
            $this->info('Done...');

            $this->warn('Seeding order item data...');
            OrderItem::factory()->count($numberOrderItems*4)->create();
            $this->info('Done...');

            DB::commit();
            $this->info('Data seeded successfully!');
        } catch (\Exception $e) {
            DB::rollback();
            $this->error('Data seeding failed: ' . $e->getMessage());
        }
    }
}
