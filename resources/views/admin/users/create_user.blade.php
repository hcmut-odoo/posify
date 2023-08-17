@extends('layouts.admin')

@section('title', 'Thêm người dùng')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                <h1>Thêm người dùng</h1>
                <a href="/admin/users" class="btn btn-success">Trở về</a>
            </header>
            <form method="POST" action="{{ route('admin.user.create.post') }}">
                <div class="panel-body">
                    @csrf
                    <div class="form-group col-md-4">
                        <label for="name">Tên</label>
                        <input type="text" name="name" id="name" class="form-control" value="" required autofocus>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="phone_number">Số điện thoại</label>
                        <input type="text" name="phone_number" id="phone_number" class="form-control" value="" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control" value="" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control" value="" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="role">Vai trò</label>
                        <select name="role" id="role" class="form-control" required>
                            <option value="" disabled selected>Chọn một vai trò</option>
                            <option value="admin">Administrator</option>
                            <option value="client">Client</option>
                        </select>
                    </div>                    
                    <div class="form-group col-md-4">
                        <label for="address">Địa chỉ</label>
                        <input type="text" name="address" id="address" class="form-control" value="" required>
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
