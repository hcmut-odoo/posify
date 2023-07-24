@extends('layouts.app')

@section('content')
<link href="{{ asset('css/order.css') }}" rel="stylesheet">


<div class="order-page">
    <div class="menu__header">
        <img class="menu-image" src="{{ asset('images/orders.png') }}" alt="menu-image" />
        <h3>Đơn hàng của bạn</h3>
    </div>

    <div class="order-page__list">
        <form action="" method="post">
            @csrf
            <button type="submit" class="clear-button"><h6>Làm trống</h6></button>
        </form>
        <div class="container">
            <div class="order-page__header">
                <div class="row">
                    <div class="col">
                        Số thứ tự
                    </div>
                    <div class="col">
                        Mã đơn hàng
                    </div>
                    <div class="col">
                        Tình trạng đơn hàng
                    </div>
                    <div class="col">
                        Ngày đặt hàng
                    </div>
                    <div class="col">
                        Xem
                    </div>
                </div>
            </div>

            @foreach ($orders as $order)
                <div class="order-page__item">
                    <div class="row">
                        <div class="col">
                            {{ $order->numerical_order }}
                        </div>
                        <div class="col">
                            {{ $order->order_transaction }}
                        </div>
                        <div class="col">
                            {{ $order->status_label }}
                        </div>
                        <div class="col">
                            {{ $order->created_at }}
                        </div>
                        <div class="col">
                            <a href="/orders/{{ $order->id }}">Chi tiết</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
<script>
    function generateLineBreaks(className, numberOfBreaks) {
        const container = document.createElement('div');
        container.className = className;

        for (let i = 0; i < numberOfBreaks; i++) {
            container.appendChild(document.createElement('br'));
        }

        const elements = document.getElementsByClassName(className);

        if (elements.length > 0) {
            elements[0].appendChild(container);
        }
    }

    window.onload = function() {
        generateLineBreaks('order-page', 10);
    };
</script>
@endsection
