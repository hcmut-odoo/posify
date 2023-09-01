<?php

namespace App\Services;

use App\Exceptions\InvalidParameterException;
use App\Exceptions\NotFoundException;
use App\Models\Invoice;
use App\Repositories\InvoiceRepository;
use App\Services\OrderService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class InvoiceService extends BaseService
{
    private $invoiceRepository;
    private $orderService;

    public function __construct(InvoiceRepository $invoiceRepository, OrderService $orderService)
    {
        $this->invoiceRepository = $invoiceRepository;
        $this->orderService = $orderService;
        parent::__construct();
    }

    public function createInvoice($orderId)
    {
        $order = $this->orderService->findById($orderId);
        $orderItems = $this->orderService->getOrderItems($orderId);
        $totalPrice = 0;

        foreach ($orderItems as $orderItem) {
            $totalPrice = $totalPrice + $orderItem->extend_price*$orderItem->quantity;
        }

        try {
            DB::beginTransaction();

            $invoice = $this->invoiceRepository->create($orderId, $totalPrice);
            $order->status = 'done';
            $order->save();

            DB::commit();
            return $invoice;
        } catch (\Exception $e) {
            DB::rollback();

            return false;
        }

    }

    public function getAll()
    {
        return $this->invoiceRepository->getAll();
    }

    public function findById($id)
    {
        if (!validate_id($id)) {
            throw new InvalidParameterException("Invalid invoice ID: $id");
        }
        $invoice = $this->invoiceRepository->get($id);
        if(!$invoice) {
            throw new NotFoundException("Not found invoice has ID: $id");
        }
        return $invoice;
    }

    public function pagination($criteria, $perPage, $page)
    {
        return $this->invoiceRepository->pagination($criteria, ['*'], $perPage, $page);
    }

    public function getInvoiceFormData($invoiceId)
    {
        $invoiceFormData = DB::table('invoices')
            ->where('invoices.id', '=', $invoiceId)
            ->join('orders', 'orders.id', '=', 'invoices.order_id')
            ->join('order_items', 'order_items.order_id', '=', 'invoices.order_id')
            ->join('cart_items', 'cart_items.id', '=', 'order_items.cart_item_id')
            ->join('product_variants', 'product_variants.id', '=', 'cart_items.product_variant_id')
            ->join('products', 'products.id', '=', 'cart_items.product_id')
            ->select(
                'cart_items.quantity',
                'cart_items.note',
                'product_variants.size',
                'products.name',
                'product_variants.extend_price',
                'products.price'
            )
            ->get();

        return $invoiceFormData;
    }

    public function getInvoiceDetailData($invoiceId)
    {
        $invoiceDetails = DB::table('invoices')
            ->where('invoices.id', '=', $invoiceId)
            ->join('orders', 'orders.id', '=', 'invoices.order_id')
            ->join('order_items', 'order_items.order_id', '=', 'invoices.order_id')
            ->join('cart_items', 'cart_items.id', '=', 'order_items.cart_item_id')
            ->join('product_variants', 'product_variants.id', '=', 'cart_items.product_variant_id')
            ->join('products', 'products.id', '=', 'cart_items.product_id')
            ->join('payment_modes', 'payment_modes.id', '=', 'orders.payment_mode_id')
            ->select(
                'invoices.id AS invoice_id', 'invoices.created_at AS invoice_created_at',
                'orders.payment_mode_id', 'orders.delivery_phone', 'orders.delivery_address',
                'orders.delivery_name', 'orders.id AS order_id', 'orders.created_at AS order_created_at',
                'orders.updated_at AS order_accepted_at', 'orders.order_transaction',
                'cart_items.quantity', 'cart_items.note', 'product_variants.size',
                'products.name', 'products.price', 'products.description AS product_description',
                'products.image_url AS product_image_url', 'products.id AS product_id',
                'payment_modes.name AS payment_mode'
            )
            ->get();

        return $invoiceDetails;
    }
}
