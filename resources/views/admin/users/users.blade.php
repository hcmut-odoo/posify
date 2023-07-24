@extends('layouts.admin')
@section('title', 'Quản lý người dùng')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    <h1>Quản lý người dùng</h1>
                    <a href="/admin/products/create" class="btn btn-success">Thêm</a>
                </header>
                <div class="panel-body">
                    <table class="table table-striped table-hover dt-datatable">
                        <thead>
                            <tr>
                                <th>Mã người dùng</th>
                                <th>Tên</th>
                                <th>Email</th>
                                <th>Số điện thoại</th>
                                <th>Vai trò</th>
                                <th>Địa chỉ</th>
                                <th class="no-sort"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->phone_number }}</td>
                                    <td>{{ $user->role }}</td>
                                    <td>{{ $user->address }}</td>
                                    <td>
                                        <a class="fa fa-eye btn btn-info btn-sm" href="/admin/products/details?id={{ $user->id }}"></a>
                                        <a class="fa fa-pencil btn btn-warning btn-sm" href="/admin/products/edit?id={{ $user->id }}"></a>
                                        <a class="fa fa-trash btn btn-danger btn-sm" href="/admin/products/delete?id={{ $user->id }}"></a>
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
