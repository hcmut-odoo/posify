<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Order;
use App\Services\CartService;
use App\Services\OrderService;
use App\Services\InvoiceService;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    private $cartService;
    private $orderService;
    private $invoiceService;

    public function __construct(
        CartService $cartService,
        OrderService $orderService,
        InvoiceService $invoiceService
    )
    {
        $this->cartService = $cartService;
        $this->orderService = $orderService;
        $this->invoiceService = $invoiceService;
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
        $orderId = $request->input('id');
        if ($this->invoiceService->createInvoice($orderId)) {
            Session::flash('message', 'Invoice was created successfully!');
        } else {
            Session::flash('message', 'Failed to create invoice.');
        }
        return redirect()->back();
    }

    public function rejectOrder(Request $request)
    {
        $orderId = $request->input('id');
        if ($this->orderService->rejectOrder($orderId)) {
            Session::flash('message', 'Order was rejected successfully!');
        } else {
            Session::flash('message', 'Failed to reject order.');
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

        return view('order_detail', [
            'orders' => $orderItems
        ]);
    }

    public function adminViewOrderDetail(Request $request, $id)
    {
        $orderItems = $this->orderService->getOrderItems($id);

        return view('/admin/orders/order_detail', [
            'items' => $orderItems
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
