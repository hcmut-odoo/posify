<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Log;

class OrderItemRepository
{
    public function get($id)
    {
        return OrderItem::find($id);
    }

    public function remove($id)
    {
        return OrderItem::where('id', $id)->delete();
    }

    public function pagination($perPage, $page)
    {
        return OrderItem::paginate($perPage, ['*'], 'page', $page);
    }

    public function create($cartItemId, $orderId)
    {
        return OrderItem::create([
            'cart_item_id' => $cartItemId,
            'order_id' => $orderId
        ]);
    }

    public function update($data)
    {
        $fields = ['order_id', 'cart_item_id'];
        $updateData = [];

        foreach ($fields as $field) {
            if (isset($data[$field])) {
                $updateData[$field] = $data[$field];
            }
        }

        if (!empty($updateData)) {
            return DB::table('order_items')
                ->where('id', $data['id'])
                ->update($updateData);
        }

        return false;
    }
}
