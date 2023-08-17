@extends('layouts.app')
@section('title', 'Hồ sơ cá nhân')
@section('content')
    <link href="{{ asset('css/profile.css') }}" rel="stylesheet">
    <h1>Tài khoản của bạn</h1>
    <br/>
    <div class="profile-avatar">
        <img class="profile-avatar-image" alt="profile-avatar-image" src='/images/avatar.png'>
    </div>

    <form action="" method="post">
        @csrf
        <div class="form-group">
            {{ Form::label('name', 'Name') }}
            {{ Form::text('name', $user->name, ['class' => 'form-control']) }}
        </div>
        <div class="form-group">
            {{ Form::label('email', 'Email') }}
            {{ Form::email('email', $user->email, ['class' => 'form-control']) }}
        </div>
        <div class="form-group">
            {{ Form::label('phone_number', 'Phone Number') }}
            {{ Form::text('phone_number', $user->phone_number, ['class' => 'form-control']) }}
        </div>
        <div class="form-group">
            {{ Form::label('address', 'Address') }}
            {{ Form::text('address', $user->address, ['class' => 'form-control']) }}
        </div>
        {{ Form::submit('Cập nhật', ['class' => 'btn btn-primary']) }}
    </form>

    <br/>
@endsection
