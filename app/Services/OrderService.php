<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Repositories\CartItemRepository;
use App\Repositories\OrderRepository;
use App\Repositories\OrderItemRepository;
use App\Repositories\UserRepository;
use App\Exceptions\InvalidParameterException;
use App\Exceptions\NotFoundException;
use Exception;

class OrderService extends BaseService
{
    private $cartService;
    private $orderRepository;
    private $orderItemRepository;
    private $cartItemRepository;
    private $userRepository;

    public function __construct(
        CartService $cartService,
        OrderRepository $orderRepository,
        OrderItemRepository $orderItemRepository,
        CartItemRepository $cartItemRepository,
        UserRepository $userRepository
    )
    {
        $this->cartService = $cartService;
        $this->orderRepository = $orderRepository;
        $this->orderItemRepository = $orderItemRepository;
        $this->cartItemRepository = $cartItemRepository;
        $this->userRepository = $userRepository;
        parent::__construct();
    }

    public function getOrders($userId)
    {
        if (!validate_id($userId)) {
            throw new InvalidParameterException("Invalid order ID: $userId");
        }
        $orders = DB::table('orders')
            ->where('user_id', $userId)
            ->orderBy('status', 'desc')
            ->orderBy('created_at', 'desc')
            ->get();

        return $orders;
    }

    public function getOrderItems($orderId)
    {
        if (!validate_id($orderId)) {
            throw new InvalidParameterException("Invalid order ID: $orderId");
        }
        $orderItems = DB::table('orders')
            ->join('order_items', 'order_items.order_id', '=', 'orders.id')
            ->join('cart_items', 'order_items.cart_item_id', '=', 'cart_items.id')
            ->join('products', 'products.id', '=', 'cart_items.product_id')
            ->join('product_variants', 'product_variants.id', '=', 'cart_items.product_variant_id')
            ->where('orders.id', $orderId)
            ->get()
            ->toArray();

        return $orderItems;
    }

    public function placeOrder($userId, $orderData)
    {
        if (!validate_id($userId)) {
            throw new InvalidParameterException("Invalid user ID: $userId");
        }
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
        $parameters = compact('paymentMethod', 'deliveryName', 'deliveryPhone', 'deliveryAddress');
        if (!validate_id($userId)) {
            throw new InvalidParameterException();
        }
        foreach ($parameters as $parameter) {
            if (!validate_parameter($parameter)) {
                throw new InvalidParameterException();
            }
        }
        $user = $this->userRepository->get($userId);
        if (!$user) {
            throw new NotFoundException("User not found with ID: $userId");
        }
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
        if (!validate_id($cartItemId) || !validate_id($orderId)) {
            throw new InvalidParameterException();
        }
        $cartItem = $this->cartItemRepository->get($cartItemId);
        if (!$cartItem) {
            throw new NotFoundException("Cart item not found with ID: $cartItemId");
        }
        $order = $this->orderRepository->get($orderId);
        if (!$order) {
            throw new NotFoundException("Order not found with ID: $orderId");
        }
        return $this->orderItemRepository->create($cartItemId, $orderId);
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

    public function findById($orderId)
    {
        if (!validate_id($orderId)) {
            throw new InvalidParameterException("Invalid order ID: $orderId");
        }
        return $this->orderRepository->get($orderId);
    }

    public function getOrderDetail($orderId)
    {
        if (!validate_id($orderId)) {
            throw new InvalidParameterException("Invalid order ID: $orderId");
        }

        $orderItems = $this->getOrderItems($orderId);
        $orderRecord = $this->orderRepository->get($orderId);

        $orderRecord->order_rows = $orderItems;

        return $orderRecord;
    }

    public function rejectOrder($orderId)
    {
        if (!validate_id($orderId)) {
            throw new InvalidParameterException("Invalid order ID: $orderId");
        }
        $order = $this->orderRepository->get($orderId);
        $order->status = 'cancel';
        try {
            $order->save();
            return true;
        } catch (\Exception $e) {
            throw new Exception("Error while updating order status: " . $e->getMessage());
            return false;
        }
    }

    public function pagination($criteria, $perPage, $page)
    {
        return $this->orderRepository->pagination($criteria, ['*'], $perPage, $page);
    }
}
