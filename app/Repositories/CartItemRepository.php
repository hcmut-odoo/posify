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
        return CartItem::find($id);
    }

    public function remove($id)
    {
        return CartItem::where('id', $id)->delete();
    }

    public function update($data)
    {
        $fields = ['product_id', 'quantity', 'product_variant_id', 'note', 'stamp'];
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

    public function create($productId, $cartId, $productVariantId, $note, $quantity)
    {
        return CartItem::create([
            'product_id' => $productId,
            'cart_id' => $cartId,
            'product_variant_id' => $productVariantId,
            'note' => $note,
            'quantity' => $quantity
        ]);
    }

    public function search($criteria)
    {
        return CartItem::query()
            ->when(isset($criteria['cart_id']), function ($query) use ($criteria) {
                $query->where('cart_id', $criteria['cart_id']);
            })
            ->when(isset($criteria['product_id']), function ($query) use ($criteria) {
                $query->where('product_id', $criteria['product_id']);
            })
            ->when(isset($criteria['product_variant_id']), function ($query) use ($criteria) {
                $query->where('product_variant_id', $criteria['product_variant_id']);
            })
            ->when(isset($criteria['note']), function ($query) use ($criteria) {
                $query->where('note', $criteria['note'] == false ? null : $criteria['note']);
            })
            ->first();
    }
}
