@extends('layouts.app')
@section('title', 'Chi tiết đơn hàng')
@section('content')
<link href="{{ asset('css/product_detail.css') }}" rel="stylesheet">
<link href="{{ asset('css/cart.css') }}" rel="stylesheet">
@php
function extraPrice($size, $price)
{
    $extraPrice = $price;
    switch ($size) {
        case 'small':
            $extraPrice += 0;
            break;
        case 'medium':
            $extraPrice += 3000;
            break;
        case 'large':
            $extraPrice += 6000;
            break;
        default:
            break;
    }
    return $extraPrice;
}

function sizeContent($size)
{
    $str = '';
    switch ($size) {
        case 'small':
            $str = 'Small';
            break;
        case 'medium':
            $str = 'Meidum (+3.000đ)';
            break;
        case 'large':
            $str = 'Large (+6.000đ)';
            break;
        default:
            break;
    }
    return $str;
}

function total($items)
{
    $total = 0;
    foreach ($items as $item) {
        $total += extraPrice($item->size, $item->price) * $item->quantity;
    }
    return $total;
}

@endphp
<link href="{{ asset('css/product_detail.css') }}" rel="stylesheet">
<link href="{{ asset('css/cart.css') }}" rel="stylesheet">
<div class="cart-page">
    <div class="cart-page__header">
        <h3>Đơn hàng của bạn</h3>
    </div>
    <div class="cart-page__body">
        <div class="container">
            <div class="row gx-5">
                <div class="col-md-12 col-lg-8">
                    <div class="cart-page__content">
                        <div class="cart-page__content__header">
                            <div>Đơn hàng :</div>
                        </div>
                        <div class="cart-page-divider"></div>

                        <div class="cart-page__content__body">
                            @foreach($orders as $order)
                            <div class="cart-page-item">
                                <div class="container">
                                    <div class="row gy-2">
                                        <div class="col-lg-2 col-md-2 col-sm-3 col-3">
                                            <img class="order-page__item-image" src="{{ $order->image_url }}" />
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-9 col-9">
                                            <h6>{{ $order->name }}</h6>
                                            <div>Giá đơn vị: {{ number_format($order->price, 0, ',', '.') }} đ</div>
                                            <div>Size: {{ sizeContent($order->size) }}</div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                            <div>Số lượng: {{ $order->quantity }}</div>
                                        </div>
                                    </div>
                                    @if($order->note)
                                    <div class="row">
                                        <div class="col-lg-6 col-sm-8">
                                            <div class="input-group mb-3">
                                                <input type="text" id="cart-page__note" class="form-control"
                                                    placeholder="Ghi chú cho sản phẩm này" aria-label="note"
                                                    aria-describedby="basic-addon1" value="{{ $order->note }}"
                                                    disabled readonly
                                                >
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <div class="cart-page__content__header">
                            <div>Tổng cộng</div>
                        </div>
                        <div class="cart-page-divider"></div>
                        <div class="cart-page__content__total">
                            <div>Tạm tính</div>
                            <div>{{ number_format(total($orders), 0, ',', '.') }}đ</div>
                        </div>

                        <div class="cart-page__content__footer">
                            <div>
                                <div>Thành tiền</div>
                                <div class="cart-page-total">
                                    {{ number_format(total($orders), 0, ',', '.') }}đ</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-lg-4">
                    <div class="cart-page__info">
                        <div class="cart-page__content__header">
                            <div>Địa chỉ giao hàng</div>
                        </div>
                        <div class="cart-page-divider"></div>
                        <div class="cart-page__content__header">
                            {{ $order->delivery_address }}
                        </div>

                        <div class="cart-page__content__header">
                            <div>Thông tin người nhận</div>
                        </div>
                        <div class="cart-page-divider"></div>
                        <div class="cart-page__content__header">
                            Tên người nhận: {{ $order->delivery_name }}
                        </div>
                        <div class="cart-page__content__header">
                            Số điện thoại: {{ $order->delivery_phone }}
                        </div>
                        @if($order->delivery_note)
                            <div class="cart-page__content__header">
                                <input type="text" class="form-control" id="delivery-note"
                                    value="{{ $order->delivery_note }}"
                                    placeholder="Ghi chú cho đơn hàng này" disabled readonly>
                            </div>
                        @endif
                        <div class="cart-page__content__header">
                            <div>Phương thức thanh toán</div>
                        </div>
                        <div class="cart-page-divider"></div>

                        @switch($order->payment_mode)
                            @case('cash')
                                <div class="order-page__content__header__checkbox">
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        <img class="image-payment" src="/images/payment/cash.jpeg">
                                        Thanh toán khi nhận hàng (tiền mặt)
                                    </label>
                                </div>
                            @break
                            @case('Payment by check')
                                <div class="order-page__content__header__checkbox">
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        <img class="image-payment" src="/images/payment/sec.png">
                                        Thanh toán bằng Sec
                                    </label>
                                </div>
                            @break
                            @case('Bank wire')
                                <div class="order-page__content__header__checkbox">
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        <img class="image-payment" src="/images/payment/card.png">
                                        Thẻ ngân hàng
                                    </label>
                                </div>
                            @break
                            @default
                            @break
                        @endswitch
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
