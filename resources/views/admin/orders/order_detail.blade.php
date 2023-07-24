@extends('layouts.admin')
@section('title', 'Chi tiết đơn hàng')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    <h1>Chi tiết đặt hàng</h1>
                    <a href="/admin/orders" class="btn btn-success">Trở về</a>
                </header>
                <div class="panel-body">
                    <table class="table table-striped table-hover dt-datatable">
                        <thead>
                            <tr>
                                <th>Hình ảnh sản phẩm</th>
                                <th>Tên sản phẩm</th>
                                <th>Giá đơn vị</th>
                                <th>Kích thước</th>
                                <th>Số lượng</th>
                                <th>Ghi chú đơn hàng</th>
                                <th class="no-sort"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr>
                                    <td>
                                        <img width="60" height="60" src="{{ $item->image_url }}">
                                    </td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ number_format($item->price, 0, ',', '.') . 'đ' }}</td>
                                    <td>{{ $item->size }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>{{ $item->note }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>
@endsection
