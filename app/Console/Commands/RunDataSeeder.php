<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Models\User;

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

            if ($number < 50) {
                $this->error('Number must be greater than or equal to 50.');
                return;
            }

            $numberOrders = $number / 50;

            DB::beginTransaction();

            $this->warn('Seeding data...');
            User::factory()->count($numberOrders * 3)->create();
            $this->info('Done...');

            DB::commit();
            $this->info('Data seeded successfully!');
        } catch (\Exception $e) {
            DB::rollback();
            $this->error('Data seeding failed: ' . $e->getMessage());
        }
    }
}
