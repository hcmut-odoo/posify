@extends('layouts.admin')
@section('title', 'Cập nhật thông tin danh mục sản phẩm')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                <h1>Chỉnh sửa thông tin danh mục sản phẩm</h1>
                <a href="/admin/products" class="btn btn-success">Trở về</a>
            </header>
            <form method="POST" action="{{ route('admin.category.update.post') }}">
                <div class="panel-body">
                    @csrf
                    <input type="hidden" name="id" value="{{ $category->id }}">
                    <div class="form-group col-md-4">
                        <label for="name">Tên danh mục sản phẩm</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ $category->name }}">
                    </div>
                </div>
                <div class="panel-body">
                    <div class="form-row break-row">
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-cart-plus"></i>Lưu</button>
                        </div>
                    </div>
                <div>
            </form>
        </section>
    </div>
</div>
@endsection
