<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    protected $fillable = ['name', 'phone_number', 'address', 'payment_method', 'category_id'];

    public static function pagination($per_page)
    {
        return DB::table('products')->paginate($per_page);
    }
}
