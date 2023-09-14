<?php

namespace App\Repositories;

use App\Exceptions\NotFoundException;
use App\Models\Order;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

class OrderRepository
{
    public function get($id)
    {
        try {
            $order = Order::findOrFail($id);
            return $order;
        } catch (ModelNotFoundException $e) {
            throw new NotFoundException("Not found order has ID: $id");
        }
    }

    public function create($userId, $paymentModeId, $deliveryName, $deliveryPhone, $deliveryNote, $deliveryAddress)
    {
        return Order::create([
            'order_transaction' => uniqid(),
            'user_id' => $userId,
            'payment_mode_id' => $paymentModeId,
            'status' => 'processing',
            'delivery_name' => $deliveryName,
            'delivery_phone' => $deliveryPhone,
            'delivery_address' => $deliveryAddress,
            'delivery_note' => $deliveryNote,
            'total' => 0
        ]);
    }

    public function update($data)
    {
        $fields = ['status', 'total'];
        $updateData = [];

        foreach ($fields as $field) {
            if (isset($data[$field])) {
                $updateData[$field] = $data[$field];
            }
        }

        $updateData['updated_at'] = now();

        if (!empty($updateData)) {
            return DB::table('orders')
                ->where('id', $data['id'])
                ->update($updateData);
        }

        return false;
    }

    public function remove($id)
    {
        return Order::where('id', $id)->delete();
    }

    public function getAll()
    {
        return Order::get();
    }

    public function pagination($criteria, $fields, $perPage, $page)
    {
        return Order::query()
            ->when(isset($criteria['user_id']), function ($query) use ($criteria) {
                $query->where('user_id', $criteria['user_id']);
            })
            ->when(isset($criteria['status']), function ($query) use ($criteria) {
                $query->where('status', $criteria['status']);
            })
            ->when(isset($criteria['order_transaction']), function ($query) use ($criteria) {
                $query->where('order_transaction', $criteria['order_transaction']);
            })
            ->when(isset($criteria['delivery_phone']), function ($query) use ($criteria) {
                $query->where('delivery_phone', $criteria['delivery_phone']);
            })
            ->when(isset($criteria['delivery_name']), function ($query) use ($criteria) {
                $query->where('delivery_name', $criteria['delivery_name']);
            })
            ->paginate($perPage, $fields, 'page', $page);
    }
}
