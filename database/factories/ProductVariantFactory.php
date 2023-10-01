<?php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Provider\Uuid as UuidProvider;
use App\Models\ProductVariant;
use App\Models\Product;

class ProductVariantFactory extends Factory
{
    protected $model = ProductVariant::class;

    public function definition()
    {
        $this->faker->addProvider(new UuidProvider($this->faker));

        return [
            'product_id' => Product::factory(), // Establish the relationship to Product factory
            'variant_barcode' => $this->faker->uuid(),
            'size' => $this->faker->word(),
            'color' => $this->faker->colorName(),
            'extend_price' => $this->faker->randomFloat(2, 3000, 9000),
            'stock_qty' => $this->faker->numberBetween(0, 100),
            'created_at' => $this->faker->dateTimeBetween('-2 years', '-1 years'),
            'updated_at' => $this->faker->dateTimeBetween('-1 years', 'now'),
        ];
    }
}
