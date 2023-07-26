<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Exceptions\DeleteFailedException;
use App\Exceptions\DuplicateEntryException;
use App\Repositories\CategoryRepository;
use App\Repositories\ProductRepository;
use App\Services\ProductService;
use App\Exceptions\InvalidParameterException;
use App\Exceptions\NotFoundException;
use App\Exceptions\UpdateFailedException;

class CategoryService extends BaseService
{
    private $categoryRepository;
    private $productService;
    private $productRepository;

    public function __construct(
        CategoryRepository $categoryRepository,
        ProductService $productService,
        ProductRepository $productRepository
    )
    {
        $this->categoryRepository = $categoryRepository;
        $this->productService = $productService;
        $this->productRepository = $productRepository;
        parent::__construct();
    }

    public function getAllCategories()
    {
        return $this->categoryRepository->getAll();
    }

    public function findById($id)
    {
        if(!validate_id($id)) {
            throw new InvalidParameterException("Invalid category ID: $id");
        }
        $category = $this->categoryRepository->get($id);
        if (!$category) {
            throw new NotFoundException("Not found category has ID: $id");
        }
        return $category;
    }

    public function createCategory(array $data)
    {
        $name = $data['name'];
        if ($this->categoryRepository->findByName($name)) {
            throw new DuplicateEntryException("Category $name is already exist");
        }
        return $this->categoryRepository->create($name);
    }

    public function updateCategory($data)
    {
        $categoryId = $data['id'];
        if (!$this->categoryRepository->get($categoryId)) {
            throw new NotFoundException("Not found category has ID: $categoryId");
        }
        if ($this->categoryRepository->update($data)) {
            return $this->categoryRepository->get($categoryId);
        } else {
            throw new UpdateFailedException("Update failed category record has ID: $categoryId");
        }
    }

    public function deleteCategory($id)
    {
        if(!validate_parameter($id) || intval($id) <= 0) {
            throw new InvalidParameterException();
        }
        if($this->productService->findByCategory($id)) {
            return false;
        }
        if (!$this->categoryRepository->remove($id)) {
            throw new DeleteFailedException("Failed to delete category has ID: $id");
        }
    }

    public function deleteCategoryCascade($id)
    {
        if(!validate_parameter($id) || intval($id) <= 0) {
            throw new InvalidParameterException();
        }

        $productOfCategory = $this->productService->findByCategory($id);
        if(count($productOfCategory) === 0) {
            return $this->categoryRepository->remove($id);
        }

        DB::beginTransaction();
        try {
            foreach ($productOfCategory as $product) {
                $this->productRepository->remove($product->id);
            }
            $this->categoryRepository->remove($id);
            DB::commit();

            return true;
        } catch (\Exception $e) {
            DB::rollback();

            return false;
        }
    }
}
