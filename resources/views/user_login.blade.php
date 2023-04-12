@extends('layout')
@section('content')
<div class="container">
			<div class="row">
				<div class="col-sm-4 col-sm-offset-1">
					<div class="login-form"><!--login form-->
						<h2>Đăng nhập</h2>
						<form action="{{URL::to('/dang-nhap')}}" method="post">
							{{ csrf_field() }}
							<input type="email" name="user_email" placeholder="Email" />
							<input type="password" name="user_password" placeholder="Mật khẩu" />
							
							<button type="submit" name="login" class="btn btn-default">Đăng nhập</button>
						</form>
					</div><!--/login form-->
				</div>
				<div class="col-sm-1">
					<h2 class="or">Hoặc</h2>
				</div>
				<div class="col-sm-4">
					<div class="signup-form"><!--sign up form-->
						<h2>Đăng ký</h2>
						<form action="{{URL::to('/dang-ky')}}" method="post">
							{{ csrf_field() }}
							<input type="email" name="user_email" placeholder="Địa chỉ Email"/>
							<input type="password" name="user_password" placeholder="Mật khẩu"/>
							<input type="text" name="username" placeholder="Tên người dùng"/>
							<input type="text" name="address" placeholder="Địa chỉ"/>
							<button type="submit" name="register" class="btn btn-default">Đăng ký</button>
						</form>
					</div><!--/sign up form-->
				</div>
			</div>
		</div>

@endsection