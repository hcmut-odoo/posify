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

    public function getAllCategories()
    {
        return $this->invoiceRepository->getAll();
    }

    public function getById($id)
    {
        return $this->invoiceRepository->get($id);
    }
}
