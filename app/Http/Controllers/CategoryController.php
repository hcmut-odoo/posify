<?php

namespace App\Http\Controllers;

use App\Services\CategoryService;
use Illuminate\Http\Request;

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
}
