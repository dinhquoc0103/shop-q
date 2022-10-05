@extends('client.main')
@section('content')
    @include('client.components.breadcrumb')
    <div class="bg0 p-t-77 p-b-85">
        <div class="container">
            <div class="row">
                <div id="cart-index" class="col-lg-10 col-xl-11 m-lr-auto m-b-50">

                    @if (count($productsInCart) > 0)
                        <div class="m-l-25 m-r--38 m-lr-0-xl">
                            <div class="wrap-table-shopping-cart">
                                <table class="table-shopping-cart">

                                    <thead>
                                        <tr class="table_head">
                                            <th class="column-1">Ảnh</th>
                                            <th class="column-2">Tên Sản Phẩm</th>
                                            <th class="column-3">Giá</th>
                                            <th class="column-4">Số Lượng</th>
                                            <th class="column-5">Thành Tiền</th>
                                            <th class="column-6">Xóa</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($productsInCart as $product)
                                            @foreach ($cart[$product->id]['quantity'] as $size => $quantity)
                                                <tr id="{{ $product->id . '-' . $size }}" class="table_row">

                                                    <td class="column-1">
                                                        <div class="how-itemcart1">
                                                            <img src="{{ $product->thumb }}" alt="IMG">
                                                        </div>
                                                    </td>

                                                    <td class="column-2">
                                                        <a class="cl2 " href="/products/{{ $product->slug }}">{{ $product->name }}</a>
                                                        <div>
                                                            <span>Size: {{ $size }}</span>
                                                        </div>
                                                    </td>

                                                    <td class="column-3">
                                                        {{ number_format($product->price * ((100 - $product->discount) / 100), 0, '', '.') }}đ
                                                    </td>

                                                    <td class="column-4">
                                                        <div class="wrap-num-product flex-w m-l-auto m-r-0">
                                                            <div
                                                                class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
                                                                <i class="fs-16 zmdi zmdi-minus"></i>
                                                            </div>

                                                            <input disabled class="mtext-104 cl3 txt-center num-product"
                                                                type="number" name="num-product1"
                                                                value="{{ $quantity }}">

                                                            <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
                                                                <i class="fs-16 zmdi zmdi-plus"></i>
                                                            </div>
                                                        </div>
                                                    </td>

                                                    <td class="column-5">
                                                        {{ number_format(($product->price * (100 - $product->discount) * $quantity) / 100, 0, '', '.') }}đ
                                                    </td>

                                                    <td class="column-6">
                                                        <button data-id="{{ $product->id }}"
                                                            data-size="{{ $size }}"
                                                            class="btn btn-danger btn-delete-product">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </td>

                                                </tr>
                                            @endforeach
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="flex-w flex-sb-m bor15 p-t-18 p-b-15 p-lr-40 p-lr-15-sm">
                                <div class="flex-w flex-m m-r-20 m-tb-5">
                                    <div class="flex-c-m mtext-101 cl14 size-118   hov-btn3 p-lr-15 trans-04 pointer m-tb-5">
                                        Tổng Tiền:
                                        <span id="total-price"
                                            style="margin-left: 10px">{{ number_format($totalPrice, 0, '', '.') }}đ</span>
                                    </div>
                                </div>

                                <div
                                    class="flex-c-m stext-101 cl2 size-119 bg8  hov-btn3 p-lr-15 trans-04 pointer m-tb-10">
                                    <a class="cl2 " href="{{ route("checkout.page") }}">Thanh Toán</a>
                                </div>
                            </div>

                        </div>
                    @else
                        @include('client.carts.emptyCart')
                    @endif

                </div>
            </div>
        </div>
    </div>
@endsection
