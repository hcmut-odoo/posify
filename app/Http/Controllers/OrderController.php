<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Order;
use App\Services\OrderService;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    private $orderService;

    public function __construct(OrderService $orderService)
    {
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

    public function index(Request $request)
    {
        $page = $request->query('page', 1);
        $perPage = $request->query('length', 15);
        $orders = $this->orderService->pagination(['status' => 'processing'], $perPage, $page);

        return view('/admin/orders/order_index', [
            'orders' => $orders,
            'per_page' => $perPage,
            'page' => $page
        ]);
    }

    public function acceptOrder(Request $request)
    {
        try {
            $orderId = $request->input('id');
            $this->orderService->transformOrder($orderId, 'done');
            Session::flash('message', 'Order was transform successfully!');
        } catch (\Exception $e) {
            Session::flash('message', $e->getMessage());
        }

        return redirect()->back();
    }


    public function rejectOrder(Request $request)
    {
        $orderId = $request->input('id');

        try {
            $this->orderService->rejectOrder($orderId);

            Session::flash('message', 'Order was rejected successfully!');
        } catch (\Exception $e) {
            Session::flash('message', $e->getMessage());
        }

        return redirect()->back();
    }

    public function acceptedOrderIndex(Request $request)
    {
        $page = $request->query('page', 1);
        $perPage = $request->query('length', 15);
        $acceptedOrders = $this->orderService->pagination(['status' => 'done'], $perPage, $page);

        return view('/admin/orders/order_accepted', [
            'items' => $acceptedOrders,
        ]);
    }

    public function rejectedOrderIndex(Request $request)
    {
        $page = $request->query('page', 1);
        $perPage = $request->query('length', 15);
        $rejectedOrders = $this->orderService->pagination(['status' => 'cancel'], $perPage, $page);

        return view('/admin/orders/order_rejected', [
            'items' => $rejectedOrders,
        ]);
    }

    public function acceptedOrderDetail(Request $request, $id)
    {
        $acceptedOrders = $this->orderService->getOrderItems($id);

        return view('/admin/orders/order_detail', [
            'items' => $acceptedOrders,
        ]);
    }

    public function rejectedOrderDetail(Request $request, $id)
    {
        $rejectedOrders = $this->orderService->getOrderItems($id);

        return view('/admin/orders/order_detail', [
            'items' => $rejectedOrders,
        ]);
    }

    public function rejected()
    {
        $orders = Order::getAllOrders('cancel');

        return view('admin.orders.reject_orders', [
            'orders' => $orders,
        ]);
    }

    public function deleteOrder(Request $request)
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

    public function userViewOrderDetail(Request $request, $id)
    {
        $orderItems = $this->orderService->getOrderItems($id);
        $order = $this->orderService->findById($id);

        return view('order_detail', [
            'orders' => $orderItems,
            'order' => $order
        ]);
    }

    public function adminViewOrderDetail(Request $request, $id)
    {
        $orderItems = $this->orderService->getOrderItems($id);
        $order = $this->orderService->findById($id);

        return view('/admin/orders/order_detail', [
            'items' => $orderItems,
            'order' => $order
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
