<?php
namespace Database\Factories;

use App\Models\OrderItem;
use App\Models\Order;
use App\Models\CartItem;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderItemFactory extends Factory
{
    protected $model = OrderItem::class;

    public function definition()
    {
        return [
            'order_id' => function () {
                return Order::factory()->create()->id;
            },
            'cart_item_id' => CartItem::factory(),
        ];
    }
}

