<?php

namespace App\Services;

use App\Models\Category;

class CategoryService extends BaseService
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getAllCategories()
    {
        return Category::all();
    }
}
