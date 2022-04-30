@extends('layouts.login')

@section('content')
    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                <div class="col-lg-7">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4"><b>Tạo tài khoản !</b></h1>
                        </div>
                        <form id="userRegister" action="/register" method="POST">
                            <div class="form-group">
                                <input type="email" class="form-control form-control-user" name="emailRegister" id="emailRegister" placeholder="Địa chỉ email">
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="text" class="form-control form-control-user" name="firstNameRegister" id="firstNameRegister" placeholder="Họ">
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control form-control-user" name="lastNameRegister" id="lastNameRegister" placeholder="Tên">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="text" class="form-control form-control-user" name="phoneRegister" id="phoneRegister" placeholder="Số điện thoại">
                                </div>
                                <div class="col-sm-6">
                                    <select class="form-select form-control form-control-user" name="genderRegister" id="genderRegister" aria-label="Default select example">
                                        <option selected>Giới tính</option>
                                        <option value="0">Nam</option>
                                        <option value="1">Nữ</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="password" class="form-control form-control-user" name="passwordRegister" id="passwordRegister" placeholder="Mật khẩu">
                                </div>
                                <div class="col-sm-6">
                                    <input type="password" class="form-control form-control-user" name="rePasswordRegister" id="rePasswordRegister" placeholder="Nhập lại mật khẩu">
                                </div>
                            </div>
                            <button type="submit" id="submitRegister" name="submitRegister" class="btn btn-primary btn-user btn-block" value="Sign up">Đăng ký tài khoản</button>
                            <hr>
                            <a href="#!" class="btn btn-google btn-user btn-block">
                                <i class="fab fa-google fa-fw"></i> Đăng ký với tài khoản Google
                            </a>
                            <a href="#!" class="btn btn-facebook btn-user btn-block">
                                <i class="fab fa-facebook-f fa-fw"></i> Đăng ký với tài khoản Facebook
                            </a>
                        </form>
                        <hr>
                        <div class="text-center">
                            <a class="small" href="/forgot-password">Quên mật khẩu?</a>
                        </div>
                        <div class="text-center">
                            <a class="small" href="/login">Đã có tài khoản? đăng nhập!</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection

@section('script')
    <script src="/js/account/validationFrom.js" defer></script>
@endsection