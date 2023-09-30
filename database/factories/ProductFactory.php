<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;
use Faker\Provider\Uuid as UuidProvider;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
        $this->faker->addProvider(new UuidProvider($this->faker));

        return [
            'name' => $this->faker->sentence(3),
            'price' => $this->faker->numberBetween(15000, 50000),
            'description' => $this->faker->paragraph(),
            'image_url' => $this->faker->imageUrl(),
            'created_at' => $this->faker->dateTimeBetween('-2 years', '-1 years'),
            'updated_at' => $this->faker->dateTimeBetween('-1 years', 'now'),
            'category_id' => $this->faker->randomElement([1, 2, 5, 18, 20]),
            'tax_id' => 1,
            'barcode' => $this->faker->uuid,
        ];
    }
}
