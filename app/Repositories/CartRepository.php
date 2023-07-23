<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Cart;
use App\Models\CartItem;

class CartRepository
{
    public function isContain($id)
    {
        $existingCart = Cart::where('id', $id)->get();
        return count($existingCart) > 0;
    }

    public function new()
    {
        return Cart::create(['user_id' => Auth::id()]);
    }

    public function show()
    {
        return DB::table('cart_items')
            ->join('products', 'cart_items.product_id', '=', 'products.id')
            ->get(['cart_items.*', 'products.name', 'products.price', 'products.image_url']);
    }

    public function clear()
    {
        return Cart::where('user_id', Auth::id())->delete();
    }

    public function create($userID)
    {
        $existingCart = Cart::where('user_id', $userID)->first();

        if ($existingCart) {
            return $existingCart->id;
        }

        $cartModel = new Cart(['user_id' => $userID]);
        $cartModel->save();

        return $cartModel;
    }
}
