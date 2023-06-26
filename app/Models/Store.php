<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Store extends Model
{

    protected $fillable = ['name', 'status', 'phone', 'image_url', 'open_time', 'address'];

    public static function getAll()
    {
        return Store::all();
    }

    public static function pagination($per_page)
    {
        return DB::table('stores')->paginate($per_page);
    }
}
