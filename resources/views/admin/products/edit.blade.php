@extends('admin.main')
@section('content')
    <div class="container-fluid">
        <div class="card card-primary">
            @include('admin.components.alert')
            <!-- /.card-header -->
            <!-- form start -->
            <form action="" method="POST">
                @csrf
                <div class="card-body">

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="name">Tên</label>
                            <input type="text" value="{{ $product->name }}" name="name" class="form-control"
                                id="name" placeholder="Nhập tên sản phẩm">
                            @error('name')
                                <div class="alert text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="menu_id">Danh Mục</label>
                            <select name="menu_id" class="form-control" id="menu_id">
                                <option value="" selected>Chọn danh mục</option>
                                @foreach ($menus as $menu)
                                    <option value="{{ $menu->id }}"
                                        {{ $menu->id == $product->menu_id ? 'selected' : '' }}>{{ $menu->name }}</option>
                                @endforeach
                            </select>
                            @error('menu_id')
                                <div class="alert text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="price">Giá Gốc</label>
                            <input type="number" value="{{ $product->price }}" name="price" class="form-control"
                                id="price" placeholder="Nhập giá sản phẩm">
                            @error('price')
                                <div class="alert text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="discount">Giảm giá</label>
                            <input type="number" value="{{ $product->discount }}" name="discount" class="form-control"
                                id="discount" placeholder="Nhập tên phần trăm giảm">
                            @error('discount')
                                <div class="alert text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div id="size-block">
                        <label for="size">Kích Thước (Size hết hoặc không có => nhập 0)</label>
                        <div class="row">
                            @foreach ($product->sizes as $key => $size)
                                <div class="form-group  col-md-3">
                                    <label for="size-{{ $size->name }}">Size {{ $size->name }}</label>

                                    <input type="hidden" value="{{ $size->id }}" name="size[]"
                                        id="size-{{ $size->name }}" class="size-checkbox">

                                    <input type="number" value="{{ $size->pivot->quantity }}" name="quantity[]"
                                        id="{{ $size->name }}-quantity" class="form-control" placeholder="Nhập số lượng">

                                    @if ($errors->has('quantity.' . $key))
                                        <div class="alert text-danger"> {{ $errors->first('quantity.' . $key) }}</div>
                                    @endif

                                </div>
                            @endforeach
                            @error('size')
                                <div class="alert text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="custom-file">
                            <label for="file">Ảnh</label>
                            <input type="file" name="file" class="form-control" style="padding: 0.2rem 0.75rem "
                                id="upload">
                            @error('thumb')
                                <div class="alert text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div id="show-image" class="ml-2 mt-3">
                            <a href="{{ $product->thumb }}">
                                <img src="{{ $product->thumb }}" alt="{{ $product->name }}" width="200px",
                                    height="200px">
                            </a>
                        </div>
                        <input type="hidden" name="thumb" id="thumb" value="{{ $product->thumb }}">

                    </div>

                    <div class="form-group">
                        <label for="description">Mô Tả</label>
                        <textarea name="description" class="form-control" id="description" placeholder="Nhập mô tả">{{ $product->description }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="content">Mô Tả Chi Tiết</label>
                        <textarea name="content" class="form-control" id="content" placeholder="Nhập nội dung" cols="30" rows="3">{{ $product->content }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="">Kích Hoạt</label>
                        <div class="row">
                            <div class="custom-control custom-radio col-sm-4" style="padding-left: 2rem">
                                <input class="custom-control-input" type="radio" value="1" id="active"
                                    name="active" {{ $product->active == 1 ? 'checked=""' : '' }}>
                                <label for="active" class="custom-control-label">Có</label>
                            </div>
                            <div class="custom-control custom-radio col-sm-4" style="padding-left: 2rem">
                                <input class="custom-control-input" type="radio" value="0" id="inactive"
                                    name="active" {{ $product->active == 0 ? 'checked=""' : '' }}>
                                <label for="inactive" class="custom-control-label">Không</label>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" id="btn-add" class="btn btn-primary mr-1">Cập Nhật</button>
                    <a href="{{ route('listProduct') }}" class="btn btn-primary">Trở Về Danh Sách</a>
                </div>
            </form>

            <form action="" name="form-hidden-product" id="form-hidden">
                <input type="hidden" name="archive-folder-name" value="products">
            </form>
        </div>
    </div>
@endsection

@section('footer')
    <script src="/ckeditor/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('content');
    </script>
@endsection
