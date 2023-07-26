<?php

namespace App\Services;

use App\Exceptions\DeleteFailedException;
use App\Exceptions\DuplicateEntryException;
use App\Repositories\ProductRepository;
use App\Repositories\CategoryRepository;
use App\Exceptions\InvalidParameterException;
use App\Exceptions\NotFoundException;
use App\Exceptions\UpdateFailedException;

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
        if (!validate_id($productId)) {
            throw new InvalidParameterException("Invalid product ID: $productId");
        }

        $product = $this->productRepository->get($productId);
        if(!$product) {
            throw new NotFoundException("Not found product has ID: $productId");
        }

        return $this->categoryRepository->get($product->category_id);;
    }

    public function pagination($perPage, $page)
    {
        return $this->productRepository->pagination($perPage, $page);
    }

    public function findById($id)
    {
        if (!validate_id($id)) {
            throw new InvalidParameterException("Invalid product ID: $id");
        }

        $user = $this->productRepository->get($id);
        if(!$user) {
            throw new NotFoundException("Not found product has ID: $id");
        }

        return $user;
    }

    public function findByCategory($id)
    {
        if (!validate_id($id)) {
            throw new InvalidParameterException("Invalid cateogry ID: $id");
        }
        return $this->productRepository->findByCategory($id);
    }

    public function search($keyword)
    {
        return $this->productRepository->search($keyword);
    }

    public function createProduct(array $data)
    {
        $categoryId = $data['category_id'];
        $name = $data['name'];
        $description = $data['description'];
        $price = $data['price'];
        $imageUrl = $data['image_url'];

        if (!$this->categoryRepository->get($categoryId)) {
            throw new NotFoundException("Category not found");
        }

        $existingProduct = $this->productRepository->findByName($name);
        if ($existingProduct && $existingProduct->category_id == $categoryId && $existingProduct->name === $name) {
            throw new DuplicateEntryException("Product can not have the same name `$name` and cateogry has ID $categoryId");
        }

        return $this->productRepository->create($categoryId, $name, $price, $description, $imageUrl);
    }

    public function updateProduct($data)
    {
        $productId = $data['id'];
        $categoryId = $data['category_id'];

        if (!$this->productRepository->get($data['id'])) {
            throw new NotFoundException("Not found product has ID: $productId");
        }

        if (!$this->categoryRepository->get($data['category_id'])) {
            throw new NotFoundException("Not found category has ID: $categoryId");
        }

        if ($this->productRepository->update($data)) {
            return $this->productRepository->get($productId);
        } else {
            throw new UpdateFailedException("Update failed category record has ID: $categoryId");
        }
    }

    public function deleteProduct($id)
    {
        if (!validate_id($id)) {
            throw new InvalidParameterException("Invalid product ID: $id");
        }
        if(!$this->productRepository->get($id)) {
            throw new NotFoundException("Not found product has ID: $id");
        }
        if (!$this->productRepository->remove($id)) {
            throw new DeleteFailedException("Failed to delete product has ID: $id");
        }
    }
}
