@extends('admin.main')
@section('content')
    <section class="content">

        <!-- Default box -->
        <div class="card">

            <div class="card-header">
                <h3 class="card-title">Đơn Hàng <strong><u>{{ $purchaseOrder->code }}</u></strong></h3>

                <div class="card-tools">
                    <a href="{{ route('admin.list.purchase.order') }}" class="btn btn-primary" title="Collapse">
                        Danh Sách Đơn Hàng
                    </a>
                </div>
            </div>

            <div class="card-body">
                <div class="row">

                    <div class="col-12 col-md-12 col-lg-8 order-2 order-md-1">
                        <table class="table table-responsive-lg">
                            <thead>
                                <tr>
                                    <th>Ảnh</th>
                                    <th>Tên</th>
                                    <th>Giá</th>
                                    <th>Số Lượng</th>
                                    <th>Tổng Giá</th>
                                </tr>
                            </thead>
                            <tbody>
                              
                                @foreach ($productsInPurchaseOrder as $product)
                                    <tr>
                                        <td>
                                            <img width="60px" height="60px" src="{{ $product->thumb }}" alt="">
                                        </td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ number_format($product->price, 0, '', '.') }}đ</td>
                                        <td>{{ $product->quantity }}</td>
                                        <td>{{ number_format($product->total_price, 0, '', '.')  }}đ</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="col-12 col-md-12 col-lg-4 order-1 order-md-2">
                        <h3 class="text-primary">Shop Q</h3>
                        <div class="text-muted">
                            <p>
                                Họ Và Tên
                                <b class="d-block">{{ $purchaseOrder->name }}</b>
                            </p>
                            <p>
                                Số Điện Thoại
                                <b class="d-block">{{ $purchaseOrder->phone_number }}</b>
                            </p>
                            <p>
                                Email
                                <b class="d-block">{{ $purchaseOrder->email }}</b>
                            </p>
                            <p>
                                Địa Chỉ Nhận Hàng
                                <b class="d-block">{{ $purchaseOrder->phone_number }}</b>
                            </p>
                            <p>
                                Ghi Chú Cho Đơn Hàng
                                <b class="d-block">{{ $purchaseOrder->phone_number }}</b>
                            </p>
                            <p>
                                Tổng Giá Trị Đơn Hàng Chưa Tính Ship
                                <b class="d-block text-success">{{ number_format($productsInPurchaseOrder->sum("total_price"), 0, '', '.')}}đ</b>
                            </p>
                            <p>
                                Phí Ship
                                <b class="d-block">28.000đ toàn quốc</b>
                            </p>
                            <p>
                                Tổng Giá Trị Đơn Hàng Đã Tính Ship
                                <b class="d-block text-success">{{ number_format($productsInPurchaseOrder->sum("total_price") + 28000, 0, '', '.')}}đ</b>
                            </p>
                        </div>

                        <h5 class="mt-5 text-muted">Thông Tin Vận Chuyển, Thanh Toán</h5>
                        <ul class="list-unstyled">
                            <li>
                                <i class="fa fa-truck" aria-hidden="true"></i>
                                Vận chuyển:
                                <a href="" class="btn-link text-secondary">

                                    Giao hàng tiết kiệm (28k cho toàn quốc)
                                </a>
                            </li>
                            <li>
                                <i class="far fa-fw fa-file-word"></i>
                                Thanh Toán:
                                <a href="" class="btn-link text-secondary">
                                    Thanh toán khi nhận hàng (COD)
                                </a>
                            </li>
                        </ul>
                        {{-- <div class="text-center mt-5 mb-3">
                            <a href="#" class="btn btn-sm btn-primary">Add files</a>
                            <a href="#" class="btn btn-sm btn-warning">Report contact</a>
                        </div> --}}
                    </div>

                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

    </section>
@endsection
