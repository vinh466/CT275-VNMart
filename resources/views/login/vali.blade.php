@extends('layouts.login')

@section('content')
		<div class="row">
			<div class="col-sm-8 offset-sm-2">

				<div class="mt-2">
					<div class="alert alert-info" role="alert">
						<h4>Bài tập 3: jQuery Validation Plugin</h4>
					</div>
				</div>
				<div class="card">
					<div class="card-header">
						<h3>Đăng ký thành viên</h3>
					</div>
					<div class="card-body">
						<form id="signupForm" method="post" class="form-horizontal" action="#">

							<div class="form-group row">
								<label class="col-sm-4 col-form-label" for="firstname">Tên của bạn</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" id="firstname" name="firstname" placeholder="Tên của bạn" />
								</div>
							</div>

							<div class="form-group row">
								<label class="col-sm-4 col-form-label" for="lastname">Họ của bạn</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" id="lastname" name="lastname" placeholder="Họ của bạn" />
								</div>
							</div>

							<div class="form-group row">
								<label class="col-sm-4 col-form-label" for="username">Tên đăng nhập</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" id="username" name="username" placeholder="Tên đăng nhập" />
								</div>
							</div>

							<div class="form-group row">
								<label class="col-sm-4 col-form-label" for="email">Hộp thư điện tử</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" id="email" name="email" placeholder="Hộp thư điện tử" />
								</div>
							</div>

							<div class="form-group row">
								<label class="col-sm-4 col-form-label" for="password">Mật khẩu</label>
								<div class="col-sm-5">
									<input type="password" class="form-control" id="password" name="password" placeholder="Mật khẩu" />
								</div>
							</div>

							<div class="form-group row">
								<label class="col-sm-4 col-form-label" for="confirm_password">Nhập lại mật khẩu</label>
								<div class="col-sm-5">
									<input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Nhập lại mật khẩu" />
								</div>
							</div>

							<div class="form-group form-check">
								<div class="col-sm-5 offset-sm-4">
									<input class="form-check-input" type="checkbox" id="agree" name="agree" value="agree" />
									<label class="form-check-label" for="agree">Đồng ý các quy định của chúng tôi</label>
								</div>
							</div>

							<div class="row">
								<div class="col-sm-5 offset-sm-4">
									<button type="submit" class="btn btn-primary" name="signup" value="Sign up">Đăng ký</button>
								</div>
							</div>
							
						</form>
					</div>
				</div>
			</div> <!-- Cột nội dung -->
		</div> <!-- Dòng nội dung -->


	@section('script')
        <script src="/js/account/validationForm.js"></script>
    @endsection
@endsection