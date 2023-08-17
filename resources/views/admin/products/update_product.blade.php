@extends('layouts.admin')
@section('title', 'Cập nhật thông tin sản phẩm')
@section('content')
<div class="row">
    <div class="col-lg-12">
      <section class="panel">
          <header class="panel-heading">
              <h1>Chỉnh sửa thông tin sản phẩm</h1>
              <a href="/admin/products" class="btn btn-success">Trở về</a>
          </header>
          <div class="panel-body">
              <form method="POST" action="{{ route('admin.product.update.post') }}">
                    @csrf
                    <input type="hidden" name="id" value="{{ $product->id }}">
                    <div class="form-group col-md-4">
                        <label for="name">Tên sản phẩm</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ $product->name }}">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="category_id">Danh mục sản phẩm</label>
                        <input type="text" name="category_id" id="category_id" class="form-control" value="{{ $product->category_id }}">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="price">Giá cơ bản</label>
                        <input type="text" name="price" id="price" class="form-control" value="{{ $product->price }}">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="image_url">Hình ảnh</label>
                        <input type="text" name="image_url" id="image_url" class="form-control" value="{{ str_replace('\\', '', $product->image_url) }}">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="drescription">Description</label>
                        <input type="text" name="drescription" id="drescription" class="form-control" value="{{ $product->description }}">
                    </div>
                    <div class="form-row break-row">
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-cart-plus"></i>Lưu</button>
                        </div>
                    </div>
              </form>
          </div>
      </section>
    </div>
</div>
@endsection
