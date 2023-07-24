<?php

namespace App\Services;

use App\Repositories\OrderRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Repositories\OrderItemRepository;

class OrderService
{
    private $cartService;
    private $orderRepository;
    private $orderItemRepository;

    public function __construct(
        CartService $cartService,
        OrderRepository $orderRepository,
        OrderItemRepository $orderItemRepository
    )
    {
        $this->cartService = $cartService;
        $this->orderRepository = $orderRepository;
        $this->orderItemRepository = $orderItemRepository;
    }

    public function getOrders($userId)
    {
        $orders = DB::table('orders')
            ->where('user_id', $userId)
            ->orderBy('status', 'desc')
            ->orderBy('created_at', 'desc')
            ->get();

        return $orders;
    }

    public function getOrderItems($orderId)
    {
        $orderItems = DB::table('orders')
            ->join('order_items', 'order_items.order_id', '=', 'orders.id')
            ->join('cart_items', 'order_items.cart_item_id', '=', 'cart_items.id')
            ->join('products', 'products.id', '=', 'cart_items.product_id')
            ->where('orders.id', $orderId)
            ->get()
            ->toArray();

        return $orderItems;
    }

    public function placeOrder($userId, $orderData)
    {
        $cartItems = $this->cartService->getCartItems($userId);

        try {
            DB::beginTransaction();

            $order = $this->createOrder(
                $userId,
                $orderData['payment_method'],
                $orderData['delivery_name'],
                $orderData['delivery_phone'],
                $orderData['delivery_note'],
                $orderData['delivery_address']
            );

            foreach ($cartItems as $item) {
                $this->createOrderItem($item->id, $order->id);
            }

            foreach ($cartItems as $item) {
                $this->cartService->markToOder($item->id);
            }

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            return false;
        }
    }

    public function createOrder($userId, $paymentMethod, $deliveryName, $deliveryPhone, $deliveryNote, $deliveryAddress)
    {
        return $this->orderRepository->create(
            $userId,
            $paymentMethod,
            $deliveryName,
            $deliveryPhone,
            $deliveryNote,
            $deliveryAddress
        );
    }

    public function createOrderItem($cartItemId, $orderId)
    {
        $this->orderItemRepository->create($cartItemId, $orderId);
    }

    public function mapOrderStatus($status)
    {
        $statusMappings = [
            'processing' => 'Đang xử lý',
            'done' => 'Đã hoàn thành',
            'cancel' => 'Đã hủy',
        ];

        return isset($statusMappings[$status]) ? $statusMappings[$status] : '';
    }

    public function getById($orderId)
    {
        $this->orderItemRepository->get($orderId);
    }

    public function pagination($perPage, $page)
    {
        return $this->orderRepository->pagination([], ['*'], $perPage, $page);
    }
}
