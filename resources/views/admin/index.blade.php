@extends('layouts.admin')

@section('title', $title)

@section('sidebar-active-home', 'active' )

@section('breadcrumb-active', 'active')

@section('content')
    <!-- Main Content -->
    <div id="content">

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Content Row -->
            <div class="row">

                <!-- Cumtomers (Monthly) Card Example -->
                <div class="col-xxl-3 col-lg-6 mb-4 text-success">
                    <div class="card border-left-current shadow card-content h-100">
                        <div class="row no-gutters h-100">
                            <div class="col mr-2 p-3">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">
                                    Khách hàng (hàng tháng)</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $countCustomer }} Khách hàng</div>
                                <p class="m-0 text-md text-gray-600">Số khách hàng hoạt động hàng tháng.</p>
                            </div>
                            <div class="col-auto card-icon">
                                <i class="fas fa-users fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Orthers (Monthly) Card Example -->
                <div class="col-xxl-3 col-lg-6 mb-4 text-warning">
                    <div class="card border-left-current shadow card-content h-100">
                        <div class="row no-gutters h-100">
                            <div class="col mr-2 p-3">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">
                                    Đơn hàng (hàng tháng)</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $countOrder }} Đơn hàng</div>
                                <p class="m-0 text-md text-gray-600">Tổng số hóa đơn bán hàng trong tháng.</p>
                            </div>
                            <div class="col-auto card-icon">
                                <i class="fas fa-calendar-check fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Products Card Example -->
                <div class="col-xxl-3 col-lg-6 mb-4 text-info">
                    <div class="card border-left-current shadow card-content h-100">
                        <div class="row no-gutters h-100">
                            <div class="col mr-2 p-3">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">
                                    Tổng sản phẩm</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $countProduct }} Sản phẩm</div>
                                <p class="m-0 text-md text-gray-600">Tổng số sản phẩm được quản lý.</p>
                            </div>
                            <div class="col-auto card-icon">
                                <i class="fas fa-database fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pending Requests Card Example -->
                <div class="col-xxl-3 col-lg-6 mb-4 text-danger">
                    <div class="card border-left-current shadow card-content h-100">
                        <div class="row no-gutters h-100">
                            <div class="col mr-2 p-3">
                                <div class="text-xs font-weight-boldtext-uppercase mb-1">
                                    Sắp hết hàng</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $outStockProduct }} Sản phẩm</div>
                                <p class="m-0 text-md text-gray-600">Sản phẩm sắp hết, cần nhập thêm.</p>
                            </div>
                            <div class="col-auto card-icon">
                                <i class="fas fa-exclamation fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- Content Row -->
            <div class="row justify-content-between">
                <div class="col-6 shadow">
                    <table id="grid"> </table>
                </div>
                <div class="col-6 shadow">
                    <table id="grid2"> </table>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- End of Main Content -->
@endsection

@section('script')
<script src="/js/admin/index.js" defer></script>
@endsection