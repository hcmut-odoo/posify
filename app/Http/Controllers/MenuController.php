<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MenuController extends Controller
{
    private $productService;

    public function __construct(ProductService $productService)
    {
        $this->middleware('auth');
        $this->productService = $productService;
    }

    public function menu()
    {
        $products = $this->productService->getAll();

        return view('menu', [
            'products' => $products
        ]);
    }

    public function detail($id)
    {
        $product = $this->productService->findById($id);

        return view('product_detail', [
            'product' => $product,
            'product_id' => $id
        ]);
    }

    public function category($id)
    {
        $products = $this->productService->findByCategory($id);

        return view('menu', [
            'products' => $products
        ]);
    }

    public function search(Request $request)
    {
        $keyword = $request->input("keyword");
        $products = $this->productService->search($keyword);

        return view('menu', [
            'products' => $products
        ]);
    }
}
