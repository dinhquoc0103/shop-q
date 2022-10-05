@extends('client.main')
@section('content')
    @include('client.components.breadcrumb')
    <section class="bg0 p-t-18 p-b-116">
        <div class="container d-flex justify-content-center">
            <div class="size-210 bor10 p-lr-70 p-t-55 p-b-70 p-lr-15-lg w-full-md">
                <form id="" action="{{ route('register.page') }}", method="POST">
                    @csrf
                    <h4 class="mtext-105 cl2 txt-center p-b-30">
                        Đăng Ký Tài Khoản
                    </h4>

                    <div class="bor8 m-b-20 how-pos4-parent">
                        <input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" value="{{ old("name") }}" type="text" name="name"
                            placeholder="Nhập họ và tên">
                        {{-- <img class="how-pos4 pointer-none" src="/template/client/images/icons/icon-email.png" alt="ICON"> --}}
                    </div>
                    @error('name')
                        <div class="m-b-10 p-l-10" style="margin-top: -10px">
                            <span class=" text-danger" >{{ $message }}</span>
                        </div>
                    @enderror

                    <div class="bor8 m-b-20 how-pos4-parent">
                        <input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" value="{{ old("email") }}"  type="email" name="email"
                            placeholder="Nhập email">
                        {{-- <img class="how-pos4 pointer-none" src="images/icons/icon-email.png" alt="ICON"> --}}
                    </div>
                    @error('email')
                        <div class="m-b-10 p-l-10" style="margin-top: -10px">
                            <span class=" text-danger" >{{ $message }}</span>
                        </div>
                    @enderror

                    <div class="bor8 m-b-20 how-pos4-parent">
                        <input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="password" name="password"
                            placeholder="Nhập lại mật khẩu">
                        {{-- <img class="how-pos4 pointer-none" src="images/icons/icon-email.png" alt="ICON"> --}}
                    </div>
                    @error('password')
                        <div class="m-b-10 p-l-10" style="margin-top: -10px">
                            <span class=" text-danger" >{{ $message }}</span>
                        </div>
                    @enderror

                    <div class="bor8 m-b-20 how-pos4-parent">
                        <input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="password" name="confirm_password"
                            placeholder="Nhập lại mật khẩu">
                        {{-- <img class="how-pos4 pointer-none" src="images/icons/icon-email.png" alt="ICON"> --}}
                    </div>
                    @error('confirm_password')
                        <div class="m-b-10 p-l-10" style="margin-top: -10px">
                            <span class=" text-danger" >{{ $message }}</span>
                        </div>
                    @enderror

                    {{-- <div class="bor8 m-b-30">
                        <textarea class="stext-111 cl2 plh3 size-120 p-lr-28 p-tb-25" name="msg" placeholder="How Can We Help?"></textarea>
                    </div> --}}

                    <button class="m-b-20 flex-c-m stext-101 cl0 size-121 bg3 bor1 hov-btn3 p-lr-15 trans-04 pointer">
                        Đăng Ký
                    </button>

                    <div class="m-b-20 text-center">
                        <a href="{{ route("login.page") }}">Đã có tài khoản? Đăng nhập</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
