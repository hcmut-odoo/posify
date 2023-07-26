<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\InvoiceService;
use App\Services\OrderService;
use App\Services\UserService;

class InvoiceController extends Controller
{
    private $invoiceService;
    private $orderService;
    private $userService;

    public function __construct(
        InvoiceService $invoiceService,
        OrderService $orderService,
        UserService $userService
    )
    {
        $this->invoiceService = $invoiceService;
        $this->orderService = $orderService;
        $this->userService = $userService;
    }

    public function index(Request $request)
    {
        $page = $request->query('page', 1);
        $perPage = $request->query('length', 15);
        $invoices = $this->invoiceService->pagination([], $perPage, $page);

        return view('/admin/invoices/invoice_index', [
            'items' => $invoices,
            'perPage' => $perPage,
            'page' => $page
        ]);
    }

    public function invoiceDetail(Request $request, $id)
    {
        $invoiceDetail = $this->invoiceService->getInvoiceDetailData($id);
        $invoiceDetailWithNumericalOrder = add_numerical_order($invoiceDetail);

        return view('/admin/invoices/invoice_detail', [
            'items' => $invoiceDetailWithNumericalOrder,
            'id' => $id
        ]);
    }

    public function invoiceForm(Request $request, $id)
    {
        $invoice = $this->invoiceService->findById($id);
        $order = $this->orderService->findById($invoice->order_id);
        $partner = $this->userService->findById($order->user_id);
        $invoiceFormData = $this->invoiceService->getInvoiceFormData($id);
        $invoiceFormWithNumericalOrder = add_numerical_order($invoiceFormData);

        return view('/admin/invoices/invoice_form', [
            'items' => $invoiceFormWithNumericalOrder,
            'order' => $order,
            'invoice' => $invoice,
            'partner' => $partner
        ]);
    }
}
