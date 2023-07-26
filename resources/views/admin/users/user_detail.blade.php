@extends('layouts.admin')

@section('title', 'Thông tin người dùng')

@section('content')
<div class="row">
  <div class="col-lg-6">
    <section class="panel">
      <header class="panel-heading">
        <h1>Thông tin người dùng</h1>
        <a href="/admin/users" class="btn btn-success">Trở về</a>
      </header>
      <div class="panel-body">
        <dl class="dl-horizontal">
          <dt>Mã người dùng</dt>
          <dd>{{ $user->id }}</dd>
          <dt>Tên người dùng</dt>
          <dd>{{ $user->name }}</dd>
          <dt>Email</dt>
          <dd>{{ $user->email }}</dd>
          <dt>Số điện thoại</dt>
          <dd>{{ $user->phone_number }}</dd>
          <dt>Vai trò</dt>
          <dd>{{ $user->role }}</dd>
          <dt>Địa chỉ</dt>
          <dd>{{ $user->address }}</dd>
        </dl>
      </div>
    </section>
  </div>
</div>
@endsection
