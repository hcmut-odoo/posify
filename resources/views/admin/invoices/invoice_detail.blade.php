@extends('layouts.admin')
@section('title', 'Chi tiết đơn hàng')
<link href="{{ asset('css/admin/invoice.css') }}" rel="stylesheet">
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    <h1>Chi tiết hóa đơn</h1>
                    <a href="/admin/invoices" class="btn btn-success">Trở về</a>
                    <a href="{{ route('admin.invoice.form', ['id' => $id]) }}" class="btn btn-warning print-button">
                        <i class="fa fa-print"></i> Xuất hóa đơn
                    </a>
                </header>
                <div class="panel-body">
                    <table class="table table-striped table-hover dt-datatable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Hình ảnh</th>
                                <th>Đơn hàng</th>
                                <th>Tên sản phẩm</th>
                                <th>Giá đơn vị</th>
                                <th>Kích thước</th>
                                <th>Số lượng</th>
                                <th>Ngày đặt</th>
                                <th>Ngày duyệt</th>
                                <th>Ngày xuất</th>
                                <th>Ghi chú</th>
                                <th class="no-sort"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr>
                                    <td>{{ $item->numerical_order }}</td>
                                    <td>
                                        <img width="60" height="60" src="{{ $item->product_image_url }}">
                                    </td>
                                    <td>{{ $item->order_transaction }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ number_format($item->price, 0, ',', '.') . 'đ' }}</td>
                                    <td>{{ $item->size }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>{{ $item->order_created_at }}</td>
                                    <td>{{ $item->order_accepted_at }}</td>
                                    <td>{{ $item->order_accepted_at }}</td>
                                    <td>{{ $item->note }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="panel-footer">

                </div>
            </section>
        </div>
    </div>
@endsection
