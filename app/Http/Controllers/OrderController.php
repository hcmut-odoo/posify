<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Order;
use App\Services\CartService;
use App\Services\OrderService;

class OrderController extends Controller
{
    private $cartService;
    private $orderService;

    public function __construct(CartService $cartService, OrderService $orderService)
    {
        $this->cartService = $cartService;
        $this->orderService = $orderService;
    }

    public function orders(Request $request)
    {
        $userId = $request->user()->id;
        $orders = $this->orderService->getOrders($userId);

        // Add numerical order field
        $ordersWithNumericalOrder = $orders->map(function ($order, $index) {
            $order->numerical_order = $index + 1;
            $order->status_label = $this->orderService->mapOrderStatus($order->status);
            return $order;
        });

        return view('orders', ['orders' => $ordersWithNumericalOrder]);
    }

    public function index()
    {
        $orders = Order::getAllOrders('processing');

        return view('admin.orders.orders', [
            'orders' => $orders,
        ]);
    }

    public function accept(Request $request)
    {
        $orderId = $request->input('id');
        $orderModel = Order::getOrderById($orderId);
        if ($request->getMethod() === 'get') {
            $orderModel->setStatus('done');
            $orderModel->update($orderModel);
            return redirect('/admin/orders');
        }
    }

    public function reject(Request $request)
    {
        $orderId = $request->input('id');
        $orderModel = Order::getOrderById($orderId);
        if ($request->getMethod() === 'get') {
            $orderModel->setStatus('cancel');
            $orderModel->update($orderModel);
            return redirect('/admin/orders');
        }
    }

    public function accepted()
    {
        $orders = Order::getAllOrders('done');

        return view('admin.orders.accept_orders', [
            'orders' => $orders,
        ]);
    }

    public function rejected()
    {
        $orders = Order::getAllOrders('cancel');

        return view('admin.orders.reject_orders', [
            'orders' => $orders,
        ]);
    }

    public function delete(Request $request)
    {
        $path = $request->getPathInfo();
        $orderId = $request->input('id');
        $orderModel = Order::getOrderById($orderId);
        if ($request->getMethod() === 'get') {
            $orderModel->delete();
            if (strpos($path, 'reject')) {
                return redirect('/admin/orders/rejected');
            } else {
                return redirect('/admin/orders/accepted');
            }
        }
    }

    public function details($id)
    {
        $orders = $this->orderService->getOrderItems($id);
        // dd($orders);
        return view('order_detail', [
            'orders' => $orders
        ]);
    }

    public function clear()
    {
        $userId = auth()->user()->id;
        $orders = Order::getOrders($userId);

        foreach ($orders as $order) {
            if ($order->getStatus() == 'done' || $order->getStatus() == 'cancel') {
                $order->setDisplay('none');
                $order->update($order);
            }
        }

        return redirect('orders');
    }
}
