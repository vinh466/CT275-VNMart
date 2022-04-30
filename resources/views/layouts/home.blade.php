<!DOCTYPE html>
<html>
   <head>
      <title>VNMart</title>
      <meta charset="utf-8">
      <link rel="shortcut icon" href="/img/LogoBrowser.png">
      <link rel="stylesheet" type="text/css" href="/plugins/bootstrap/css/bootstrap.css">
      <link rel="stylesheet" type="text/css" href="/font/awesome/css/all.css">
      <link rel="stylesheet" type="text/css" href="/plugins/pacejs/pace.min.css">
      <link rel="shortcut icon" href="/img/LogoBrowser.png">
      <!-- CSS -->
      <link rel="stylesheet" type="text/css" href="/css/Home/home.css">
      <link rel="stylesheet" type="text/css" href="/css/Home/cart.css">
      @yield('cssLink')
      <style>
         .dropdown-toggle::after {
            content: none;
         }
      </style>
   </head>
   <body>

      <!-- Toast  -->
        <div class="toast-container"></div>
        <!-- Modal -->
        <div class="modal fade " id="staticBackdrop"  tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Đặt Món</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body"></div>
                </div>
            </div>
        </div>

      {{-- Lớp phủ khi click vào danh mục --}}
      <div id="black-layer"></div>

      <header>
         <div class="top-header">
            <div class="top-header">
               <nav class="navbar navbar-expand-lg bg-light">
                  <div class="container-lg">
                     <a class="navbar-brand" href="/"><img id="logo" src="/img/home/logo.PNG"></a>	
                     <!-- Collection of nav links, forms, and other content for toggling -->
                     <div id="navbarCollapse" class="collapse navbar-collapse justify-content-between">		

                        <form class="d-flex search-form" action="/home/search" method="POST">
                           <input class="form-control" name="searchProducts" type="search" placeholder="Tìm kiếm sản phẩm..." aria-label="Search">
                           <button class="btn search-btn" name="search" value="search" type="submit"><a>Tìm kiếm</a></button>
                        </form>

                        <div class="navbar-nav ml-auto align-items-center">
                           <div class="nav-item">
                              <a href="/cart" class="nav-link text-dark fw-bold menu-btn"><img src="/img/home/cart.png" width="40" height="40"> Giỏ Hàng</a>
                           </div>

                           @if (!isset($_SESSION['user']))
                              {{-- Not logged --}}
                              <div class="nav-item">
                                 <a href="/login" class="nav-link text-dark fw-bold menu-btn"><img src="/img/home/user.png"> Đăng nhập</a>
                              </div>
                           @else
                              {{-- Logged --}}
                              <div class="nav-item dropdown ml-2">
                                 <a href="#" aria-expanded="true" id="dropdownMenuAcc" data-bs-toggle="dropdown" class="nav-item nav-link dropdown-toggle user-action">
                                    <img src="@if (unserialize($_SESSION['user'])->AnhCaNhan == NULL)
                                          {{"/img/home/user.png"}}
                                       @else
                                          {{unserialize($_SESSION['user'])->AnhCaNhan}}
                                       @endif" 
                                       class="avatar rounded-circle" alt="avatar"  width="40" height="40">
                                    {{unserialize($_SESSION['user'])->Ten . ' ' .unserialize($_SESSION['user'])->Ho}}
                                 </a>

                                 <div class="dropdown-menu" aria-labelledby="dropdownMenuAcc">
                                    <a href="#" class="dropdown-item"><i class="fa fa-user-o"></i> Trang cá nhân</a>
                                    <a href="#" class="dropdown-item"><i class="fa fa-sliders"></i> Cài đặt</a>
                                    <div class="divider dropdown-divider"></div>
                                    <a href="/logout" class="dropdown-item"><i class="fas fa-sign-in"></i> Đăng xuất</a>
                                 </div>
                              </div>
                           @endif

                        </div>
                     </div>

                  </div>
               </nav>
            </div>
         </div>
         <div class="bot-header">
            <div class="menu menu-list">
               <div class=" container-lg">
                  <a id="list-product-btn" class="btn text-light">
                     <img src="/img/home/list.png"> DANH MỤC SẢN PHẨM
                  </a>
                  <div class="menu-right">
                     <a class=" btn text-light" href="/tuyendung">TUYỂN DỤNG</a>
                     <a class=" btn text-light" href="/lienhe">LIÊN HỆ</a>
                  </div>
                  {{-- List --}}
                  <div id="list-product" class="container">
                     <div class="list-group row row-cols-5">

                        @foreach ($listData as $item)   

                              <form class="list-group-item" action="/home/category/" method="POST">    
                                 <input type="text" hidden name="DM_Ma" value=" {{$item->DM_Ma}} ">
                                 <a style="text-decoration: none;" href="#">{{ $item->Ten }}</a>
                              </form>

                           

                        @endforeach

                     </div>
                  </div>
               </div>
            </div>
         </div>
      </header>

      <main>
         @yield('content')
      </main>

      <footer
         class="text-center text-lg-start text-white"
         style="background-color: #1c2331"
      >
         <!-- Section: Social media -->
         <section
            class="social-media d-flex justify-content-between p-3"
            style="background-color: #dc3545"
         >
            <div class="me-5">
               <span>Kết nối với chúng tôi:</span>
            </div>
            <div>
               <a href="#!" class="text-white me-4"><i class="fab fa-facebook-f"></i></a>
               <a href="#!" class="text-white me-4"><i class="fab fa-twitter"></i></a>
               <a href="#!" class="text-white me-4"><i class="fab fa-google"></i></a>
            </div>
         </section>

         <!-- Section: Links  -->
         <section class="links">
            <div class="container text-center text-md-start mt-5">
               <div class="row mt-3">
               <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                  <img class="mb-3" src="./img/Logo_Img.png" alt="">
                  <p>
                     Công Ty Dịch Vụ Thương Mại Tổng Hợp VNMartV2T
                     <br>Mã số doanh nghiệp: 0123456789 
                     <br>Đăng ký ngày 01 tháng 4 năm 2022.
                  </p>
               </div>
               <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                  <h6 class="text-uppercase fw-bold">Về chúng tôi</h6>
                  <hr
                     class="mb-4 mt-0 d-inline-block mx-auto"
                     style="width: 60px; background-color: #7c4dff; height: 2px"
                  />
                  <p><a href="#!" class="footer-link text-white" style="text-decoration: none; font-size: 15px">Giới thiệu VNMart</a></p>
                  <p><a href="#!" class="footer-link text-white" style="text-decoration: none; font-size: 15px">Danh sách cửa hàng</a></p>
                  <p><a href="#!" class="footer-link text-white" style="text-decoration: none; font-size: 15px">Quản lý chất lượng</a></p>
                  <p><a href="#!" class="footer-link text-white" style="text-decoration: none; font-size: 15px">Chính sách bảo mật</a></p>
                  <p><a href="#!" class="footer-link text-white" style="text-decoration: none; font-size: 15px">Điều khoản và điều kiện giao dịch</a></p>
               </div>
               <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
                  <h6 class="text-uppercase fw-bold">Hỗ trợ khách hàng</h6>
                  <hr
                     class="mb-4 mt-0 d-inline-block mx-auto"
                     style="width: 60px; background-color: #7c4dff; height: 2px"
                  />
                  <p><a href="#!" class="footer-link text-white" style="text-decoration: none; font-size: 15px">Trung tâm hỗ trợ khách hàng</a></p>
                  <p><a href="#!" class="footer-link text-white" style="text-decoration: none; font-size: 15px">Chính sách giao hàng</a></p>
                  <p><a href="#!" class="footer-link text-white" style="text-decoration: none; font-size: 15px">Chính sách thanh toán</a></p>
                  <p><a href="#!" class="footer-link text-white" style="text-decoration: none; font-size: 15px">Chính sách đổi trả</a></p>
                  <p><a href="#!" class="footer-link text-white" style="text-decoration: none; font-size: 15px">Chính sách chiết khấu ưu đãi mua sắm</a></p>
               </div>
               <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                  <h6 class="text-uppercase fw-bold" style="text-decoration: none;">Chăm sóc khách hàng</h6>
                  <hr
                     class="mb-4 mt-0 d-inline-block mx-auto"
                     style="width: 60px; background-color: #7c4dff; height: 2px"
                  />
                     <p><a href="#!" class="footer-link text-white" style="text-decoration: none;">Mua Online: +84 012 3456 789</a></p>
                     <p><a href="#!" class="footer-link text-white" style="text-decoration: none;">Email: cskh.vnmart@mail.com</a></p>
               </div>
            </div>
         </section>
      </footer>
      <!-- Footer -->
      <script type="text/javascript" src="/plugins/jquery/jquery.js"></script>
      <script type="text/javascript" src="/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
      <script type="text/javascript" src="/plugins/pacejs/pace.min.js"></script>
      <script type="text/javascript" src="/js/home/home.js"></script>   
   </body>
</html>