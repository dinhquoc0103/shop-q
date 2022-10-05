@extends('client.main')
@section('content')
    @include('client.components.breadcrumb')
    <div class="bg0 m-t-24 p-b-140">
        <div class="container">
            <div class="flex-w flex-sb-m p-t-20">

                {{-- <div class="flex-w flex-l-m filter-tope-group m-tb-10">
                    <button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5 how-active1" data-filter="*">
                        All Products
                    </button>

                    <button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" data-filter=".women">
                        Women
                    </button>

                    <button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" data-filter=".men">
                        Men
                    </button>

                    <button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" data-filter=".bag">
                        Bag
                    </button>

                    <button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" data-filter=".shoes">
                        Shoes
                    </button>

                    <button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" data-filter=".watches">
                        Watches
                    </button>
                </div> --}}

                <div class="filter flex-w">  
                    <div class="form-group m-r-20">
                        {{-- <label for="exampleFormControlSelect1">Example select</label> --}}
                        <select class="form-control" id="collection-filter-price">
                            <option value="default">Lọc giá</option>
                            @foreach ($priceFilterArray as $key => $value)
                                @if ($key == $filterPrice)
                                    <option value="{{ $key }}" selected>{{ $value }}</option>
                                @else
                                    <option value="{{ $key }}">{{ $value }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>

                <div id="sort">
                    <div class="form-group">
                        <select class="form-control" id="collection-sorted-by">
                            <option value="default">Sắp xếp</option>
                            @foreach ($sortByArray as $key => $value)
                                @if ($key == $sortValue)
                                    <option value="{{ $key }}" selected>{{ $value }}</option>
                                @else
                                    <option value="{{ $key }}">{{ $value }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>

                

            </div>

            <div id="list-product">
                @include('client.products.productPagination')
            </div>

        </div>
    </div>
@endsection

@section('footer')
    <script src="/template/client/js/product.js"></script>
@endsection
