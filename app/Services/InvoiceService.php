<?php

namespace App\Services;

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
        $order = $this->orderService->getById($orderId);
        $orderItems = $this->orderService->getOrderItems($orderId);
        $totalPrice = 0;

        foreach ($orderItems as $orderItem) {
            $totalPrice = $totalPrice + $orderItem->price;
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

    public function getById($id)
    {
        return $this->invoiceRepository->get($id);
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
            ->join('products', 'products.id', '=', 'cart_items.product_id')
            ->select(
                'cart_items.quantity',
                'cart_items.note',
                'cart_items.size',
                'products.name',
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
            ->join('products', 'products.id', '=', 'cart_items.product_id')
            ->select(
                'invoices.id AS invoice_id', 'invoices.created_at AS invoice_created_at',
                'orders.payment_method', 'orders.delivery_phone', 'orders.delivery_address',
                'orders.delivery_name', 'orders.id AS order_id', 'orders.created_at AS order_created_at',
                'orders.updated_at AS order_accepted_at', 'orders.order_transaction',
                'cart_items.quantity', 'cart_items.note', 'cart_items.size',
                'products.name', 'products.price', 'products.description AS product_description',
                'products.image_url AS product_image_url', 'products.id AS product_id'
            )
            ->get();

        return $invoiceDetails;
    }
}
