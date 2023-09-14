@extends('layouts.admin')
@section('title', 'Hóa đơn')
@section('content')
<link rel="stylesheet" href="{{ asset('/css/admin/invoice.css') }}">
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="invoice-title">
                        <h4 class="float-right font-size-15">Hóa đơn #{{$order->order_transaction}} <span class="badge bg-success font-size-12 ml-2">Processed</span></h4>
                        <div class="mb-4">
                            <h2 class="mb-1 text-muted">The kaffeehouse</h2>
                        </div>
                        <div class="text-muted">
                            <p class="mb-1">268 Lý Thường Kiệt, Phường 14, Quận 10</p>
                            <p class="mb-1"><i class="fa fa-envelope me-1"></i> https://github.com/hcmut-odoo </p>
                            <p><i class="fa fa-phone me-1"></i> 09123456789 </p>
                        </div>
                    </div>
                    <hr class="my-4">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="text-muted">
                                <h5 class="font-size-16 mb-3">Hóa đơn cho:</h5>
                                <h5 class="font-size-15 mb-2">{{ $partner->name }}</h5>
                                <p class="mb-1">{{ $partner->address }}</p>
                                <p class="mb-1">{{ $partner->email }}</p>
                                <p>{{ $partner->phone_number }}</p>
                                <h5 class="font-size-16 mb-3">Người nhận:</h5>
                                <p class="mb-1">{{ $order->delivery_name }}</p>
                                <p class="mb-1">{{ $order->delivery_address }}</p>
                                <p class="mb-1">{{ $order->delivery_phone }}</p>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="text-muted text-right">
                                <div>
                                    <h5 class="font-size-15 mb-1">Đơn hàng số:</h5>
                                    <p>#{{ $order->id }}</p>
                                </div>
                                <div class="mt-4">
                                    <h5 class="font-size-15 mb-1">Ngày đặt hàng:</h5>
                                    <p>{{ $order->created_at }}</p>
                                </div>
                                <div class="mt-4">
                                    <h5 class="font-size-15 mb-1">Mã đơn hàng:</h5>
                                    <p>#{{ $order->order_transaction }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="py-2">
                        <h5 class="font-size-15">Thông tin đơn hàng</h5>
                        <div class="table-responsive">
                            <table class="table table-bordered table-nowrap mb-0">
                                <thead>
                                    <tr>
                                        <th style="width: 70px;">No.</th>
                                        <th>Sản phẩm</th>
                                        <th>Kích thước</th>
                                        <th>Giá</th>
                                        <th>Số lượng</th>
                                        <th class="text-right" style="width: 120px;">Tổng cộng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($items as $item)
                                        <tr>
                                            <th scope="row">{{ $item->numerical_order }}</th>
                                            <td>
                                                <div>
                                                    <h5 class="text-truncate font-size-14 mb-1">{{ $item->name }}</h5>
                                                    <p class="text-muted mb-0">{{ $item->size }}</p>
                                                </div>
                                            </td>
                                            <td>{{ $item->size }}</td>
                                            <td>{{ number_format($item->extend_price, 0, ',', '.') }} VNĐ</td>
                                            <td>{{ $item->quantity }}</td>
                                            <td class="text-right">{{ number_format($item->extend_price*$item->quantity, 0, ',', '.')}} VNĐ</td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <th scope="row" colspan="5" class="text-right">Tạm tính</th>
                                        <td class="text-right">{{ number_format($order->total, 0, ',', '.') }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row" colspan="5" class="border-0 text-right">
                                            Tax</th>
                                        <td class="border-0 text-right">{{ number_format(floatval($order->total)*0.1, 0, ',', '.')}} VNĐ</td>
                                    <tr>
                                        <th scope="row" colspan="5" class="border-0 text-right">Total</th>
                                        <td class="border-0 text-right"><h4 class="m-0 font-weight-bold">{{ number_format(floatval($order->total)*1.1, 0, ',', '.')}} VNĐ</h4></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="d-print-none mt-4" id="no-print-area">
                            <div class="float-right">
                                <a id="print-button" href="javascript:window.print()" class="btn btn-success me-1"><i class="fa fa-print"></i></a>
                                <a href="#" class="btn btn-primary">Send</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var printButton = document.getElementById('print-button');
        var hideFromPrintArea = document.getElementById('no-print-area');
        var wrapper = document.getElementById('wrapper');
        var originalDisplay = hideFromPrintArea.style.display;

        printButton.addEventListener('click', function(e) {
            e.preventDefault();

            // Toggle the "toggled" class on the "wrapper" element, simulating jQuery's toggleClass
            wrapper.classList.toggle('toggled');

            // Toggle the classes "fa-arrow-left" and "fa-bars" on the children of the printButton, simulating jQuery's toggleClass
            var icon = printButton.querySelector('i');
            icon.classList.toggle('fa-arrow-left');
            icon.classList.toggle('fa-bars');

            // Set the document title for the PDF before printing
            var partner = @json($partner);
            var invoice = @json($order);
            var dateExport = new Date(invoice.created_at).toISOString().split('T')[0];
            var pdfTitle = partner.name + "-" + dateExport;
            var originalTitle = document.title;

            // Set title for invoice
            document.title = pdfTitle ?? originalTitle;

            // Hide no print area
            hideFromPrintArea.style.display = 'none';

            // Delay the print action to allow the toggling and title setting to take effect
            setTimeout(function() {
                window.print();
                // Reset the document title after printing is complete
                document.title = originalTitle;
            }, 500); // Adjust the delay time as needed

            // Listen for the 'afterprint' event to reset the classes after the print is complete
            window.addEventListener("afterprint", (event) => {
                // Toggle again to display narbav
                wrapper.classList.toggle('toggled');
                icon.classList.toggle('fa-arrow-left');
                icon.classList.toggle('fa-bars');

                // Display print button
                hideFromPrintArea.style.display = originalDisplay;
            });
        });
    });
</script>
@endsection
