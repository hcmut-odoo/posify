<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\OrderService;
use App\Services\UserService;

class InvoiceController extends Controller
{
    private $orderService;
    private $userService;

    public function __construct(
        OrderService $orderService,
        UserService $userService
    )
    {
        $this->orderService = $orderService;
        $this->userService = $userService;
    }

    public function index(Request $request)
    {
        $page = $request->query('page', 1);
        $perPage = $request->query('length', 15);
        $invoices = $this->orderService->pagination([], $perPage, $page);

        return view('/admin/invoices/invoice_index', [
            'items' => $invoices,
            'perPage' => $perPage,
            'page' => $page
        ]);
    }

    public function invoiceDetail(Request $request, $id)
    {
        $invoiceDetail = $this->orderService->getInvoiceDetailData($id);
        $invoiceDetailWithNumericalOrder = add_numerical_order($invoiceDetail);

        return view('/admin/invoices/invoice_detail', [
            'items' => $invoiceDetailWithNumericalOrder,
            'id' => $id
        ]);
    }

    public function invoiceForm(Request $request, $id)
    {
        $order = $this->orderService->findById($id);
        $partner = $this->userService->findById($order->user_id);
        $invoiceFormData = $this->orderService->getInvoiceFormData($id);
        $invoiceFormWithNumericalOrder = add_numerical_order($invoiceFormData);

        return view('/admin/invoices/invoice_form', [
            'items' => $invoiceFormWithNumericalOrder,
            'order' => $order,
            'partner' => $partner
        ]);
    }
}
