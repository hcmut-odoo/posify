<?php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;
use Faker\Generator as Faker;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @param  Faker  $faker
     * @return array
     */
    protected $model = Product::class;

    public function definition()
    {
        return [
            'name' => $this->faker->sentence(3), // Generate a random sentence for the name
            'price' => $this->faker->numberBetween(15000, 50000), // Generate a random price between 1000 and 10000
            'description' => $this->faker->paragraph(), // Generate a random paragraph for the description
            'image_url' => $this->faker->imageUrl(), // Generate a random image URL
            'created_at' => $this->faker->dateTimeBetween('-2 years', '-1 years'),
            'updated_at' => $this->faker->dateTimeBetween('-1 years', 'now'),
            'category_id' => $this->faker->randomElement([1, 2, 5, 18, 20]), // Generate a random category ID between 1 and 5
            'tax_id' => 1,
        ];
    }
}
