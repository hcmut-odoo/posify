<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    protected $fillable = ['name', 'phone_number', 'address', 'payment_method', 'category_id'];
}
