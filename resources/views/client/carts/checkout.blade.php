@extends('client.main')
@section('content')
    @include('client.components.breadcrumb')
    <div class="checkout-block">
        <form class="bg0 p-t-75 p-b-85" action="{{ route('checkout') }}" method="POST">
            @csrf
            <div class="container">
                <div class="row">

                    <div class=" col-lg-7 col-xl-7  m-b-50">

                        <div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">

                            @if (session()->has('error'))
                                <div class="alert alert-danger">
                                    <span>{{ session('error') }}</span>
                                </div>
                            @endif

                            {{-- Info order --}}
                            <div class="p-t-15 m-b-20">

                                <h4 class="mtext-109 cl2 p-b-18">
                                    Thông tin đơn hàng
                                </h4>

                                <p class=" cl17 m-b-20">
                                    Bạn đã có tài khoản?
                                    <a href="/account/login">Đăng nhập</a>
                                </p>

                                <div class="bor8 bg0 m-b-18">
                                    <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text"
                                        value="{{ old('name') }}" name="name" placeholder="(*)Họ và tên" required>
                                </div>
                                @error('name')
                                    <div class="m-b-10 p-l-10" style="margin-top: -10px">
                                        <span class=" text-danger">{{ $message }}</span>
                                    </div>
                                @enderror

                                <div class="bor8 bg0 m-b-18">
                                    <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="email"
                                        value="{{ old('email') }}" name="email" placeholder="Email" required>
                                </div>
                                @error('email')
                                    <div class="m-b-10 p-l-10" style="margin-top: -10px">
                                        <span class=" text-danger">{{ $message }}</span>
                                    </div>
                                @enderror

                                <div class="bor8 bg0 m-b-18">
                                    <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text"
                                        value="{{ old('phone_number') }}" name="phone_number" placeholder="Số điện thoại"
                                        required>
                                </div>
                                @error('phone_number')
                                    <div class="m-b-10 p-l-10" style="margin-top: -10px">
                                        <span class=" text-danger">{{ $message }}</span>
                                    </div>
                                @enderror

                                <div class="bor8 bg0 m-b-18" required>
                                    <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text"
                                        value="{{ old('address') }}" name="address"
                                        placeholder="Địa chỉ (Số nhà - Ấp(Phường) - Xã(Quận) - Tỉnh(Thành Phố))">
                                </div>
                                @error('address')
                                    <div class="m-b-10 p-l-10" style="margin-top: -10px">
                                        <span class=" text-danger">{{ $message }}</span>
                                    </div>
                                @enderror

                                <div class="bor8 bg0 ">
                                    <textarea rows="5" cols="60" class="stext-111 cl8 plh3  p-lr-15" type="text" value="{{ old('note') }}"
                                        name="note" placeholder="Ghi chú cho đơn hàng">sdsds</textarea>
                                </div>

                            </div>

                            {{-- Transportation method  --}}
                            <div class="p-t-15 m-b-20">
                                <h4 class="mtext-109 cl2 p-b-15">
                                    Vận chuyển
                                </h4>

                                <div class=" cl17 m-b-10 m-l-10">
                                    <div class="m-b-10">
                                        <span> <strong>Giao hàng tiết kiệm: Phí 35k cho toàn quốc</strong></span>
                                    </div>
                                    <div class="ghtk">
                                        <img width="132px" height="80px"
                                            src="https://cdn.haitrieu.com/wp-content/uploads/2022/05/Logo-GHTK-Green.png"
                                            alt="">
                                    </div>
                                </div>

                            </div>

                            {{-- payment method  --}}
                            <div class="p-t-15 m-b-30">
                                <h4 class="mtext-109 cl2 p-b-15">
                                    Phương thức thanh toán
                                </h4>
                                <span class="m-l-10"> <strong>Thanh toán khi giao hàng (COD)</strong></span>

                            </div>

                        </div>
                    </div>

                    <div class=" col-lg-5 col-xl-5  m-b-50">

                        <div class="w-full bor10 p-lr-20 p-t-15 p-b-20">
                            <p class="m-b-20"><strong>Tổng {{ $totalProductsInCart }} sản phẩm </strong></p>
                            <div class=" product-block flex-w js-pscroll ">
                                @if (count($productsInCart) > 0)
                                    <ul class="list-product w-full">
                                        @foreach ($productsInCart as $product)
                                            @foreach ($cart[$product->id]['quantity'] as $size => $quantity)
                                                <li class="header-cart-item d-flex m-b-12 justify-content-between">

                                                    <div class="header-cart-item-img">
                                                        <img src="{{ $product->thumb }}" alt="IMG">
                                                    </div>

                                                    <div class="header-cart-item-txt ">
                                                        <a href="/products/{{ $product->slug }}"
                                                            class="header-cart-item-name m-b-18 hov-cl1 trans-04">
                                                            {{ $product->name }}
                                                        </a>

                                                        <span class="header-cart-item-info">
                                                            Size {{ $size }} : {{ $quantity }}
                                                            x
                                                            {{ number_format($product->price * ((100 - $product->discount) / 100), 0, '', '.') }}đ
                                                        </span>
                                                    </div>

                                                    <div class="product-total-price p-t-18 p-r-10">
                                                        <span>{{ number_format($quantity*($product->price * ((100 - $product->discount) / 100)), 0, '', '.') }}đ</span>
                                                    </div>
                                                </li>
                                            @endforeach
                                        @endforeach


                                    </ul>
                                @endif
                            </div>
                        </div>

                        <div class="w-full bor10 p-lr-20 p-t-15 p-b-20">
                            <div class="total mtext-102 w-full">
                                <div class="total-price d-flex justify-content-between">
                                    <p class="line-name ">Tạm tính: </p>
                                    <p class="line-price "><span
                                            class=" ">{{ number_format($totalPrice, 0, '', '.') }}đ</span></p>
                                </div>
                                <div class="shipping d-flex justify-content-between">
                                    <p class="line-name">Phí vận chuyển:</p>
                                    <p class="line-price  "><span class=" ">
                                            {{ number_format(28000, 0, '', '.') }}đ</span></p>
                                </div>
                            </div>
                        </div>

                        <div class="w-full bor10 p-lr-20 p-t-15 p-b-20">
                            <div class="total-payment mtext-102 w-full m-b-20">
                                <div class="mtext-112 shipping d-flex justify-content-between">
                                    <p class="line-name">Tổng cộng:</p>
                                    <p class="line-price text-success "><span
                                            class=" ">{{ number_format($totalPrice + 28000, 0, '', '.') }}đ</span></p>
                                </div>
                            </div>

                            <div class="buttons flex-w w-full d-flex justify-content-between">
                                <a href="{{ route('cart.index') }}"
                                    class="flex-c-m stext-101 cl0 size-107 bg3  hov-btn3 p-lr-15 trans-04 m-r-8 m-b-10">
                                    Giỏ hàng
                                </a>

                                <button class="flex-c-m stext-101 cl0 size-107 bg3  hov-btn3 p-lr-15 trans-04 m-b-10">
                                    Đặt hàng
                                </button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
