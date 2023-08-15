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
        if ($request->getMethod() === 'POST') {
            $data = $request->only(['name', 'description', 'price', 'image_url', 'category_id']);
            
            try {
                $product = $this->productService->createProduct($data);
                Session::flash('message', 'Product was created successfully!');

                return redirect()->route('admin.product.view', ['id' => $product->id]);
            } catch (\Exception $e) {
                Session::flash('message', $e->getMessage());

                return redirect()->back();
            }
        }

        return view('/admin/products/create_product');
    }


    public function updateProduct(Request $request)
    {
        if($request->getMethod() === 'POST') {
            $data = $request->only(['id', 'name', 'description', 'price', 'image_url', 'category_id']);
            
            try {
                $this->productService->updateProduct($data);
                Session::flash('message', 'Product was updated successfully!');
            } catch (\Exception $e) {
                Session::flash('message', $e->getMessage());
            }

            return redirect()->route('admin.product.update.get', ['id' => $data['id']]);
        }

        $id = $request->input('id');
        $product = $this->productService->findById($id);

        return view('/admin/products/update_product', [
            'product' => $product
        ]);
    }

    public function deleteProduct(Request $request, $id)
    {
        try {
            $this->productService->deleteProduct($id);
            Session::flash('message', 'Product was deleted successfully!');
        } catch (\Exception $e) {
            Session::flash('message', $e->getMessage());
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
