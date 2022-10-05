@extends('admin.main')
@section('content')
    <div class="container-fluid">
        <div class="card card-primary">
            @include("admin.components.alert")
            <!-- /.card-header -->
            <!-- form start -->
            <form action="" method="POST" id="admin-add-form">
                @csrf
                <div class="card-body">

                    <div class="form-group">
                        <label for="name">Tên</label>
                        <input type="text" value="{{ old('name') }}" name="name" class="form-control" id="name"
                            placeholder="Nhập tên danh mục">
                        @error('name')
                            <div class="alert text-danger">{{ $message }}</div>
                        @enderror
                    </div>


                    <div class="form-group">
                        <label for="level">Cấp</label>
                        <select name="level" class="form-control" id="menu-level">
                            <option value="0">Chọn cấp</option>
                            @foreach ($levelArray as $level)
                                <option value="{{ $level }}" {{ $level == old('level') ? 'selected' : '' }}>Cấp
                                    {{ $level }}</option>
                            @endforeach
                        </select>
                        @error('level')
                            <div class="alert text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div id="parent-id-block" class="form-group d-none">
                        <label for="parent_id">Danh Mục Cha</label>
                        <select name="parent_id" data-action="add" class="form-control" id="parent-id">
                            <option value="0" >Chọn danh mục</option>
                            @php
                                use Illuminate\Support\Facades\Session;
                                if(Session::has('parent_menu_list')){
                                    $parentMenuList = Session::get('parent_menu_list');
                                    foreach($parentMenuList as $item)
                                    {
                                        if($item->id == old("parent_id"))
                                        {
                                            echo '<option selected value="'.$item->id.'">'.$item->name.'</option>';
                                        }
                                        else
                                        {
                                            echo '<option value="'.$item->id.'">'.$item->name.'</option>';
                                        }                                      
                                    }
                                }
                            @endphp        
                        </select>
                        @error('parent_id')
                            <div class="alert text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    

                    <div class="form-group">
                        <label for="description">Mô Tả</label>
                        <textarea name="description" class="form-control" id="description" placeholder="Nhập mô tả">{{ old('description') }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="content">Mô Tả Chi Tiết</label>
                        <textarea name="content" class="form-control" id="content" placeholder="Nhập nội dung" cols="30" rows="3">{{ old('content') }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="">Kích Hoạt</label>
                        <div class="row">
                            <div class="custom-control custom-radio col-sm-4" style="padding-left: 2rem">
                                <input class="custom-control-input" type="radio" value="1" id="active"
                                    name="active" checked="">
                                <label for="active" class="custom-control-label">Có</label>
                            </div>
                            <div class="custom-control custom-radio col-sm-4" style="padding-left: 2rem">
                                <input class="custom-control-input" type="radio" value="0" id="inactive"
                                    name="active">
                                <label for="inactive" class="custom-control-label">Không</label>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" id="btn-add" class="btn btn-primary">Tạo</button>
                    <a  href="/admin/menus/1/list" class="btn btn-primary">Đến Danh Sách</a>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('footer')
    <!-- CKEditor -->
    <script src="/ckeditor/ckeditor.js"></script>
    <!-- Create CKEditor -->
    <script>
        CKEDITOR.replace('content');
    </script>
    <!-- File adminProduct js -->
    <script src="/template/admin/js/adminMenu.js"></script>
@endsection
