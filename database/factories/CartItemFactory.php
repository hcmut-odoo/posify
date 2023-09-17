<?php
namespace Database\Factories;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\ProductVariant;
use Illuminate\Database\Eloquent\Factories\Factory;

class CartItemFactory extends Factory
{
    protected $model = CartItem::class;

    public function definition()
    {
        $productVariant = ProductVariant::factory()->create();
        $productId = $productVariant->product_id;

        return [
            'cart_id' => Cart::factory(), // Establish the relationship to Cart factory
            'product_id' => $productId, // Use the associated Product's ID
            'product_variant_id' => $productVariant->id,
            'quantity' => $this->faker->numberBetween(1, 5),
            'stamp' => $this->faker->boolean(),
            'note' => $this->faker->optional()->text(100),
        ];
    }
}
