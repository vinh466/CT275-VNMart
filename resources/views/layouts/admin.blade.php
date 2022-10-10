<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="/img/LogoBrowser.png">
    <title>VNMart - @yield('title')</title>
    <!-- Font style -->
    <link rel="stylesheet" type="text/css" href="/font/awesome/css/all.css">
    <link href="/font/nunito/all.css" rel="stylesheet">
    <!-- Core plugin CSS-->
    <link rel="stylesheet" type="text/css" href="/plugins/Gijgo/css/gijgo.min.css"/>
    <link rel="stylesheet" type="text/css" href="/plugins/sb-admin-2/sb-admin-2.css">
    <link rel="stylesheet" type="text/css" href="/plugins/pacejs/pace.min.css">
    <!-- Custom styles for this template-->
    <link rel="stylesheet"  type="text/css"href="/css/Admin/custom.css">
    <link rel="stylesheet" type="text/css" href="/css/Admin/adminStyle.css">
    
    {{-- css --}}
    @yield("css")
    

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/home">
                <div class="sidebar-brand-text text-nowrap">VN Mart</div>
            </a>

            <!-- Nav Item - Account -->
            <li class="nav-item active avatar d-flex align-items-center flex-column ">
                <a class="nav-avatar-link" href="#!">
                    <img src="/img/admin/avatartest.jpg" class="rounded-circle" alt="UserAvatar">
                </a>
                <span class="greeting text-white d-none d-md-block">Xin chào Vinh !</span>
            </li>

            <!-- Dilider -->
            <hr class="sidebar-divider my-1">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item @yield('sidebar-active-home')">
                <a class="nav-link" href="/admin">
                    <i class="fas fa-fw fa-home-alt"></i>
                    <span>Trang chủ</span>
                </a>
            </li>

            <!-- Dilider -->
            <hr class="sidebar-divider my-1">

            <!-- Sidebar-Heading -->
            <div class="sidebar-heading mt-1">Quản lý</div>

            <!-- Nav Item - Charts -->
            <li class="nav-item @yield('sidebar-active-customer')">
                <a class="nav-link" href="/admin/customer">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Khách hàng</span>
                </a>
            </li>

            <!-- Nav Item - Charts -->
            <li class="nav-item @yield('sidebar-active-product')">
                <a class="nav-link" href="/admin/product">
                    <i class="fas fa-tags"></i>
                    <span>Sản phẩm</span>
                </a>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item @yield('sidebar-active-orders')">
                <a class="nav-link" href="/admin/orders">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Đơn hàng</span>
                </a>
            </li>


            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline mt-2">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>



        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>

                <!-- Topbar Breadcrumb -->
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb font-weight-bold text-secondary">
                        <li class="breadcrumb-item @yield('breadcrumb-active')"><a href="/admin">Trang chủ</a></li>
                        @yield('breadcrumb')
                    </ol>
                </nav>

                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto ">

                    <!-- Nav Item - User Information -->
                    <li class="nav-item  no-arrow d-flex align-items-center font-weight-bold mr-4 h7">
                        <!-- Clock Real Time -->
                        <div id="clock" class="d-none d-md-block"></div>
                    </li>
                    <li class="nav-item d-flex align-items-center mr-4 h4 mb-0 ">
                        <a href="/logout" class="text-danger font-weight-bold ">
                            <i class="fa fa-sign-out" aria-hidden="true"></i>
                        </a>
                        
                    </li>

                </ul>

            </nav>
            <!-- End of Topbar -->

            @yield('content')

            <!-- Footer -->
            <footer class="sticky-footer bg-white mt-auto">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="#!">Logout</a>
                </div>
            </div>
        </div>
    </div>


    <!-- Bootstrap core JavaScript-->
    <script type="text/javascript" src="/plugins/jquery/jquery.js"></script>
    <script type="text/javascript" src="/plugins/bootstrap/js/bootstrap.bundle.js"></script>
    <script src="/plugins/Gijgo/js/gijgo.js"></script>
    <script src="/plugins/sb-admin-2/sb-admin-2.js" defer></script>

    <!-- Core plugin JavaScript-->
    <script type="text/javascript" src="/plugins/pacejs/pace.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script type="text/javascript" src="/js/admin/admin.js" defer></script>

    @yield('script')
</body>



</html>