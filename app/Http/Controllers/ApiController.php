<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use App\Models\Store;

class ApiController extends Controller
{
    public function products(Request $request)
    {
        // Number of items per page, default is 10
        $perPage = $request->input('per_page', 10);
        $products = Product::pagination($perPage);

        return response()->json($products);
    }

    public function users(Request $request)
    {
        // Number of items per page, default is 10
        $perPage = $request->input('per_page', 10);
        $products = User::pagination($perPage);

        return response()->json($products);
    }

    public function categories(Request $request)
    {
        // Number of items per page, default is 10
        $perPage = $request->input('per_page', 10);
        $products = Category::pagination($perPage);

        return response()->json($products);
    }

    public function stores(Request $request)
    {
        // Number of items per page, default is 10
        $perPage = $request->input('per_page', 10);
        $products = Store::pagination($perPage);

        return response()->json($products);
    }
}
