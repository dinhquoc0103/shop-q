@extends('client.main')
@section('content')
    @include('client.components.breadcrumb')
    <section class="bg0 p-t-18 p-b-116">
        <div class="container d-flex justify-content-center">
            <div class="size-210 bor10 p-lr-70 p-t-55 p-b-70 p-lr-15-lg w-full-md">
                <form id="" action="" method="POST">
                    @csrf
                    @if (session()->has('verify_success'))
                        <div class="alert alert-success m-2">
                            <span>{{ session('verify_success') }}</span>
                        </div>
                    @endif
                    <h4 class="mtext-105 cl2 txt-center p-b-30">
                        Đăng Nhập
                    </h4>

                    <div class="bor8 m-b-20 how-pos4-parent">
                        <input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" value="{{ old('email') }}" type="text"
                            name="email" placeholder="Nhập email">
                        {{-- <img class="how-pos4 pointer-none" src="images/icons/icon-email.png" alt="ICON"> --}}
                    </div>
                    @error('email')
                        <div class="m-b-10 p-l-10" style="margin-top: -10px">
                            <span class=" text-danger">{{ $message }}</span>
                        </div>
                    @enderror

                    <div class="bor8 m-b-20 how-pos4-parent">
                        <input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="password" name="password"
                            placeholder="Nhập mật khẩu">
                        {{-- <img class="how-pos4 pointer-none" src="images/icons/icon-email.png" alt="ICON"> --}}
                    </div>
                    @error('password')
                        <div class="m-b-10 p-l-10" style="margin-top: -10px">
                            <span class=" text-danger">{{ $message }}</span>
                        </div>
                    @enderror

                    @if (session()->has('error'))
                        <div class="alert alert-danger">
                            <span>{{ session('error') }}</span>
                        </div>
                    @endif

                    <button class="m-b-20 flex-c-m stext-101 cl0 size-121 bg3 bor1 hov-btn3 p-lr-15 trans-04 pointer">
                        Đăng Nhập
                    </button>

                    <div class="m-b-20 text-center">
                        <a href="{{ route('register.page') }}">Chưa có tài khoản? Đăng ký</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
