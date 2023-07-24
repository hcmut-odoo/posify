<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use App\Models\Cart;
use App\Models\CartItem;
use App\Repositories\CartRepository;
use App\Repositories\CartItemRepository;
use Illuminate\Support\Facades\Log;

class CartService extends BaseService
{
    private $cartRepository;
    private $cartItemRepository;

    public function __construct(CartRepository $cartRepository, CartItemRepository $cartItemRepository)
    {
        $this->cartRepository = $cartRepository;
        $this->cartItemRepository = $cartItemRepository;
        parent::__construct();
    }

    public function addItem($productId, $cartId, $size, $note, $quantity)
    {
        if ($cartId && !$this->cartRepository->isContain($cartId)) {
            $cartId = $this->cartRepository->new()->id;
        }

        $duplicateItem = $this->cartItemRepository->search([
            'cart_id' => $cartId,
            'product_id' => $productId,
            'size' => $size,
            'note' => false
        ]);

        if ($duplicateItem) {
            return $this->cartItemRepository->update([
                'id' => $duplicateItem->id,
                'quantity' => $duplicateItem->quantity + $quantity
            ]);
        }

        return $this->cartItemRepository->create($productId, $cartId, $size, $note, $quantity);
    }

    public function markToOder($itemId)
    {
        if($this->cartItemRepository->update(['id' => $itemId, 'stamp' => false])) {
            return true;
        }
        return false;
    }

    public function removeItem($itemId)
    {
        if($this->cartItemRepository->remove($itemId)) {
            return true;
        }
        return false;
    }

    public function editItem($data)
    {
        if($this->cartItemRepository->update($data)) {
            return true;
        }
        return false;
    }

    public function getCartItem($cartItemId)
    {
        return $this->cartItemRepository->get($cartItemId);
    }

    public function clear($userId)
    {
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
        $items = DB::table('cart_items')
            ->join('products', 'cart_items.product_id', '=', 'products.id')
            ->where('cart_items.cart_id', $cartId, 'and')
            ->where('cart_items.stamp', true)
            ->where('cart_items.deleted_at', null)
            ->select(
                'cart_items.id as id',
                'cart_items.product_id',
                'cart_items.quantity',
                'cart_items.size',
                'products.name',
                'products.price',
                'products.category_id',
                'cart_items.note' ,
                'products.image_url',
                'products.description'
            )
            ->get();

        return $items;
    }
}
