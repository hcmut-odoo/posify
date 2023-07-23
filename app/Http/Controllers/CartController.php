<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CartService;
use App\Services\OrderService;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    private $cartService;
    private $orderService;

    public function __construct(CartService $cartService, OrderService $orderService)
    {
        $this->cartService = $cartService;
        $this->orderService = $orderService;
    }

    public function add(Request $request)
    {
        $productId = $request->input("product_id");
        $size = $request->input("size");
        $note = $request->input("note");
        $quantity = $request->input("quantity");
        $cartId = $request->input("cart_id");

        $isAdded = $this->cartService->addItem($productId, $cartId, $size, $note, $quantity);
        if ($isAdded) {
            Session::flash('addItemMessage', 'Item was added successfully!');
        } else {
            Session::flash('addItemMessage', 'Failed to add item.');
        }

        return redirect()->back();
    }

    public function remove(Request $request)
    {
        $isRemoved = $this->cartService->removeItem($request->input('id'));
        if ($isRemoved) {
            Session::flash('removeItemMessage', 'Item was removed successfully!');
        } else {
            Session::flash('removeItemMessage', 'Failed to remove item.');
        }

        return redirect()->back();
    }

    public function clear(Request $request)
    {
       $isCleared = $this->cartService->clear($request->user()->id);
        if ($isCleared) {
            Session::flash('clearCartMessage', 'Cart was cleared successfully!');
        } else {
            Session::flash('clearCartMessage', 'Failed to clear cart.');
        }

        return redirect()->back();
    }

    public function show(Request $request)
    {
        $items = $this->cartService->getCartItems($request->user()->id);

        return view('cart', [
            'items' => $items
        ]);
    }

    public function edit(Request $request)
    {
        $items = [
            'id' => $request->input("id"),
            'size' => $request->input("size"),
            'note' => $request->input("note"),
            'quantity' => $request->input("quantity")
        ];

        $isEdited = $this->cartService->editItem($items);

        if ($isEdited) {
            Session::flash('updateItemMessage', 'Item was edited successfully!');
        } else {
            Session::flash('updateItemMessage', 'Failed to edit item.');
        }
        return redirect()->back();
    }

    public function order(Request $request)
    {
        $orders = $this->orderService->getOrders($request->user()->id);

        foreach ($orders as $order) {
            if ($order->status == 'done' || $order->status == 'cancel') {
                $order->display = 'none';
                $order->save();
            }
        }

        return redirect()->route('orders')->with('success', 'Order placed successfully!');
    }

    public function placeOrder(Request $request)
    {
        $userId = $request->user()->id;
        $orderData = [
            'delivery_name' => $request->input('delivery_name'),
            'delivery_phone' => $request->input('delivery_phone'),
            'delivery_address' => $request->input('delivery_address'),
            'payment_method' => $request->input('payment_method')
        ];

        $isOrdered = $this->orderService->placeOrder($userId, $orderData);
        if ($isOrdered) {
            return redirect()->route('cart.notice', [
                'status' => "Order success !",
                'message' => "Thank you for your purchase on our system."
            ]);
        }

        return redirect()->route('cart.notice', [
            'status' => "Order failed !",
            'message' => "Sorry for not being able to order right now."
        ]);
    }

    public function notice($status, $message)
    {
        return view('order_status', [
            'status' => $status,
            'message' => $message
        ]);
    }
}
