@extends('layouts.admin')
@section('title', 'Chi tiết sản phẩm')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    <h1>Chi tiết sản phẩm</h1>
                    <a href="/admin/orders" class="btn btn-success">Trở về</a>
                </header>
                <div class="panel-body">
                    <dl class="dl-horizontal">
                        <dt>Hình ảnh</dt>
                        <dd>
                            <img width="60" height="60" src="{{ $product->image_url }}" alt="Product Image">
                        </dd>
                        <dt>Mã sản phẩm</dt>
                        <dd>{{ $product->id }}</dd>
                        <dt>Tên sản phẩm</dt>
                        <dd>{{ $product->name }}</dd>
                        <dt>Mã danh mục</dt>
                        <dd>{{ $product->category_id }}</dd>
                        <dt>Giá cơ bản</dt>
                        <dd>{{ number_format($product->price, 0, ',', '.') . ' VNĐ' }}</dd>
                        <dt>Tạo ngày</dt>
                        <dd>{{ $product->created_at }}</dd>
                        <dt>Cập nhật ngày</dt>
                        <dd>{{ $product->updated_at }}</dd>
                    </dl>
                </div>
                <div class="panel-footer">
                    <table class="table table-striped table-hover dt-datatable">
                        <thead>
                            <tr>
                                <th>Mã biến thể</th>
                                <th>Kích thước</th>
                                <th>Giá mở rộng</th>
                                <th>Số lượng</th>
                                <th class="no-sort"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($product_variants as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->size }}</td>
                                    <td>{{ number_format($item->extend_price, 0, ',', '.') . ' VNĐ' }}</td>
                                    <td>{{ $item->stock_qty }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>
@endsection
