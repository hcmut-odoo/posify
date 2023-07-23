<?php

namespace App\Services;

use App\Repositories\ProductRepository;
use App\Repositories\CategoryRepository;

class ProductService extends BaseService
{
    private $productRepository;
    private $categoryRepository;

    public function __construct(ProductRepository $productRepository, CategoryRepository $categoryRepository)
    {
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
        parent::__construct();
    }

    public function getAll()
    {
        return $this->productRepository->getAll();
    }

    public function getCategory($productId)
    {
        $product = $this->productRepository->get($productId);
        if ($product) {
            $category = $this->categoryRepository->get($product->category_id);
            return $category ? $category->name : null;
        }
        return null;
    }

    public function pagination($perPage, $page)
    {
        return $this->productRepository->pagination($perPage, $page);
    }

    public function getProductById($id)
    {
        return $this->productRepository->get($id);
    }

    public function getByCategory($id)
    {
        return $this->productRepository->getByCategory($id);
    }

    public function search($keyword)
    {
        return $this->productRepository->search($keyword);
    }
}
