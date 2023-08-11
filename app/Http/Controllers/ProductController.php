<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Product;
use App\Services\ProductService;

class ProductController extends Controller
{
    private $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index(Request $request)
    {
        $products = $this->productService->getAll();

        return view('/admin/products/products', [
            'products' => $products
        ]);
    }

    public function createProduct(Request $request)
    {
        if($request->getMethod() === 'POST') {
            $data = $request->only(['name', 'description', 'price', 'image_url', 'category_id']);
            $product = $this->productService->createProduct(...array_values($data));

            if ($product) {
                Session::flash('message', 'Product was created successfully!');
            } else {
                Session::flash('message', 'Failed to create product!');
            }
            return redirect()->back();
        }

        return view('/admin/categories/create_category');
    }

    public function updateProduct(Request $request, $id)
    {
        $category = $this->productService->findById($id);

        if($request->getMethod() === 'POST') {
            $data = $request->only(['name', 'description', 'price', 'image_url', 'category_id']);
            $isUpdated = $this->productService->updateProduct(...array_values($data));

            if ($isUpdated) {
                Session::flash('message', 'Product was updated successfully!');
            } else {
                Session::flash('message', 'Failed to update product!');
            }
            return redirect()->back();
        }

        return view('/admin/categories/category_update', [
            'category' => $category
        ]);
    }

    public function deleteProduct(Request $request, $id)
    {
        $isDeleted = $this->productService->deleteProduct($id);
        if ($isDeleted) {
            Session::flash('message', 'Product was deleted successfully!');
        } else {
            Session::flash('message', 'Failed to product category!');
        }

        return redirect()->back();
    }

    public function detailProduct(Request $request)
    {
        $productId = $request->input('id');
        $product = $this->productService->findById($productId);
        $productVariants = $this->productService->getProductVariantByProductId($productId);

        return view('/admin/products/detail_product', [
            'product' => $product,
            'product_variants' => $productVariants
        ]);
    }
}
