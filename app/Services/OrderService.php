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
use App\Repositories\PaymentModeRepository;
use Exception;

class OrderService extends BaseService
{
    private $cartService;
    private $orderRepository;
    private $orderItemRepository;
    private $cartItemRepository;
    private $userRepository;
    private $paymentModeRepository;

    public function __construct(
        CartService $cartService,
        OrderRepository $orderRepository,
        OrderItemRepository $orderItemRepository,
        CartItemRepository $cartItemRepository,
        UserRepository $userRepository,
        PaymentModeRepository $paymentModeRepository
    )
    {
        $this->cartService = $cartService;
        $this->orderRepository = $orderRepository;
        $this->orderItemRepository = $orderItemRepository;
        $this->cartItemRepository = $cartItemRepository;
        $this->userRepository = $userRepository;
        $this->paymentModeRepository = $paymentModeRepository;
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
            ->join('payment_modes', 'payment_modes.id', '=', 'orders.id')
            ->select(
                'orders.*',
                'order_items.*',
                'cart_items.*',
                'products.*',
                'product_variants.*',
                'payment_modes.name AS payment_mode',
                'payment_modes.id AS payment_mode_id',
            )
            ->where('orders.id', $orderId)
            ->get()
            ->toArray();

        return $orderItems;
    }

    public function getPaymentModes()
    {
        return $this->paymentModeRepository->getAll();
    }

    public function getPaymentModeByName($name)
    {
        return $this->paymentModeRepository->findByName($name);
    }

    public function getPaymentModeById($id)
    {
        return $this->paymentModeRepository->get($id);
    }

    public function placeOrder($userId, $orderData)
    {
        if (!validate_id($userId)) {
            throw new InvalidParameterException("Invalid user ID: $userId");
        }

        $cartItems = $this->cartService->getCartItems($userId);

        try {
            DB::beginTransaction();

            $paymentMode = $this->paymentModeRepository->findByName(
                $orderData['payment_mode']
            );

            if (!$paymentMode) {
                throw new NotFoundException("Payment mode $paymentMode not found");
            }

            $order = $this->createOrder(
                $userId,
                $paymentMode->id,
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
            throw $e;
            return false;
        }
    }

    public function createOrder($userId, $paymentModeId, $deliveryName, $deliveryPhone, $deliveryNote, $deliveryAddress)
    {
        $parameters = compact('paymentModeId', 'deliveryName', 'deliveryPhone', 'deliveryAddress');

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
            $paymentModeId,
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

        $orderRows = [];
        foreach ($orderItems as $orderRow) {
            // Collect user data
            $user['id'] = $orderRow->user_id;

            // Collect product variant data
            $variant['id'] = $orderRow->product_variant_id;
            $variant['product_id'] = $orderRow->product_id;
            $variant['extend_price'] = $orderRow->extend_price;
            $variant['size'] = $orderRow->size;

            // Collect product data
            $product['id'] = $orderRow->product_id;
            $product['variant_id'] = $orderRow->product_variant_id;
            $product['price'] = $orderRow->price;
            $product['description'] = $orderRow->description;
            $product['name'] = $orderRow->name;
            $product['variant'] = $variant;

            // Collect payment data
            $payment['id'] = $orderRow->payment_mode_id;
            $payment['name'] = $orderRow->payment_mode_name;

            // Collect delivery data
            $delivery['delivery_note'] = $orderRow->delivery_note;
            $delivery['delivery_phone'] = $orderRow->delivery_phone;
            $delivery['delivery_address'] = $orderRow->delivery_address;
            $delivery['delivery_name'] = $orderRow->delivery_name;

            // Add these information as sub association data
            $order['product'] = $product;
            $order['delivery'] = $delivery;
            $order['user'] = $user;
            $order['payment'] = $payment;

            $orderRows[] = $order;
        }

        $orderRecord = $this->orderRepository->get($orderId);

        $orderRecord->order_rows = $orderRows;

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
