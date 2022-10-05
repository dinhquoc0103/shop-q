@if (count($productsInCart) > 0)
    <ul class="header-cart-wrapitem w-full">
        @foreach ($productsInCart as $product)
            @foreach ($cart[$product->id]['quantity'] as $size => $quantity)
                <li class="header-cart-item flex-w flex-t m-b-12">
                    <div class="header-cart-item-img">
                        <img src="{{ $product->thumb }}" alt="IMG">
                    </div>

                    <div class="header-cart-item-txt">
                        <a href="/products/{{ $product->slug }}" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
                            {{ $product->name }}
                        </a>

                        <span class="header-cart-item-info">
                            Size {{ $size }} : {{ $quantity }}
                            x
                            {{ number_format($product->price * ((100 - $product->discount) / 100), 0, '', '.') }}đ
                        </span>
                    </div>
                </li>
            @endforeach
        @endforeach
    </ul>

    <div class="w-full">
        <div class="header-cart-total w-full p-tb-40">
            Tổng cộng: {{ number_format($totalPrice, 0, '', '.') }}đ
        </div>

        <div class="header-cart-buttons flex-w w-full">
            <a href="/cart" class="flex-c-m stext-101 cl0 size-107 bg3  hov-btn3 p-lr-15 trans-04 m-r-8 m-b-10">
                Giỏ hàng
            </a>

            <a href="{{ route('checkout.page') }}"
                class="flex-c-m stext-101 cl0 size-107 bg3  hov-btn3 p-lr-15 trans-04 m-b-10">
                Thanh Toán
            </a>
        </div>
    </div>

    
@else
    <div id="empty-cart-header">
        <img width=228px src="https://freepikpsd.com/file/2019/10/empty-cart-png-Transparent-Images.png" alt="">
    </div>
@endif

