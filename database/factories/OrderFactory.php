<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Order;
use App\Models\User;
use App\Models\OrderItem;

class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Order::class;

    public function definition()
    {
        return [
            'user_id' => function () {
                return User::factory()->create()->id;
            },
            'status' => $this->faker->randomElement(['processing', 'done', 'cancel']),
            'order_transaction' => Str::uuid()->toString(),
            'delivery_note' => $this->faker->optional(0.7)->text(100),
            'delivery_phone' => $this->faker->phoneNumber(),
            'delivery_address' => $this->faker->address(),
            'delivery_name' => $this->faker->name(),
            'total' => $this->faker->randomFloat(2, 30000, 200000), // Adjust the range as needed
            'payment_mode_id' => $this->faker->randomElement([1, 2, 3]),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Order $order) {
            OrderItem::factory()
                ->count(random_int(1, 5))
                ->create(['order_id' => $order->id]);
        });
    }
}
