<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    protected $fillable = ['delivery_name', 'status', 'order_transaction', 'user_id', 'delivery_phone', 'payment_method', 'delivery_address'];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
