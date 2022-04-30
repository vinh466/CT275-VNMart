@extends('layouts.login')

@section('title', $title )

@section('content')
    <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Chào mừng trở lại!</h1>
                                        
                                        @isset( $ErrorLogin )
                                            <h4 class="h6 text-danger"> <b>  {{ $ErrorLogin }}  </b> </h4> 
                                        @endisset
                                            
                                    </div>
                                    <form id="userLogin" action="/login" method="POST">
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user"
                                                id="emailLogin" name="emailLogin" aria-describedby="emailHelp"
                                                placeholder="Địa chỉ email...">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                id="passwordLogin" name="passwordLogin" placeholder="Mật khẩu">
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheckLogin" name="remember">
                                                <label class="custom-control-label" for="customCheckLogin">Nhớ phiên đăng nhập</label>
                                            </div>
                                        </div>
                                        <button type="submit" id="submitLogin" name="submitLogin" class="btn btn-primary btn-user btn-block" value="login">Đăng nhập</button>
                                        <hr>
                                    </form>
                                    <form action="/login/google" method="POST" class="mb-2">
                                        <button type="submit" class="btn btn-google btn-user btn-block">
                                            <i class="fab fa-google fa-fw"></i> Đăng nhập với Google
                                        </button>
                                    </form>
                                    <form action="/login/facebook" method="POST">
                                        <button type="submit" class="btn btn-facebook btn-user btn-block">
                                            <i class="fab fa-facebook-f fa-fw"></i> Đăng nhập với Facebook
                                        </button>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="/forgot-password">Quên mật khảu?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="/register">Tạo một tài khoản mới!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
@endsection