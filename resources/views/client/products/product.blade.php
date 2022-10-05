<div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item women">
    <!-- Block2 -->
    <div class="block2">

        <div class="block2-pic hov-img0">
            @if ($product->discount > 0)
                <div class="discount">
                    <span> -{{ $product->discount }}%</span>
                </div>
            @endif       
            <div class="new-arrival-txt">
                <span>New</span>
            </div>
            <a href="/products/{{ Str::slug($product->name) }}">
                <img src="{{ $product->thumb }}" alt="IMG-PRODUCT">
            </a>
        </div>

        <div class="block2-txt flex-w flex-t p-t-14">

            <div class="block2-txt-child1 flex-col-l ">

                <a href="/products/{{ Str::slug($product->name) }}"
                    class="name stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                    {{ $product->name }}
                </a>

                <div class="block2-txt-detail stext-105 cl3">
                    @if ($product->discount == 0)
                        <span class="mtext-106"> {{ number_format($product->price, 0, '', '.') }}đ</span>
                    @else
                        <span
                            class="price-sale mtext-106">{{ number_format($product->price * ((100 - $product->discount) / 100), 0, '', '.') }}đ</span>
                        <del class="price"> {{ number_format($product->price, 0, '', '.') }}đ</del>
                    @endif
                </div>

            </div>

            {{-- <div class="block2-txt-child2 flex-r p-t-3">
                <a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
                    <img class="icon-heart1 dis-block trans-04" src="/template/client/images/icons/icon-heart-01.png"
                        alt="ICON">
                    <img class="icon-heart2 dis-block trans-04 ab-t-l"
                        src="/template/client/images/icons/icon-heart-02.png" alt="ICON">
                </a>
            </div> --}}
        </div>
    </div>
</div>
