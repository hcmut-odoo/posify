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
                                <td>{{ $order->payment_mode_id }}</td>
                                <td>{{ $order->status }}</td>
                                <td>{{ $order->delivery_name }}</td>
                                <td>{{ $order->delivery_address }}</td>
                                <td>{{ $order->delivery_phone }}</td>
                                <td>{{ $order->created_at }}</td>
                                <td>
                                    <a class="fa fa-eye btn btn-info btn-sm" href="{{ route('admin.order.detail', ['id' => $order->id]) }}"></a>
                                    <form action="{{ route('admin.order.accept') }}" method="POST" style="display: inline;">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $order->id }}">
                                        <button type="submit" class="far fa-check-circle btn btn-success btn-sm"></button>
                                    </form>
                                    <form action="{{ route('admin.order.reject') }}" method="POST" style="display: inline;">
                                        @csrf
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
<div id="toast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">
        <img src="{{ url('/images/logo/logo-2.png') }}" width="30px" class="rounded me-2" alt="logo-2">
        <strong class="me-auto">Buy me store</strong>
        <small class="toast-time">Just now</small>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body">
        {{ session('message') }}
    </div>
</div>
@if (\Session::get('message'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toastElement = document.getElementById('toast');
        const toast = new bootstrap.Toast(toastElement);

        const showToast = () => {
            toastElement.style.display = 'block';
            toast.show();
        };

        showToast();
        const closeButton = toastElement.querySelector('.btn-close');
        closeButton.addEventListener('click', () => {
            toast.hide();
        });
    });
</script>
@endif
@endsection

