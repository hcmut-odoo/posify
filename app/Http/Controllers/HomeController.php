<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Store;

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function about()
    {
        return view('about');
    }

    public function contact()
    {
        return view('contact');
    }

    public function stores()
    {
        $stores = Store::getAll();

        return view('store', ['stores' => $stores]);
    }
}
