@extends('admin.main')
@section('content')
    <div class="card">
        @include('admin.components.alert')
        <!-- /.card-header -->
        <div class="card-body">
            <form action="" name="admin-form" id="admin-form">
                <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                    {{-- <div class="row">
                        <div class="col-sm-12 col-md-10">
                            <div class="dt-buttons btn-group flex-wrap mb-3">
                                <button onclick="deleteMultipleProducts()" id="btn-delete-multiple-row"
                                    class="btn btn-secondary " tabindex="0" aria-controls="example1"
                                    type="button"><span>Xóa Nhiều Sản Phẩm</span></button>
                            </div>
                        </div>
                    </div> --}}
                    <div class="row">
                        <div class="col-sm-12">
                            <table id="admin-purchase-order-table" class="table table-bordered table-striped dataTable dtr-inline"
                                role="grid" aria-describedby="example1_info">
                                <thead>
                                    <tr role="row">
                                        {{-- <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                            colspan="1" aria-label="Platform(s): activate to sort column ascending">
                                            <input type="checkbox" name="main-checkbox" id="check-all">
                                        </th> --}}
                                        {{-- <th class="sorting sorting_asc" tabindex="0" aria-controls="example1" rowspan="1"
                                            colspan="1" aria-sort="ascending"
                                            aria-label="Rendering engine: activate to sort column descending">ID</th> --}}
                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                            colspan="1" aria-label="Browser: activate to sort column ascending">Tên</th>
                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                            colspan="1" aria-label="Platform(s): activate to sort column ascending">Mã Đơn Hàng
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                            colspan="1" aria-label="Platform(s): activate to sort column ascending">Tổng Tiền
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                            colspan="1" aria-label="Platform(s): activate to sort column ascending">SĐT
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                            colspan="1" aria-label="Platform(s): activate to sort column ascending">
                                            Email
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                            colspan="1" aria-label="Platform(s): activate to sort column ascending">
                                            Địa Chỉ
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                            colspan="1" aria-label="Platform(s): activate to sort column ascending">
                                            Trạng Thái
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                            colspan="1" aria-label="Engine version: activate to sort column ascending"
                                            style="">Cập Nhật</th>
                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                            colspan="1" aria-label="CSS grade: activate to sort column ascending"
                                            style="">
                                            Chi tiết đơn</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!-- /.card-body -->

       
    </div>
@endsection

@section('script')
    <!-- File adminPurchaseOrder js -->
    <script src="/template/admin/js/adminPurchaseOrder.js"></script>
@endsection
