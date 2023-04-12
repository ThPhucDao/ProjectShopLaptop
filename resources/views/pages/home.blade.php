@extends('layout')
@section('content')
<div class="features_items"><!--features_items-->
	<h2 class="title text-center">Sản phẩm hiện có</h2>
	@foreach($all_laptop as $key => $laptop)
	<a href="{{URL::to('/chi-tiet/'.$laptop->laptop_id)}}">
	<div class="col-sm-4">
		<div class="product-image-wrapper">
			<div class="single-products">
				<div class="productinfo text-center">
					<img src="{{URL::to('public/uploads/laptop/'.$laptop->image)}}" alt="" />
					<h2>{{number_format($laptop->price).'VNĐ'}}</h2>
					<p>{{$laptop->laptop_name}}</p>
					<a href="{{URL::to('/chi-tiet/'.$laptop->laptop_id)}}" class="btn btn-default add-to-cart"></i>Chi tiết sản phẩm</a>
				</div>						
			</div>				
		</div>
	</div>
	</a>
	@endforeach
						
</div><!--features_items-->

@endsection