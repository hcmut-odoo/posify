<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Cart extends Model
{
    //
    protected $fillable = ['user_id'];
    use Notifiable;

    public static function isContain($id)
    {
        $cartModel = Cart::where('id', $id)->get();
        return count($cartModel) > 0;
    }

    public static function show()
    {
        return DB::table('cart_items')
                    ->join('products', 'cart_items.product_id', '=', 'products.id')
                    ->get(['cart_items.*', 'products.name', 'products.price', 'products.image_url']);
    }

    public function clear()
    {
        return DB::table('carts')
                    ->where('user_id', Auth::id())->delete();
    }

    public static function new($userID)
    {
        $cartModel = new Cart();
        $cartModel->user_id = $userID;
        $cartModel->id = uniqid();
        $cartModel->save();

        return $cartModel->id;
    }
}
