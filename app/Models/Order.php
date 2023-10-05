<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'delivery_name', 'status', 'order_transaction', 'user_id',
        'delivery_phone', 'payment_mode_id', 'delivery_address',
        'delivery_note', 'total', 'total_tax'
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
