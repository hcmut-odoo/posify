<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\CartItem;
use Illuminate\Support\Facades\Log;

class CartItemRepository
{
    public function get($id)
    {
        return CartItem::where('id', $id)->get();
    }

    public function remove($id)
    {
        return CartItem::where('id', $id)->delete();
    }

    public function update($data)
    {
        $fields = ['product_id', 'quantity', 'size', 'note', 'stamp'];
        $updateData = [];

        foreach ($fields as $field) {
            if (isset($data[$field])) {
                $updateData[$field] = $data[$field];
            }
        }

        if (!empty($updateData)) {
            return DB::table('cart_items')
                ->where('id', $data['id'])
                ->update($updateData);
        }

        return false;
    }


}
