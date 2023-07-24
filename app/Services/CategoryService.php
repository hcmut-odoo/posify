<?php

namespace App\Services;

use App\Models\Category;
use App\Repositories\CategoryRepository;

class CategoryService extends BaseService
{
    private $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
        parent::__construct();
    }

    public function getAllCategories()
    {
        return Category::all();
    }

    public function getById($id)
    {
        return $this->categoryRepository->get($id);
    }
}
