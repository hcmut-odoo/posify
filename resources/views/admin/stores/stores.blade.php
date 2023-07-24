@extends('layouts.admin')
@section('title', 'Quản lý cửa hàng')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    <h1>Quản lý cửa hàng</h1>
                    <a href="/admin/products/create" class="btn btn-success">Thêm</a>
                </header>
                <div class="panel-body">
                    <table class="table table-striped table-hover dt-datatable">
                        <thead>
                            <tr>
                                <th>Mã cửa hàng</th>
                                <th>Trạng thái</th>
                                <th>Địa chỉ</th>
                                <th>Giờ mở cửa</th>
                                <th>Số điện thoại</th>
                                <th class="no-sort"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($stores as $store)
                                <tr>
                                    <td>{{ $store->id }}</td>
                                    <td>{{ $store->status }}</td>
                                    <td>{{ $store->address }}</td>
                                    <td>{{ $store->open_time }}</td>
                                    <td>{{ $store->phone }}</td>
                                    <td>
                                        <a class="fa fa-eye btn btn-info btn-sm" href="/admin/products/details?id={{ $store->id }}"></a>
                                        <a class="fa fa-pencil btn btn-warning btn-sm" href="/admin/products/edit?id={{ $store->id }}"></a>
                                        <a class="fa fa-trash btn btn-danger btn-sm" href="/admin/products/delete?id={{ $store->id }}"></a>
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
