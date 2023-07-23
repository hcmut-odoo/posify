<?php

namespace App\Http\Controllers;

use App\Services\StoreService;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    private $storeService;

    public function __construct(StoreService $storeService)
    {
        $this->storeService = $storeService;
    }

    public function index(Request $request)
    {
        $stores = $this->storeService->getAll();

        return view('/admin/stores/stores', [
            'stores' => $stores
        ]);
    }
}
