<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Store;

class StoreController extends Controller
{
    public function index(Request $request)
    {
        $stores = Store::all();

        return view('/admin/stores/stores', [
            'stores' => $stores
        ]);
    }
}
