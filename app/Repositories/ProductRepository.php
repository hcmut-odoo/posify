<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Product;

class ProductRepository
{
    public function get($id)
    {
        return Product::find($id);
    }

    public function getByCategory($id)
    {
        return Product::where('category_id', $id)->get();
    }

    public function search($keyword)
    {
        return Product::where('name', 'LIKE', "%$keyword%")->get();
    }

    public function remove($id)
    {
        return Product::where('id', $id)->delete();
    }

    public function getAll()
    {
        return DB::table('products')
        ->join('categories', 'products.category_id', '=', 'categories.id')
        ->select('products.*', 'categories.name as category_name')
        ->get();
    }

    public function pagination($perPage, $page)
    {
        return Product::paginate($perPage, ['*'], 'page', $page);
    }
}
