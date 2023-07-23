<?php

namespace App\Repositories;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderRepository
{
    public function get($id)
    {
        return Order::where('id', $id)->get();
    }

    public function create($userId, $paymentMethod, $deliveryName, $deliveryPhone, $deliveryAddress)
    {
        return Order::create([
            'order_transaction' => uniqid(),
            'user_id' => $userId,
            'payment_method' => $paymentMethod,
            'status' => 'processing',
            'delivery_name' => $deliveryName,
            'delivery_phone' => $deliveryPhone,
            'delivery_address' => $deliveryAddress
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

    public function pagination($perPage, $page)
    {
        return Order::paginate($perPage, ['*'], 'page', $page);
    }
}
