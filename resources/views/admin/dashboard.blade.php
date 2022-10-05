@extends('admin.main')
@section('content')
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">

            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ number_format($systemRevenue, 0, '', '.') }}đ</h3>

                        <p>Doanh Số Hệ Thống</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="#" class="small-box-footer">
                        {{-- More info <i class="fas fa-arrow-circle-right"></i> --}}
                    </a>
                </div>
            </div>

            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        {{-- 53<sup style="font-size: 20px">%</sup> --}}
                        <h3>{{ $successfulPurchaseOrder }}</h3>

                        <p>Đơn Hàng Thành Công</p>
                    </div>
                    <div class="icon">
                        {{-- <i class="ion ion-stats-bars"></i> --}}
                        <i class="fa-solid fa-badge-check"></i>
                    </div>
                    <a href="#" class="small-box-footer">
                        {{-- More info <i class="fas fa-arrow-circle-right"></i> --}}
                    </a>
                </div>
            </div>

            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{ $processingPurchaseOrder }}</h3>

                        <p>Đơn Hàng Đang Xử Lý</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="#" class="small-box-footer">
                        {{-- More info <i class="fas fa-arrow-circle-right"></i> --}}
                    </a>
                </div>
            </div>

            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{ $cancelingPurchaseOrder }}</h3>

                        <p>Đơn Hàng Hủy</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="#" class="small-box-footer">
                        {{-- More info <i class="fas fa-arrow-circle-right"></i> --}}
                    </a>
                </div>
            </div>

            <!-- ./col -->
        </div>

        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
            <!-- Left col -->
            <section class="col-lg-8 connectedSortable">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">SẢN PHẨM MỚI CẬP NHẬT</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                        <table class="table table-striped table-responsive-lg">
                            <thead>
                                <tr>
                                    <th>Tên</th>
                                    <th>Ảnh</th>
                                    <th>Danh Mục</th>
                                    <th>Giá</th>
                                    <th>Giảm</th>
                                    <th>Trạng Thái</th>
                                    <th>Ngày Tạo</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($newProducts as $key => $product)
                                    <tr>
                                        <td>{{ $product->name }}</td>
                                        <td><img width="100px" height="100px" src="{{ $product->thumb }}" alt="">
                                        </td>
                                        <td>{{ $product->menu->name }}</td>
                                        <td>{{ number_format($product->price, 0, '', '.') }}đ</td>
                                        <td>{{ $product->discount }}</td>
                                        <td>{!! App\Helpers\Helper::renderActive($product->active) !!}</td>
                                        <td>{{ $product->created_at }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                    <!-- /.card-body -->
                </div>
            </section>
            <!-- /.Left col -->
            <!-- right col (We are only adding the ID to make the widgets sortable)-->
            <section class="col-lg-4 connectedSortable">

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">NGƯỜI DÙNG MỚI ĐĂNG KÝ TÀI KHOẢN</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered table-responsive-lg p-r-10">
                            <thead>
                                <tr>
                                    {{-- <th>Tên</th> --}}
                                    <th>Email</th>
                                    <th>Ngày Tạo</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($newUsers as $key => $user)
                                    <tr>
                                        {{-- <td>{{ $user->name }}</td> --}}
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->created_at }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
            <!-- right col -->
        </div>
        <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
@endsection
