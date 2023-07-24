<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderItem extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['order_id', 'cart_item_id'];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    public function cartItem()
    {
        return $this->belongsTo(CartItem::class);
    }
}
