@extends('layout')
@section('content')

<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				<li><a href="{{URL::to('/')}}">Trang chủ</a></li>
				  <li class="active">Thanh toán</li>
				</ol>
			</div><!--/breadcrums-->

			<div class="shopper-informations">
				<div class="row">
					
					<div class="col-sm-12 clearfix">
						<div class="bill-to">
							<p>Điền thông tin đơn hàng</p>
							<div class="form-one">
								<form action="{{URL::to('/save-checkout')}}" method="post">
									{{csrf_field()}}
									<input type="text" name="email" 
									data-validation="email" data-validation-error-msg="Phải là một email, không được để trống" 
									placeholder="Email *">

									<input type="text" name="username" 
									data-validation="length" data-validation-length="min1" data-validation-error-msg="Tên người nhận không được để trống"
									placeholder="Họ tên người nhận *">

									<input type="text" name="address" 
									data-validation="length" data-validation-length="min1" data-validation-error-msg="Địa chỉ không được để trống"
									placeholder="Địa chỉ *">

									<textarea name="note"  placeholder="Ghi chú thông tin đơn hàng cho người vận chuyển" rows="16"></textarea>

									<input type="submit" value="Xác nhận" name="send_order" class="btn btn-primary btn-sm">
								</form>
							</div>
							
						</div>
					</div>				
				</div>
			</div>

		</div>
	</section> <!--/#cart_items-->

@endsection