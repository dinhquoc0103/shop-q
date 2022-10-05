<header>
    <!-- Header desktop -->
    <div class="container-menu-desktop">
        <!-- Topbar -->
        <div class="top-bar">
            <div class="content-topbar flex-sb-m h-full container">

                <div class="left-top-bar">
                    Miễn phí ship cho đơn hàng từ 280k
                </div>

                <div class="right-top-bar flex-w h-full">
                    @auth
                        <a href="{{ route('user.index') }}" class="flex-c-m trans-04 p-lr-25">
                            Hello {{ strtoupper(auth()->user()->name) }}!
                        </a>
                        @if (session('role') == 1)
                            <a href="{{ route("admin.login.page") }}" class="flex-c-m trans-04 p-lr-25">
                                Quản trị
                            </a>
                        @endif
                        <a href="{{ route('logout') }}" class="flex-c-m trans-04 p-lr-25">
                            Đăng xuất
                        </a>
                    @endauth

                    @guest
                        <a href="/account/login" class="flex-c-m trans-04 p-lr-25">
                            Đăng nhập
                        </a>
                        <a href="{{ route('register.page') }}" class="flex-c-m trans-04 p-lr-25">
                            Đăng ký
                        </a>
                    @endguest

                </div>

            </div>
        </div>
        @php
            $style = isset($pageName) ? '' : "box-shadow: 1px  1px  #EBEBEB";
        @endphp
        <div class="wrap-menu-desktop" style="{{ $style }}">
            <nav class="limiter-menu-desktop container">

                <!-- Logo desktop -->
                <a href="/" class="logo">
                    <img src="/template/client/images/icons/logo-01.png" alt="IMG-LOGO">
                </a>

                <!-- Menu desktop -->
                <div class="menu-desktop">
                    <ul class="main-menu">
                        {!! App\Helpers\Helper::renderHtmlMenus($menus, 'desktop') !!}

                        <li>
                            <a href="blog.html">BLOG</a>
                        </li>

                        <li>
                            <a href="about.html">ABOUT US</a>
                        </li>

                        <li>
                            <a href="contact.html">CONTACT</a>
                        </li>
                    </ul>
                </div>

                <!-- Icon header -->
                <div class="wrap-icon-header flex-w flex-r-m">
                    <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 js-show-modal-search">
                        <i class="zmdi zmdi-search"></i>
                    </div>

                    <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti js-show-cart"
                        data-notify=" {{ $totalProductsInCart }}">
                        <i class="zmdi zmdi-shopping-cart"></i>
                    </div>
                </div>
            </nav>
        </div>
    </div>

    <!-- Header Mobile -->
    <div class="wrap-header-mobile">
        <!-- Logo moblie -->
        <div class="logo-mobile">
            <a href="/"><img src="/template/client/images/icons/logo-01.png" alt="IMG-LOGO"></a>
        </div>

        <!-- Icon header -->
        <div class="wrap-icon-header flex-w flex-r-m m-r-15">
            <div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 js-show-modal-search">
                <i class="zmdi zmdi-search"></i>
            </div>

            <div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti js-show-cart"
                data-notify="2">
                <i class="zmdi zmdi-shopping-cart"></i>
            </div>

            <a href="#" class="dis-block icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti"
                data-notify="0">
                <i class="zmdi zmdi-favorite-outline"></i>
            </a>
        </div>

        <!-- Button show menu -->
        <div class="btn-show-menu-mobile hamburger hamburger--squeeze">
            <span class="hamburger-box">
                <span class="hamburger-inner"></span>
            </span>
        </div>
    </div>

    <!-- Menu Mobile -->
    <div class="menu-mobile">
        <ul class="topbar-mobile">
            <li>
                <div class="left-top-bar">
                    Miễn phí ship cho đơn hàng từ 280k
                </div>
            </li>

            <li>
                <div class="right-top-bar flex-w h-full">
                    @auth
                        <a href="{{ route('user.index') }}" class="flex-c-m trans-04 p-lr-25">
                            {{ auth()->user()->name }}
                        </a>
                        @if (session('role') == 1)
                            <a href="{{ route("admin.login.page") }}" class="flex-c-m trans-04 p-lr-25">
                                Quản trị
                            </a>
                        @endif
                        <a href="{{ route('logout') }}" class="flex-c-m trans-04 p-lr-25">
                            Đăng xuất
                        </a>
                    @endauth
                    @guest
                        <a href="/account/login" class="flex-c-m trans-04 p-lr-25">
                            Đăng nhập
                        </a>
                        <a href="{{ route('register.page') }}" class="flex-c-m trans-04 p-lr-25">
                            Đăng ký
                        </a>
                    @endguest

                </div>
            </li>
        </ul>

        <ul class="main-menu-m">
            {!! App\Helpers\Helper::renderHtmlMenus($menus, 'mobile') !!}

            <li>
                <a href="blog.html">Blog</a>
            </li>

            <li>
                <a href="about.html">About Us</a>
            </li>

            <li>
                <a href="contact.html">Contact</a>
            </li>
        </ul>
    </div>

    <!-- Modal Search -->
    <div class="modal-search-header flex-c-m trans-04 js-hide-modal-search">
        <div class="container-search-header">
            <button class="flex-c-m btn-hide-modal-search trans-04 js-hide-modal-search">
                <img src="/template/client/images/icons/icon-close2.png" alt="CLOSE">
            </button>

            <form action="{{ route('search.product') }}" class="wrap-search-header flex-w p-l-15">
                <button class="flex-c-m trans-04">
                    <i class="zmdi zmdi-search"></i>
                </button>
                <input class="plh3" type="text" name="q" placeholder="Search...">
            </form>
        </div>
    </div>
</header>
