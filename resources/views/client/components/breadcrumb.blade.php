<div class="container m-t-88">
    <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
        <a href="index.html" class="stext-109 cl8 hov-cl1 trans-04">
            HOME
            <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
        </a>
        @foreach ($breadcrumb as $key => $value)
            @if ($breadcrumb[$key] == $breadcrumb[count($breadcrumb) - 1])
                <span class="stext-109 cl4">
                    {{ $value }}
                </span>
            @else
                <a href="product.html" class="stext-109 cl8 hov-cl1 trans-04">
                    {{ $value }}
                    <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
                </a>
            @endif
        @endforeach
    </div>
</div>
