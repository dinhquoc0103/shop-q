@extends('client.main')
@section('content')
    @include('client.components.breadcrumb')
    <div class="bg0 m-t-54 p-b-140">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="content col-lg-6 ">
                    <form action="{{ route('user.update.info') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Họ Và Tên</label>
                            <input type="text" id="name" name="name"  class="form-control"
                                value="{{ $user->name }}">
                        </div>
                        @error('name')
                            <div class="m-b-10 p-l-10" style="margin-top: -10px">
                                <span class=" text-danger">{{ $message }}</span>
                            </div>
                        @enderror

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" id="email" name="email"  class="form-control"
                                value="{{ $user->email }}">
                        </div>
                        @error('email')
                            <div class="m-b-10 p-l-10" style="margin-top: -10px">
                                <span class=" text-danger">{{ $message }}</span>
                            </div>
                        @enderror

                        <button type="submit" class="btn btn-success ">Lưu Thông Tin</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
