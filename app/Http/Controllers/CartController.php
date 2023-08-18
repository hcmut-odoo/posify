<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CartService;
use App\Services\OrderService;
use Illuminate\Support\Facades\Log;
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

        try {
            $this->cartService->addItem($productId, $cartId, $size, $note, $quantity);

            Session::flash('addItemMessage', 'Item was added successfully!');
        } catch (\Exception $e) {
            Session::flash('addItemMessage', $e->getMessage());
        }

        return redirect()->back();
    }

    public function remove(Request $request)
    {
        try {
            $this->cartService->removeItem($request->input('id'));

            Session::flash('message', 'Item was removed successfully!');
        } catch (\Exception $e) {
            Session::flash('message', 'Failed to remove item.');
        }

        return redirect()->back();
    }

    public function clear(Request $request)
    {
        try {
            $this->cartService->clear($request->user()->id);

            Session::flash('clearCartMessage', 'Cart was cleared successfully!');
        } catch (\Exception $e) {
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

        try {
            $this->cartService->editItem($items);

            Session::flash('message', 'Item was edited successfully!');
        } catch (\Exception $e) {
            Session::flash('message', $e->getMessage());
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
            'delivery_note' => $request->input('delivery_note'),
            'payment_method' => $request->input('payment_method')
        ];
        
        try {
            $this->orderService->placeOrder($userId, $orderData);
            return redirect()->route('cart.notice', [
                'status' => "Order success !",
                'message' => "Thank you for your purchase on our system."
            ]);
        } catch (\Exception $e) {
            return redirect()->route('cart.notice', [
                'status' => "Order failed !",
                'message' => $e->getMessage()
            ]);
        }
    }

    public function notice($status, $message)
    {
        return view('order_status', [
            'status' => $status,
            'message' => $message
        ]);
    }
}
