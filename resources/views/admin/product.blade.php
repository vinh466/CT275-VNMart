@extends('layouts.admin')

@section('title', $title)

@section('css')
    <style>
    .custom-csv-button {}
    .custom-print-button {
        background-color: #36b9cc!important;
        color: #fff!important;
        border-radius: 10px!important;
        float: right!important;
        margin-right: 10px!important;
    }
    </style>
@endsection

@section('sidebar-active-product', 'active' )

@section('breadcrumb')
    <li class="breadcrumb-item active"><a href="/admin/product">Quản lý Sản phẩm</a></li>
@endsection

@section('content')
    <!-- Main Content -->
    <div id="content">

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Content Row -->
            <div class="row">

                <!-- DataTales Example -->
                <div class="col card shadow mb-4">
                    {{-- <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold">Khách hàng </h6>
                    </div> --}}
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered mb-2" id="dataTable-products" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>SP_Ma</th>
                                        <th>Ten</th>
                                        <th>MoTa</th>
                                        <th>Anh</th>
                                        <th>Loại</th>
                                        <th>SoLuong</th>
                                        <th>DonGia</th>
                                        <th>GiamGia</th>
                                        <th>TrangThai</th>
                                        <th>DonVi</th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                

            </div>

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->
@endsection

@section('script')
    <script src="/js/admin/product.js" defer></script>
@endsection