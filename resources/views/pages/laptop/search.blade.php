@extends('layout')
@section('content')
<div class="features_items"><!--features_items-->
						<h2 class="title text-center">Kết quả tìm kiếm</h2>
						    @foreach($search_product as $key => $laptop)
						<a href="{{URL::to('/chi-tiet/'.$laptop->laptop_id)}}">
						<div class="col-sm-4">
							<div class="product-image-wrapper">
								<div class="single-products">
										<div class="productinfo text-center">
											<img src="{{URL::to('public/uploads/laptop/'.$laptop->image)}}" alt="" />
											<h2>{{number_format($laptop->price).'VNĐ'}}</h2>
											<p>{{$laptop->laptop_name}}</p>
											<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</a>
										</div>
										
								</div>
								
							</div>
						</div>
						</a>
						@endforeach
						
					</div>


@endsection