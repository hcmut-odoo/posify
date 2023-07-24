@extends('layouts.admin')
@section('title', 'Quản lý đặt hàng')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    <h1>Quản lý đặt hàng</h1>
                    <a href="/admin/orders/accepted" class="btn btn-success">Đơn hàng đã duyệt</a>
                    <a href="/admin/orders/rejected" class="btn btn-success">Đơn hàng đã huỷ</a>
                </header>
                <div class="panel-body">
                    <table class="table table-striped table-hover dt-datatable">
                        <thead>
                            <tr>
                                <th>Mã đơn hàng</th>
                                <th>Mã khách hàng</th>
                                <th>Thanh toán</th>
                                <th>Trạng thái</th>
                                <th>Người nhận</th>
                                <th>Địa chỉ giao hàng</th>
                                <th>Số điện thoại</th>
                                <th>Ngày đặt hàng</th>
                                <th class="no-sort">Tuỳ chọn</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->user_id }}</td>
                                    <td>{{ $order->payment_method }}</td>
                                    <td>{{ $order->status }}</td>
                                    <td>{{ $order->delivery_name }}</td>
                                    <td>{{ $order->delivery_address }}</td>
                                    <td>{{ $order->delivery_phone }}</td>
                                    <td>{{ $order->created_at }}</td>
                                    <td>
                                        <a class="fa fa-eye btn btn-info btn-sm" href="{{ route('admin.order.detail', ['id' => $order->id]) }}"></a>
                                        <form action="{{ route('admin.order.delete') }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="id" value="{{ $order->id }}">
                                            <button type="submit" class="far fa-check-circle btn btn-success btn-sm"></button>
                                        </form>
                                        <form action="{{ route('admin.order.reject') }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="id" value="{{ $order->id }}">
                                            <button type="submit" class="fas fa-ban btn btn-danger btn-sm"></button>
                                        </form>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>
@endsection

