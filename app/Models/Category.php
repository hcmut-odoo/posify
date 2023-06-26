<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Category extends Model
{
    public static function pagination($per_page)
    {
        return DB::table('categories')->paginate($per_page);
    }
}
