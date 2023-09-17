<?php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Cart;
use App\Models\User;

class CartFactory extends Factory
{
    protected $model = Cart::class;

    public function definition()
    {
        $user = User::inRandomOrder()->first();

        return [
            'user_id' => $user->id,
        ];
    }
}
