@extends('layout')
@section('content')
@foreach($laptop_details as $key => $value)
<div class="product-details"><!--product-details-->
						<div class="col-sm-5">
							<div class="view-product">
								<img src="{{URL::to('/public/uploads/laptop/'.$value->image)}}" alt="" />
							</div>

						</div>
						<div class="col-sm-7">
							<div class="product-information"><!--/product-information-->
								<img src="images/product-details/new.jpg" class="newarrival" alt="" />
								<h2>{{$value->laptop_name}}</h2>
								<p>Mã ID: {{$value->laptop_id}}</p>
								<img src="images/product-details/rating.png" alt="" />
								
								<form action="{{URL::to('/save-cart')}}" method="POST">
									{{ csrf_field() }}
									
								<span>
									<span>{{number_format($value->price,0,',','.').'VNĐ'}}</span>
								
									<label>Số lượng:</label>
									<input name="qty" type="number" min="1" class="cart_product_qty_{{$value->laptop_id}}"  value="1" />
									<input name="productid_hidden" type="hidden"  value="{{$value->laptop_id}}" />
									<button type="submit" class="btn btn-primary btn-sm add-to-cart"><i class=fa fa-shopping-cart></i>Thêm giỏ hàng</button>  
								</span>
								
								</form>

								<p><b>Tình trạng:</b> Còn hàng</p>
								<p><b>Điều kiện:</b> Mơi 100%</p>
								<p><b>Số lượng kho còn:</b> {{$value->quantity}}</p>
								<p><b>Thương hiệu:</b> {{$value->producer_name}}</p>
								<p><b>Danh mục:</b> {{$value->cate_name}}</p>
								<a href=""><img src="images/product-details/share.png" class="share img-responsive"  alt="" /></a>
							</div><!--/product-information-->
						</div>
</div><!--/product-details-->

<div class="category-tab shop-details-tab"><!--category-tab-->
	<div class="col-sm-12">
		<ul class="nav nav-tabs">
			<li class="active"><a href="#details" data-toggle="tab">Chi tiết sản phẩm</a></li>
		</ul>
	</div>
	<div class="tab-content">
		<div class="tab-pane fade active in" id="details" >
			<p>{!!$value->specification!!}</p>
			
		</div>
	</div>
</div><!--/category-tab-->

@endforeach
@endsection