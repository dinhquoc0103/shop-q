@extends('client.main')
@section('content')
    @include('client.components.breadcrumb')
    <section class="sec-product-detail bg0 p-t-65 p-b-60">
        <div class="container">
            <div class="row">

                {{-- Images --}}
                <div class="col-md-6 col-lg-7 p-b-30">
                    <div class="p-l-25 p-r-30 p-lr-0-lg mx-auto">
                        <div class="wrap-slick3 flex-sb flex-w">

                            {{-- Left images slide --}}
                            <div class="wrap-slick3-dots ">
                                <ul class="slick3-dots" role="tablist" style="">
                                    <li class="slick-active" role="presentation">
                                        <img src="{{ $product->thumb }}">
                                        <div class="slick3-dot-overlay"></div>
                                    </li>
                                    {{-- <li role="presentation"><img src="/template/client/images/product-detail-02.jpg ">
                                        <div class="slick3-dot-overlay"></div>
                                    </li>
                                    <li role="presentation"><img src="/template/client/images/product-detail-03.jpg ">
                                        <div class="slick3-dot-overlay"></div>
                                    </li> --}}
                                </ul>
                            </div>

                            {{-- Image switch button --}}
                            {{-- <div class="wrap-slick3-arrows flex-sb-m flex-w">
                                <button class="arrow-slick3 prev-slick3 slick-arrow" style="">
                                    <i class="fa fa-angle-left" aria-hidden="true"></i>
                                </button>
                                <button class="arrow-slick3 next-slick3 slick-arrow" style="">
                                    <i class="fa fa-angle-right" aria-hidden="true"></i>
                                </button>
                            </div> --}}

                            {{-- Show large image --}}
                            <div class="slick3 gallery-lb slick-initialized slick-slider slick-dotted">
                                <div class="wrap-pic-w pos-relative">
                                    <img src="{{ $product->thumb }}" alt="IMG-PRODUCT">

                                    <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04"
                                        href="{{ $product->thumb }}" tabindex="0">
                                        <i class="fa fa-expand"></i>
                                    </a>
                                </div>
                                {{-- <div class="slick-list draggable">
                                    <div class="slick-track" style="opacity: 1; width: 1539px;">
                                        <div class="item-slick3 slick-slide slick-current slick-active"
                                            data-thumb="{{ $product->thumb }}" data-slick-index="0" aria-hidden="false"
                                            tabindex="0" role="tabpanel" id="slick-slide10"
                                            aria-describedby="slick-slide-control10"
                                            style="width: 513px; position: relative; left: 0px; top: 0px; z-index: 999; opacity: 1;">
                                            <div class="wrap-pic-w pos-relative">
                                                <img src="{{ $product->thumb }}" alt="IMG-PRODUCT">
    
                                                <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04"
                                                    href="{{ $product->thumb }}" tabindex="0">
                                                    <i class="fa fa-expand"></i>
                                                </a>
                                            </div>
                                        </div>

                                    </div>
                                </div> --}}
                            </div>

                        </div>
                    </div>
                </div>

                {{-- Basic info of product --}}
                <div class="col-md-6 col-lg-5 p-b-30">
                    <div class="p-r-50 p-t-5 p-lr-0-lg">
                        {{-- Name --}}
                        <h4 class="product-name mtext-105 cl2 js-name-detail p-b-15">
                            {{ $product->name }}
                        </h4>

                        <p class="product-status stext-115 m-b-18">
                            Tình trạng:
                            @if ($numProduct > 0)
                                <span class="text-primary">Còn hàng</span>
                            @else
                                <span class="text-danger">Hết hàng</span>
                            @endif

                        </p>

                        {{-- Price and discount --}}
                        <div class="product-price mtext-107 cl2 m-b-18">
                            @if ($product->discount == 0)
                                <span> {{ number_format($product->price, 0, '', '.') }}đ</span>
                            @else
                                <span class="price-sale mtext-111 m-r-8">
                                    {{ number_format($product->price * ((100 - $product->discount) / 100), 0, '', '.') }}đ
                                </span>
                                <del class="price m-r-8"> {{ number_format($product->price, 0, '', '.') }}đ</del>
                                <span class="discount"> -{{ $product->discount }}%</span>
                            @endif
                        </div>

                        {{-- Size, Color, Quantity, And Add --}}
                        @if ($numProduct > 0)
                            <div>

                                {{-- Size --}}
                                <div class="flex-w  m-b-26">
                                    <span class="product-size stext-115 m-r-18 m-t-6">Kích thước:</span>
                                    <div class="select-size">
                                        <select name="size" id="select-size" class="form-control">
                                            @foreach ($product->sizes as $key => $size)
                                                @if ($size->pivot->quantity > 0)
                                                    <option value="{{ $size->name }}"> Size {{ $size->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="flex-w p-b-10">
                                    <div class="flex-w flex-m respon6-next">

                                        <div class="wrap-num-product flex-w m-r-20 m-tb-10">
                                            <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
                                                <i class="fs-16 zmdi zmdi-minus"></i>
                                            </div>
                                            <input class="quantity mtext-104 cl3 txt-center num-product" type="number"
                                                name="num-product" value="1">
                                            <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
                                                <i class="fs-16 zmdi zmdi-plus"></i>
                                            </div>
                                        </div>

                                        <div id="add-product-detail">
                                            <button id="add-to-cart" data-id="{{ $product->id }}" data-price="{{  $product->price * ((100 - $product->discount) / 100) }}"
                                                class="add-to-carts flex-c-m stext-101 cl0 size-101 bg1  hov-btn1 p-lr-15 trans-04 ">
                                                THÊM VÀO GIỎ
                                            </button>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        @endif

                        {{-- Short description --}}
                        <div class="product-short-description stext-102 cl3 p-t-23">

                            {!! $product->description !!}
                            <p>
                                <strong>HƯỚNG DẪN BẢO QUẢN</strong><br>
                                – Hạn chế giặt máy, nên giặt tay<br>
                                – Lộn trái khi giặt, nên phơi nơi nắng nhẹ, tránh ánh nắng trực tiếp.
                            </p>

                        </div>

                    </div>
                </div>

            </div>

            <div class="bor10 m-t-50 p-t-43 p-b-40">
                <!-- Tab01 -->
                <div class="tab01">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item p-b-10">
                            <a class="nav-link active" data-toggle="tab" href="#description" role="tab">MÔ TẢ</a>
                        </li>

                        {{-- <li class="nav-item p-b-10">
                            <a class="nav-link" data-toggle="tab" href="#information" role="tab">Additional
                                information</a>
                        </li> --}}

                        {{-- <li class="nav-item p-b-10">
                            <a class="nav-link" data-toggle="tab" href="#reviews" role="tab">Reviews (1)</a>
                        </li> --}}
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content p-t-43">
                        <!-- - -->
                        <div class=" tab-pane fade show active" id="description" role="tabpanel">
                            <div class="product-description how-pos2 p-lr-15-md">
                                <p class="stext-102 cl6">
                                    {!! $product->content !!}
                                </p>
                            </div>
                        </div>

                        <!-- - -->
                        {{-- <div class="tab-pane fade" id="information" role="tabpanel">
                            <div class="row">
                                <div class="col-sm-10 col-md-8 col-lg-6 m-lr-auto">
                                    <ul class="p-lr-28 p-lr-15-sm">
                                        <li class="flex-w flex-t p-b-7">
                                            <span class="stext-102 cl3 size-205">
                                                Weight
                                            </span>
    
                                            <span class="stext-102 cl6 size-206">
                                                0.79 kg
                                            </span>
                                        </li>
    
                                        <li class="flex-w flex-t p-b-7">
                                            <span class="stext-102 cl3 size-205">
                                                Dimensions
                                            </span>
    
                                            <span class="stext-102 cl6 size-206">
                                                110 x 33 x 100 cm
                                            </span>
                                        </li>
    
                                        <li class="flex-w flex-t p-b-7">
                                            <span class="stext-102 cl3 size-205">
                                                Materials
                                            </span>
    
                                            <span class="stext-102 cl6 size-206">
                                                60% cotton
                                            </span>
                                        </li>
    
                                        <li class="flex-w flex-t p-b-7">
                                            <span class="stext-102 cl3 size-205">
                                                Color
                                            </span>
    
                                            <span class="stext-102 cl6 size-206">
                                                Black, Blue, Grey, Green, Red, White
                                            </span>
                                        </li>
    
                                        <li class="flex-w flex-t p-b-7">
                                            <span class="stext-102 cl3 size-205">
                                                Size
                                            </span>
    
                                            <span class="stext-102 cl6 size-206">
                                                XL, L, M, S
                                            </span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div> --}}

                        <!-- - -->
                        {{-- <div class="tab-pane fade" id="reviews" role="tabpanel">
                            <div class="row">
                                <div class="col-sm-10 col-md-8 col-lg-6 m-lr-auto">
                                    <div class="p-b-30 m-lr-15-sm">
                                        <!-- Review -->
                                        <div class="flex-w flex-t p-b-68">
                                            <div class="wrap-pic-s size-109 bor0 of-hidden m-r-18 m-t-6">
                                                <img src="images/avatar-01.jpg" alt="AVATAR">
                                            </div>
    
                                            <div class="size-207">
                                                <div class="flex-w flex-sb-m p-b-17">
                                                    <span class="mtext-107 cl2 p-r-20">
                                                        Ariana Grande
                                                    </span>
    
                                                    <span class="fs-18 cl11">
                                                        <i class="zmdi zmdi-star"></i>
                                                        <i class="zmdi zmdi-star"></i>
                                                        <i class="zmdi zmdi-star"></i>
                                                        <i class="zmdi zmdi-star"></i>
                                                        <i class="zmdi zmdi-star-half"></i>
                                                    </span>
                                                </div>
    
                                                <p class="stext-102 cl6">
                                                    Quod autem in homine praestantissimum atque optimum est, id deseruit.
                                                    Apud ceteros autem philosophos
                                                </p>
                                            </div>
                                        </div>
    
                                        <!-- Add review -->
                                        <form class="w-full">
                                            <h5 class="mtext-108 cl2 p-b-7">
                                                Add a review
                                            </h5>
    
                                            <p class="stext-102 cl6">
                                                Your email address will not be published. Required fields are marked *
                                            </p>
    
                                            <div class="flex-w flex-m p-t-50 p-b-23">
                                                <span class="stext-102 cl3 m-r-16">
                                                    Your Rating
                                                </span>
    
                                                <span class="wrap-rating fs-18 cl11 pointer">
                                                    <i class="item-rating pointer zmdi zmdi-star-outline"></i>
                                                    <i class="item-rating pointer zmdi zmdi-star-outline"></i>
                                                    <i class="item-rating pointer zmdi zmdi-star-outline"></i>
                                                    <i class="item-rating pointer zmdi zmdi-star-outline"></i>
                                                    <i class="item-rating pointer zmdi zmdi-star-outline"></i>
                                                    <input class="dis-none" type="number" name="rating">
                                                </span>
                                            </div>
    
                                            <div class="row p-b-25">
                                                <div class="col-12 p-b-5">
                                                    <label class="stext-102 cl3" for="review">Your review</label>
                                                    <textarea class="size-110 bor8 stext-102 cl2 p-lr-20 p-tb-10"
                                                        id="review" name="review"></textarea>
                                                </div>
    
                                                <div class="col-sm-6 p-b-5">
                                                    <label class="stext-102 cl3" for="name">Name</label>
                                                    <input class="size-111 bor8 stext-102 cl2 p-lr-20" id="name"
                                                        type="text" name="name">
                                                </div>
    
                                                <div class="col-sm-6 p-b-5">
                                                    <label class="stext-102 cl3" for="email">Email</label>
                                                    <input class="size-111 bor8 stext-102 cl2 p-lr-20" id="email"
                                                        type="text" name="email">
                                                </div>
                                            </div>
    
                                            <button
                                                class="flex-c-m stext-101 cl0 size-112 bg7 bor11 hov-btn3 p-lr-15 trans-04 m-b-10">
                                                Submit
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>

        <div class="bg6 flex-c-m flex-w size-302 m-t-73 p-tb-15">
            <span class="stext-107 cl6 p-lr-25">
                Loại sản phẩm: {{ $breadcrumb[1] . ', ' . $breadcrumb[0] }}
            </span>
        </div>
    </section>
@endsection
