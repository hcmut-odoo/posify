<?php

namespace App\Http\Controllers;

use App\Services\CategoryService;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    private $categoryService;
    private $productService;

    public function __construct(CategoryService $categoryService, ProductService $productService)
    {
        $this->categoryService = $categoryService;
        $this->productService = $productService;
    }

    public function index(Request $request)
    {
        $categories = $this->categoryService->getAllCategories();

        return view('/admin/categories/category_index', [
            'categories' => $categories
        ]);
    }

    public function createCategory(Request $request)
    {
        if($request->getMethod() === 'POST') {
            $name = $request->input('name');
            try {
                $this->categoryService->createCategory(['name' => $name]);
                Session::flash('message', 'Category was created successfully!');
            } catch (\Exception $e) {
                Session::flash('message', $e->getMessage());
            }
            return redirect()->back();
        }

        return view('/admin/categories/create_category');
    }

    public function detailCategory(Request $request)
    {
        $categoryId = $request->input('id');
        $category = $this->categoryService->findById($categoryId);
        $products = $this->productService->findByCategory($categoryId);

        return view('/admin/categories/detail_category', [
            'category' => $category,
            'products' => $products
        ]);
    }

    public function updateCategory(Request $request)
    {
        $id = $request->input('id');

        if($request->getMethod() === 'POST') {
            $name = $request->input('name');
            try {
                $this->categoryService->updateCategory(['id' => $id, 'name' => $name]);
                Session::flash('message', 'Category was updated successfully!');
            } catch (\Exception $e){
                Session::flash('message', $e->getMessage());
            }
            return redirect()->back();
        }

        $category = $this->categoryService->findById($id);

        return view('/admin/categories/update_category', [
            'category' => $category
        ]);
    }

    public function deleteCategory(Request $request, $id)
    {
        try {
            $this->categoryService->deleteCategory($id);
            Session::flash('message', 'Category was deleted successfully!');
        } catch (\Exception $e){
            Session::flash('message', $e->getMessage());
        }

        return redirect()->back();
    }

    public function forceDeleteCategory(Request $request, $id)
    {
        try {
            $this->categoryService->deleteCategoryCascade($id);
            Session::flash('message', 'Category was deleted cascade successfully!');
        } catch (\Exception $e) {
            Session::flash('message', $e->getMessage());
        }

        return redirect()->back();
    }
}
