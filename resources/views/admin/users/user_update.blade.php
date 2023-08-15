@extends('layouts.admin')

@section('title', 'Sửa đổi người dùng')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                <h1>Chỉnh sửa thông tin người dùng</h1>
                <a href="/admin/users" class="btn btn-success">Trở về</a>
                <a href="/admin/users/edit/password?id={{ $user->id }}" class="btn btn-warning right-button">
                    Cấp lại mật khẩu
                </a>
            </header>
            <form method="POST" action="{{ route('admin.user.update.post', ['id' => $user->id]) }}">
                <div class="panel-body">
                    @csrf
                    <input type="hidden" name="id" value="{{ $user->id }}">
                    <div class="form-group col-md-4">
                        <label for="name">Tên</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="phone_number">Số điện thoại</label>
                        <input type="text" name="phone_number" id="phone_number" class="form-control" value="{{ $user->phone_number }}">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="role">Vai trò</label>
                        <input type="text" name="role" id="role" class="form-control" value="{{ $user->role }}">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="address">Địa chỉ</label>
                        <input type="text" name="address" id="address" class="form-control" value="{{ $user->address }}">
                    </div>
                </div>
                <div class="panel-body">
                    <div class="form-row break-row">
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-cart-plus"></i>Lưu</button>
                        </div>
                    </div>
                </div>
            </form>
      </section>
    </div>
</div>
@endsection
