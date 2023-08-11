<?php

namespace App\Services;

use App\Exceptions\InvalidParameterException;
use Illuminate\Support\Facades\DB;
use App\Repositories\CartRepository;
use App\Repositories\CartItemRepository;
use App\Repositories\ProductVariantRepository;
use App\Services\ProductService;

class CartService extends BaseService
{
    private $cartRepository;
    private $cartItemRepository;
    private $productVariantRepository;
    private $productService;

    public function __construct(
        CartRepository $cartRepository,
        CartItemRepository $cartItemRepository,
        ProductService $productService,
        ProductVariantRepository $productVariantRepository
    )
    {
        $this->cartRepository = $cartRepository;
        $this->cartItemRepository = $cartItemRepository;
        $this->productService = $productService;
        $this->productVariantRepository = $productVariantRepository;
        parent::__construct();
    }

    public function addItem($productId, $cartId, $size, $note, $quantity)
    {
        // Check and decrease stock_qty of product variant
        try {
            if ($cartId && !$this->cartRepository->isContain($cartId)) {
                $cartId = $this->cartRepository->new()->id;
            }

            $productVariant = $this->productService->findProductVariant($productId, $size);
            $this->productService->keepProductVariant($productVariant->id, $quantity);

            $duplicateItem = $this->cartItemRepository->search([
                'cart_id' => $cartId,
                'product_id' => $productId,
                'product_variant_id' => $productVariant->id,
                'note' => false
            ]);
    
            if ($duplicateItem) {
                return $this->cartItemRepository->update([
                    'id' => $duplicateItem->id,
                    'quantity' => $duplicateItem->quantity + $quantity
                ]);
            }
    
            return $this->cartItemRepository->create($productId, $cartId, $productVariant->id, $note, $quantity);
        } catch (\Exception $e) {
            return false;
        }

    }

    public function markToOder($itemId)
    {
        if($this->cartItemRepository->update(['id' => $itemId, 'stamp' => false])) {
            return true;
        }
        return false;
    }

    public function removeItem($cartItemId)
    {
        if (!validate_id($cartItemId)) {
            throw new InvalidParameterException("Invalid cart item ID: $cartItemId");
        }

        // Update remain stock quantity
        try {
            $cartItem = $this->cartItemRepository->get($cartItemId);
            $this->productService->unKeepProductVariant($cartItem->product_variant_id, $cartItem->quantity);
        } catch (\Exception $e) {
            return false;
        }

        if($this->cartItemRepository->remove($cartItemId)) {
            return true;
        }
        return false;
    }

    public function editItem($data)
    {
        try {
            DB::beginTransaction();

            $cartItem = $this->cartItemRepository->get($data['id']);
            $currentProductVariant = $this->productVariantRepository->get($cartItem->product_variant_id);

            $currentQuantityInCart = $cartItem->quantity;
            $currentSize = $currentProductVariant->size;
            $productId = $currentProductVariant->product_id;
            
            $newSize = $data['size'];
            $newRequestQuantity = $data['quantity'];
            $finalyProductVariantId = $currentProductVariant->id;
            $isUpdated = false;

            if ($newSize !== $currentSize) {
                // Update stock remain quantity with current size
                $this->productService->unKeepProductVariant($currentProductVariant->id, $currentQuantityInCart);

                // Update stock remain quantity with new size
                $newProductVariant = $this->productService->findProductVariant($productId, $newSize);
                $this->productService->keepProductVariant($newProductVariant->id, $newRequestQuantity);

                // Update product variant id
                $finalyProductVariantId = $newProductVariant->id;
            } else {
                // Update stock remain quantity with new size
                $differentQuantity = $newRequestQuantity - $currentQuantityInCart;

                if ($differentQuantity > 0) {
                    $this->productService->keepProductVariant($currentProductVariant->id, abs($differentQuantity));
                }
                
                if ($differentQuantity < 0) {
                    $this->productService->unKeepProductVariant($currentProductVariant->id, abs($differentQuantity));
                }
            }

            $isUpdated = $this->cartItemRepository->update([
                'id' => $data['id'],
                'product_variant_id' => $finalyProductVariantId,
                'note' => $data['note'],
                'quantity' => $data['quantity']
            ]);

            if($isUpdated) {
                DB::commit();
                return true;
            }

            return false;
        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }

    public function getCartItem($cartItemId)
    {
        if (!validate_id($cartItemId)) {
            throw new InvalidParameterException("Invalid cart item ID: $cartItemId");
        }
        return $this->cartItemRepository->get($cartItemId);
    }

    public function clear($userId)
    {
        if (!validate_id($userId)) {
            throw new InvalidParameterException("Invalid user ID: $userId");
        }
        $cartId = DB::table('carts')->where('user_id', $userId)->get()->id;
        DB::beginTransaction();
        try {
            DB::table('cart_items')->where('cart_id', $cartId)->delete();
            DB::commit();

            return true;
        } catch (\Exception $e) {
            DB::rollback();

            return false;
        }
    }

    public function getCartItems($cartId)
    {
        if (!validate_id($cartId)) {
            throw new InvalidParameterException("Invalid cart ID: $cartId");
        }

        $items = DB::table('cart_items')
            ->join('products', 'cart_items.product_id', '=', 'products.id')
            ->join('product_variants', 'cart_items.product_variant_id', '=', 'product_variants.id')
            ->where('cart_items.cart_id', $cartId, 'and')
            ->where('cart_items.stamp', true)
            ->where('cart_items.deleted_at', null)
            ->select(
                'cart_items.id as id',
                'cart_items.product_id',
                'cart_items.quantity',
                'product_variants.size',
                'products.name',
                'products.price',
                'product_variants.extend_price',
                'products.category_id',
                'cart_items.note' ,
                'products.image_url',
                'products.description'
            )
            ->get();

        return $items;
    }
}
