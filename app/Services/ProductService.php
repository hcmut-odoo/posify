<?php

namespace App\Services;

use App\Exceptions\DeleteFailedException;
use App\Exceptions\DuplicateEntryException;
use App\Repositories\ProductRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\ProductVariantRepository;
use App\Repositories\CartItemRepository;
use App\Exceptions\InvalidParameterException;
use App\Exceptions\NotFoundException;
use App\Exceptions\UpdateFailedException;
use App\Exceptions\NotEnoughStockException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductService extends BaseService
{
    private $productRepository;
    private $categoryRepository;
    private $productVariantRepository;
    private $cartItemRepository;

    public function __construct(
        ProductRepository $productRepository,
        CategoryRepository $categoryRepository,
        ProductVariantRepository $productVariantRepository,
        CartItemRepository $cartItemRepository
    )
    {
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
        $this->productVariantRepository = $productVariantRepository;
        $this->cartItemRepository = $cartItemRepository;
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

        $product = $this->productRepository->getProductWithVariant($id);
        if(!$product) {
            throw new NotFoundException("Not found product has ID: $id");
        }

        return $product;
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

        $barcode = Str::uuid()->toString();
        return $this->productRepository->create($categoryId, $name, $price, $description, $imageUrl, $barcode);
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

    public function createProductVariant(array $data)
    {
        $productId = $data['product_id'];
        $quantity = $data['stock_qty'];
        $price = $data['extend_price'];
        $size = $data['size'];
        $color = $data['color'];

        $isProductExist= $this->productRepository->get($productId);
        if (!$isProductExist) {
            throw new NotFoundException("Product not found");
        }

        if ($size) {
            if ($color) {
                $existingVariant = $this->productVariantRepository->findBySizeAndColor($productId, $size, $color);
            } else {
                $existingVariant = $this->productVariantRepository->findByProductIdAndSize($productId, $size);
            }
        }

        if ($existingVariant) {
            throw new DuplicateEntryException("Product variant can not have the same attribute");
        }

        $variantBarcode = Str::uuid()->toString();
        return $this->productVariantRepository->create($productId, $size, $price, $color, $quantity, $variantBarcode);
    }

    public function deleteProductVariant($id)
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

    public function getProductVariantByProductId($productId)
    {
        if (!validate_id($productId)) {
            throw new InvalidParameterException("Invalid product ID: $productId");
        }

        $productVariants = $this->productVariantRepository->findByProductId($productId);
        if (!$productVariants) {
            throw new NotFoundException("Not found product variant has product ID: $productId");
        }

        return $productVariants;
    }

    public function updateProductVariant($data)
    {
        if (!isset($data['id']) && !isset($data['variant_barcode'])) {
            throw new InvalidParameterException("Product variant must have an identifying field (id or variant_barcode).");
        }

        $identifyField = isset($data['id']) ? $data['id'] : (isset($data['variant_barcode']) ? $data['variant_barcode'] : null);
        $productVariantQty = $data["stock_qty"];

        if ($productVariantQty < 0) {
            throw new InvalidParameterException("Product variant quantity must be larger than zero: $productVariantQty");
        }

        if (isset($data['id']) && !$this->productVariantRepository->get($identifyField)) {
            throw new NotFoundException("Not found product variant with ID: $identifyField");
        } elseif (isset($data['variant_barcode']) && !$this->productVariantRepository->getByBarcode($identifyField)) {
            throw new NotFoundException("Not found product variant with barcode: $identifyField");
        }

        if ($this->productVariantRepository->update($data)) {
            if (isset($data['id'])) {
                return $this->productVariantRepository->get($identifyField);
            }

            return $this->productVariantRepository->getByBarcode($identifyField);
        } else {
            throw new UpdateFailedException("Update failed for product variant with ID: $identifyField");
        }
    }


    public function getProductVariant($id)
    {
        if (!validate_id($id)) {
            throw new InvalidParameterException("Invalid product variant ID: $id");
        }

        $productVariant = $this->productVariantRepository->get($id);
        if (!$productVariant) {
            throw new NotFoundException("Not found product variant has ID: $id");
        }

        return $productVariant;
    }

    public function getQuantityOfProductVariant($productVariantId)
    {
        if (!validate_id($productVariantId)) {
            throw new InvalidParameterException("Invalid product ID: $productVariantId");
        }

        $productVariant = $this->getProductVariant($productVariantId);

        return $productVariant->stock_qty;
    }

    public function findProductVariant($productId, $size)
    {
        if (!validate_id($productId)) {
            throw new InvalidParameterException("Invalid product ID: $productId");
        }

        $productVariant = $this->productVariantRepository->findByProductIdAndSize($productId, $size);
        if (!$productVariant) {
            throw new NotFoundException("Not found product variant has product ID: $productId and size: $size");
        }

        return $productVariant;
    }

    public function keepProductVariant($productVariantId, $requestQuantity)
    {
        if (!validate_id($productVariantId)) {
            throw new InvalidParameterException("Invalid product variant ID: $productVariantId");
        }

        try {
            DB::beginTransaction();

            $productVariant = $this->productVariantRepository->getForUpdate($productVariantId);

            if (!$productVariant) {
                throw new NotFoundException("Not found product variant with ID: $productVariantId");
            }

            $currentQuantity = $productVariant->stock_qty;

            if ($currentQuantity < $requestQuantity) {
                throw new NotEnoughStockException("Insufficient stock for product variant with ID: $productVariantId");
            }

            $newQuantity = $currentQuantity - $requestQuantity;

            $productVariant->stock_qty = $newQuantity;
            $productVariant->save();

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }

    public function unKeepProductVariant($productVariantId, $returnQuantity)
    {
        if (!validate_id($productVariantId)) {
            throw new InvalidParameterException("Invalid product variant ID: $productVariantId");
        }

        try {
            DB::beginTransaction();

            $productVariant = $this->productVariantRepository->getForUpdate($productVariantId);

            if (!$productVariant) {
                throw new NotFoundException("Not found product variant with ID: $productVariantId");
            }

            $currentQuantity = $productVariant->stock_qty;
            $newQuantity = $currentQuantity + $returnQuantity;

            $productVariant->stock_qty = $newQuantity;
            $productVariant->save();

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }
}
