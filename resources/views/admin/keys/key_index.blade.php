@extends('layouts.admin')
@section('title', 'Quản lý khóa')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                <h1>Quản ký khóa dịch vụ web</h1>
                <a href="/admin/api-key/create" class="btn btn-info">Thêm khóa</a>
            </header>
            <div class="panel-body">
                <table class="table table-striped table-hover dt-datatable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Key</th>
                            <th>Trạng thái</th>
                            <th>Mô tả</th>
                            <th>Ngày tạo</th>
                            <th class="no-sort">Tuỳ chọn</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->value }}</td>
                                <td>{{ $item->status }}</td>
                                <td>{{ $item->description }}</td>
                                <td>{{ $item->created_at }}</td>
                                <td>
                                    <a
                                        class="fa fa-eye btn btn-info btn-sm"
                                        href="{{ route('admin.api.key.detail', ['id' => $item->id]) }}">
                                    </a>
                                    <a
                                        class="fa fa-pen btn btn-warning btn-sm"
                                        href="{{ route('admin.api.key.update.get', ['id' => $item->id]) }}">
                                    </a>
                                    <form action="{{ route('admin.api.key.delete', ['id' => $item->id]) }}" method="POST" style="display: inline;">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $item->id }}">
                                        <button type="submit" class="far fa-trash btn btn-danger btn-sm"></button>
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

