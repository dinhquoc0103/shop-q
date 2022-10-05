@extends('admin.main')
@section('content')
<div class="container-fluid">
    <div class="card card-primary">
        @include("admin.components.alert")
        <!-- /.card-header -->
        <!-- form start -->
        <form action="" method="POST"> 
            @csrf
            <div class="card-body">

                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="name">Tiêu Đề</label>
                        <input type="text" value="{{ old('name') }}" name="name" class="form-control" id="name" placeholder="Nhập tiêu đề">
                        @error('name')
                            <div class="alert text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <label for="price">Thứ Tự</label>
                        <input type="number" value="{{ old('numerical_order') }}" name="numerical_order" class="form-control" id="numerical_order"
                            placeholder="Nhập thứ tự">
                        @error('numerical_order')
                            <div class="alert text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="name">Liên Kết</label>
                    <input type="text" value="{{ old('url') }}" name="url" class="form-control" id="url" placeholder="Nhập liên kết">
                    @error('url')
                        <div class="alert text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <div class="custom-file">
                        <label for="file">Ảnh</label>
                        <input type="file" value="18" name="file" class="form-control" style="padding: 0.2rem 0.75rem "
                            id="upload">
                        @error('thumb')
                            <div class="alert text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div id="show-image" class="ml-2 mt-3">
                    </div>
                    <input type="hidden" name="thumb" id="thumb">

                </div>

                <div class="form-group">
                    <label for="">Kích Hoạt</label>
                    <div class="row">
                        <div class="custom-control custom-radio col-sm-4" style="padding-left: 2rem">
                            <input class="custom-control-input" type="radio" value="1" id="active" name="active"
                                checked="">
                            <label for="active" class="custom-control-label">Có</label>
                        </div>
                        <div class="custom-control custom-radio col-sm-4" style="padding-left: 2rem">
                            <input class="custom-control-input" type="radio" value="0" id="inactive" name="active">
                            <label for="inactive" class="custom-control-label">Không</label>
                        </div>
                    </div>
                </div>

            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" id="btn-add" class="btn btn-primary mr-1">Tạo</button>
                <a  href="{{ route("listSlider") }}" class="btn btn-primary">Đến Danh Sách</a>
            </div>
        </form>

        <form action="" name="form-hidden-slider" id="form-hidden">
            <input type="hidden" name="archive-folder-name" value="sliders">
        </form>
    </div>
</div>
@endsection