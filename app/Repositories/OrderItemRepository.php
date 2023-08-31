<?php

namespace App\Repositories;

use App\Exceptions\NotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\OrderItem;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;
use RuntimeException;

class OrderItemRepository
{
    public function get($id)
    {
        try {
            $invoice = OrderItem::findOrFail($id);
            return $invoice;
        } catch (ModelNotFoundException $e) {
            throw new NotFoundException("Not found invoice has ID: $id");
        }
    }

    public function remove($id)
    {
        $orderItem = OrderItem::find($id);
        if (!$orderItem) {
            throw new RuntimeException("Order item not found.");
        }
        try {
            if ($orderItem->delete()) {
                return true;
            } else {
                throw new RuntimeException("Failed to delete order item.");
            }
        } catch (\Exception $e) {
            Log::channel('db')->info("Error while deleting order item: " . $e->getMessage());
            return false;
        }
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

        $updateData['updated_at'] = now();
        
        if (!empty($updateData)) {
            return DB::table('order_items')
                ->where('id', $data['id'])
                ->update($updateData);
        }

        return false;
    }
}
