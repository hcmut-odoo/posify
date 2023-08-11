@extends('layouts.admin')
@section('title', 'Danh sách sản phẩm')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    <h1>Sản phẩm</h1>
                    <a href="/admin/products/create" class="btn btn-success">Thêm</a>
                </header>
                <div class="panel-body">
                    <table class="table table-striped table-hover dt-datatable">
                        <thead>
                            <tr>
                                <th>Mã sản phẩm</th>
                                <th>Hình ảnh</th>
                                <th>Mục</th>
                                <th>Tên sản phẩm</th>
                                <th>Giá</th>
                                <th class="no-sort"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>
                                        <img width="60" height="60" src="{{ $item->image_url }}" alt="Product Image">
                                    </td>
                                    <td>{{ $item->category_name }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ number_format($item->price, 0, ',', '.') . 'đ' }}</td>
                                    <td>
                                        <a class="fa fa-eye btn btn-info btn-sm" href="/admin/products/detail?id={{ $item->id }}"></a>
                                        <a class="fa fa-pencil btn btn-warning btn-sm" href="/admin/products/edit?id={{ $item->id }}"></a>
                                        <a class="fa fa-trash btn btn-danger btn-sm" href="/admin/products/delete?id={{ $item->id }}"></a>
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
