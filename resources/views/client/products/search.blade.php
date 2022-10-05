@extends('client.main')
@section('content')
    <div class="layout-search-page bg0 m-t-124 p-b-140">
        <div class="container ">
            <div class="heading-page">
                <h1 style="color: rgb(18, 8, 8);">Tìm kiếm</h1>
                @if (count($products) > 0)
                    <p class="subtxt">Có <strong>{{ count($products) }} sản phẩm</strong> được tìm thấy</p>
                @endif
            </div>

            @if (count($products) > 0)
                <div id="list-product">
                    <p class="subtext-result">Kết quả tìm kiếm cho <strong>"{{ Request::get('q') }}"</strong>. </p>
                    @include('client.products.productPagination')
                </div>
            @else
                <div class="wrapbox-content-page">
                    <div class="content-page">
                        <div class="expanded-message text-center">
                            <h2 style="color: rgb(18, 8, 8);" class="m-b-10">Không tìm thấy nội dung bạn yêu cầu</h2>
                            <div class="subtext">
                                <span>Không tìm thấy <strong>"{{ Request::get('q') }}"</strong>. </span>
                                <span>Vui lòng kiểm tra chính tả, sử dụng các từ tổng quát hơn và thử lại!</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

        </div>

    </div>
@endsection
