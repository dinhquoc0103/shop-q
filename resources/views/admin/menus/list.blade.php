@extends("admin.main")
@section('content')
    
    <div class="card">
        @include("admin.components.alert")
        <!-- /.card-header -->
        <div class="card-body">
            <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                <div class="row">
                    <div class="col-sm-12 col-md-10">
                        <div class="dt-buttons btn-group flex-wrap mb-3">
                            <button onclick="deleteMultipleMenus()" id="btn-delete-multiple-row"
                                class="btn btn-secondary btn-delete-multiple" tabindex="0" aria-controls="example1"
                                type="button"><span>Xóa Nhiều Danh Mục</span></button>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <table id="admin-menu-table-{{ $level }}" class="table table-bordered table-striped dataTable dtr-inline" role="grid"
                            aria-describedby="example1_info">
                            <thead>
                                <tr role="row">
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                            colspan="1" aria-label="Platform(s): activate to sort column ascending">
                                            <input type="checkbox" name="main-checkbox" id="check-all">
                                        </th>
                                    {{-- <th class="sorting sorting_asc" tabindex="0" aria-controls="example1" rowspan="1"
                                        colspan="1" aria-sort="ascending"
                                        aria-label="Rendering engine: activate to sort column descending">ID</th> --}}
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                        aria-label="Browser: activate to sort column ascending">Tên</th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                        aria-label="Platform(s): activate to sort column ascending">Trạng Thái</th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                        aria-label="Engine version: activate to sort column ascending" style="">Cập Nhật</th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                        aria-label="CSS grade: activate to sort column ascending" style="">Thao Tác</th>
                                </tr>
                            </thead>
                            <tfoot>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
@endsection
@section('script')
    <!-- File adminProduct js -->
    <script src="/template/admin/js/adminMenu.js"></script>
@endsection

