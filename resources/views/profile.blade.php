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
        <div class="row">
            <div class="col">
                {{ Form::label('firstname', 'First Name') }}
                {{ Form::text('firstname', $user->firstname, ['class' => 'form-control']) }}
            </div>
            <div class="col">
                {{ Form::label('lastname', 'Last Name') }}
                {{ Form::text('lastname', $user->lastname, ['class' => 'form-control']) }}
            </div>
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

    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
        <div id="updateProfile" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <img src="/images/logo/logo-2.png" width="30px" class="rounded me-2" alt="logo-2">
                <strong class="me-auto">Buy me store</strong>
                <small>Bây giờ</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                Cập nhật thông tin cá nhân thành công.
            </div>
        </div>
    </div>

    <br/>

    <script>
        @if (isset($params['updateSuccess']) && $params['updateSuccess'])
            var toastLiveExample = document.getElementById('updateProfile');
            var toast = new bootstrap.Toast(toastLiveExample);
            toast.show();
        @endif
    </script>
@endsection
