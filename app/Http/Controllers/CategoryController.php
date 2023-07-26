<?php

namespace App\Http\Controllers;

use App\Services\CategoryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    private $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
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
            $category = $this->categoryService->createCategory(['name' => $name]);
            if ($category) {
                Session::flash('message', 'Category was created successfully!');
            } else {
                Session::flash('message', 'Failed to create category!');
            }
            return redirect()->back();
        }

        return view('/admin/categories/create_category');
    }

    public function updateCategory(Request $request, $id)
    {
        $category = $this->categoryService->findById($id);
        if($request->getMethod() === 'POST') {
            $name = $request->input('name');
            $category = $this->categoryService->updateCategory(['id' => $id, 'name' => $name]);
            if ($category) {
                Session::flash('message', 'Category was updated successfully!');
            } else {
                Session::flash('message', 'Failed to update category!');
            }
            return redirect()->back();
        }
        return view('/admin/categories/category_update', [
            'category' => $category
        ]);
    }

    public function deleteCategory(Request $request, $id)
    {
        $isDeleted = $this->categoryService->deleteCategory($id);
        if ($isDeleted) {
            Session::flash('message', 'Category was deleted successfully!');
        } else {
            Session::flash('message', 'Failed to delete category!');
        }
        return redirect()->back();
    }

    public function forceDeleteCategory(Request $request, $id)
    {
        $isDeleted = $this->categoryService->deleteCategoryCascade($id);
        if ($isDeleted) {
            Session::flash('message', 'Category was deleted cascade successfully!');
        } else {
            Session::flash('message', 'Failed to delete cascade category!');
        }
        return redirect()->back();
    }
}
