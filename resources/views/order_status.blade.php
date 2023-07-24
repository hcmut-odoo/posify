@extends('layouts.auth')
@section('title', 'Thông báo đặt hàng')
@section('content')
<link href="{{ asset('css/order_status.css') }}" rel="stylesheet">
<div class="container">
    <div class="overlay">
       <div class="col-md-12">
          <div class="payment">
             <div class="payment_header">
                <div class="check"><i class="fa fa-check" aria-hidden="true"></i></div>
             </div>
             <div class="content">
                <h1>{{ $status }}</h1> <br><br>
                <p>{{ $message }}</p><br><br>
                <h5><a href="/orders">Xem đơn hàng</a></h5>
             </div>
          </div>
       </div>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        var overlay = document.querySelector('.overlay');
        var popup = document.querySelector('.payment');

        overlay.style.display = 'flex';

        overlay.addEventListener('click', function (event) {
            if (event.target === overlay) {
                overlay.style.display = 'none';
            }
        });

        setTimeout(function () {
            overlay.style.display = 'none';
            window.location.href = '/cart';
        }, 3000);
    });
</script>
@endsection
