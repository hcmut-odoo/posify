<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\User;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $income = 1000000;
        $products = Product::count();
        $users = User::count();
        $orders = Order::where('status', 'done')->count();

        return view('/admin/dashboard', [
            'orders' => $orders,
            'products' => $products,
            'users' => $users,
            'income' => $income
        ]);
    }
}
