@extends('layouts.admin')
@section('title', 'Đơn hàng đã duyệt')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                <h1>Đơn hàng đã duyệt</h1>
                <a href="/admin/orders" class="btn btn-success">Trở về</a>
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
                        @foreach ($items as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->user_id }}</td>
                                <td>{{ $item->payment_mode_id }}</td>
                                <td>{{ $item->status }}</td>
                                <td>{{ $item->delivery_name }}</td>
                                <td>{{ $item->delivery_address }}</td>
                                <td>{{ $item->delivery_phone }}</td>
                                <td>{{ $item->created_at }}</td>
                                <td>
                                    <a
                                        class="fa fa-eye btn btn-info btn-sm"
                                        href="{{ route('admin.order.accepted.detail', ['id' => $item->id]) }}">
                                    </a>
                                    <a
                                        class="fa fa-trash btn btn-danger btn-sm"
                                        href="{{ route('admin.order.accepted.delete', ['id' => $item->id]) }}">
                                    </a>
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

