<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Order;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => Hash::make('password'), // You can set a default password if needed
            'address' => $this->faker->address(),
            'phone_number' => $this->faker->phoneNumber(),
            'role' => $this->faker->randomElement(['admin', 'user']),
            'email_verified_at' => $this->faker->dateTimeBetween('-1 years', 'now'),
            'created_at' => $this->faker->dateTimeBetween('-1 years', 'now'),
            'updated_at' => now(),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (User $user) {
            // Create a random number of orders (2 to 5)
            $numberOfOrders = random_int(2, 5);

            Order::factory()
                ->count($numberOfOrders)
                ->create(['user_id' => $user->id]);
        });
    }
}
