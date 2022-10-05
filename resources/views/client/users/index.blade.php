@extends('client.main')
@section('content')
    @include('client.components.breadcrumb')
    <div class="bg0 m-t-54 p-b-140">
        <div class="container">

            <div class="content">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-8 order-2 order-md-1">
                        <h3 class="text-dark m-b-20">Lịch sử giao dịch</h3>
                        @if (count($purchaseOrders) > 0)
                            <table class="table table-responsive">
                                <thead>
                                    <tr>
                                        <th>Mã đơn hàng</th>
                                        <th>Tổng tiền</th>
                                        <th>Ngày đặt</th>
                                        <th>Trạng thái đơn hàng</th>
                                        {{-- <th>Xem chi tiết đơn hàng</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($purchaseOrders as $key => $purchaseOrder)
                                        <tr>
                                            <td>{{ $purchaseOrder->code }}</td>
                                            <td>{{ number_format($purchaseOrder->total_price, 0, ' ', '.') }}đ</td>
                                            <td>{{ $purchaseOrder->created_at }}</td>
                                            <td>
                                                @foreach ($arrayStatus as $key => $status)
                                                    @if ($purchaseOrder->status == $key)
                                                        {{ $status }}
                                                    @endif
                                                @endforeach
                                            </td>
                                            {{-- <td>{{ $purchaseOrder->code }}</td> --}}
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        @else
                            <span>Chưa có giao dịch nào</span>
                        @endif
                    </div>

                    <div class="col-12 col-md-12 col-lg-4 order-1 order-md-2">
                        <h3 class="text-dark m-b-15">Thông tin tài khoản</h3>
                        <p class="text-muted">Để bảo mật tài khoản. Quý khách không nên cung cấp mật khẩu cho người khác</p>
                        <br>
                        <div class="text-muted">

                            <p class="m-b-10">
                                Họ Và Tên
                                <b class="d-block">{{ $user->name }}</b>
                            </p>
                            {{-- <p >
                                Số Điện Thoại
                                <b class="d-block">{{ $user->phone_number }}</b>
                            </p> --}}
                            <p class="m-b-10">
                                Email
                                <b class="d-block">{{ $user->email }}</b>
                            </p>
                            <p class="m-b-10">
                                Ngày Tạo Tài Khoản
                                <b class="d-block">{{ $user->created_at }}</b>
                            </p>
                            <p class="m-b-10">
                                Ngày Cập Nhật Tài Khoản
                                <b class="d-block">{{ $user->updated_at }}</b>
                            </p>
                        </div>

                        <div class="text-center mt-5 mb-3">
                            <a href="{{ route('user.update.info') }}" class="btn btn-sm btn-primary">Cập Nhật Tài Khoản</a>
                            {{-- <a href="#" class="btn btn-sm btn-warning">Report contact</a> --}}
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
