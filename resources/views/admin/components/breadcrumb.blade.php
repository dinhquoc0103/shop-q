<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>{{ isset($breadcrumb) ?  $breadcrumb : ''}}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route("admin") }}">Trang Chủ</a></li>
                    <li class="breadcrumb-item active">{{ isset($breadcrumb) ?  $breadcrumb : '' }}</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>