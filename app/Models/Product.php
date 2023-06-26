<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Input\Input;

class Product extends Model
{
    protected $fillable = ['name', 'description', 'price', 'image_url', 'category_id'];


    public static function getAll()
    {
        return DB::table('products')->paginate(18);
    }

    public function getCategory()
    {
        return Category::find($this->category_id)->name;
    }

    public static function pagination($per_page)
    {
        return DB::table('products')->paginate($per_page);
    }

    public static function show($id)
    {
        return DB::table('products')->find($id);
    }

    public static function getByCategory($id)
    {
        return DB::table('products')->where('category_id', $id)->get();
    }

    public static function search($keyword)
    {
        return DB::table('products')->where('name', 'LIKE', "%$keyword%")->get();
    }
}
