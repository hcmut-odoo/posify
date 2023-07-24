<?php

namespace App\Repositories;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderRepository
{
    public function get($id)
    {
        return Order::find($id);
    }

    public function create($userId, $paymentMethod, $deliveryName, $deliveryPhone, $deliveryNote, $deliveryAddress)
    {
        return Order::create([
            'order_transaction' => uniqid(),
            'user_id' => $userId,
            'payment_method' => $paymentMethod,
            'status' => 'processing',
            'delivery_name' => $deliveryName,
            'delivery_phone' => $deliveryPhone,
            'delivery_address' => $deliveryAddress,
            'delivery_note' => $deliveryNote
        ]);
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
