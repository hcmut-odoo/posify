<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartItem extends Model
{
    use SoftDeletes;

    protected $fillable = ['product_id', 'quantity', 'size', 'note', 'cart_id'];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
