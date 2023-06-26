<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{

    protected $fillable = ['name', 'status', 'phone', 'image_url', 'open_time'];

    public static function getAll()
    {
        return Store::all();
    }
}
