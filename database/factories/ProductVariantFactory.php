<?php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\ProductVariant;
use App\Models\Product;

class ProductVariantFactory extends Factory
{
    protected $model = ProductVariant::class;

    public function definition()
    {
        return [
            'product_id' => Product::factory(), // Establish the relationship to Product factory
            'size' => $this->faker->word(),
            'color' => $this->faker->colorName(),
            'extend_price' => $this->faker->randomFloat(2, 20000, 60000),
            'stock_qty' => $this->faker->numberBetween(0, 100),
        ];
    }
}
