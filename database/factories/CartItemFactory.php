<?php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\CartItem;
use App\Models\Cart;
use App\Models\Product;
use App\Models\ProductVariant;

class CartItemFactory extends Factory
{
    protected $model = CartItem::class;

    public function definition()
    {
        return [
            'cart_id' => Cart::factory(), // Establish the relationship to Cart factory
            'product_id' => Product::factory(), // Establish the relationship to Product factory
            'product_variant_id' => ProductVariant::factory(), // Establish the relationship to ProductVariant factory
            'quantity' => $this->faker->numberBetween(1, 5),
            'stamp' => $this->faker->boolean(),
            'note' => $this->faker->optional()->text(100),
        ];
    }
}
