@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                           Cập nhật sản phẩm
                        </header>
                         <?php
                            $message = Session::get('message');
                            if($message){
                                echo '<span class="text-alert">'.$message.'</span>';
                                Session::put('message',null);
                            }
                            ?>
                        <div class="panel-body">

                            <div class="position-center">
                                @foreach($edit_laptop as $key => $lap)
                                <form role="form" action="{{URL::to('/update-laptop/'.$lap->laptop_id)}}" method="post" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên laptop</label>
                                    <input type="text" name="laptop_name" 
                                    data-validation="length" data-validation-length="min1" data-validation-error-msg="Không được để trống"
                                    class="form-control" value="{{$lap->laptop_name}}"> 
                                </div>
                                 <div class="form-group">
                                    <label for="exampleInputEmail1">Số lượng</label>
                                    <input type="text"name="quantity" 
                                    data-validation="number" data-validation-allowing="range[1;100]" data-validation-error-msg="Phải là một số và không được nhỏ hơn 1"
                                    class="form-control" value="{{$lap->quantity}}">
                                </div>
                                
                                     <div class="form-group">
                                    <label for="exampleInputEmail1">Giá</label>
                                    <input type="text" name="price" 
                                    data-validation="number" data-validation-allowing="range[1000000;1000000000]" data-validation-error-msg="Phải là một số và không được nhỏ hơn 1 triệu"
                                    class="form-control" value="{{$lap->price}}">
                                </div>
                                  <div class="form-group">
                                    <label for="exampleInputEmail1">Hình ảnh laptop</label>
                                    <input type="file" name="image" class="form-control" value="{{URL::to('public/uploads/laptop/'.$lap->image)}}">
                                    <img src="{{URL::to('public/uploads/laptop/'.$lap->image)}}" height="100" width="100">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Thông số laptop</label>
                                    <textarea style="resize: none"  rows="8" 
                                    data-validation="length" data-validation-length="min1" data-validation-error-msg="Không được để trống"
                                    class="form-control" name="specification">{{$lap->specification}}</textarea>
                                </div>
                                
                                 <div class="form-group">
                                    <label for="exampleInputPassword1">Danh mục</label>
                                      <select name="cate_id" class="form-control input-sm m-bot15">
                                       @foreach($category as $key => $cate)
                                            @if($cate->cate_id==$lap->cate_id)
                                            <option selected value="{{$cate->cate_id}}">{{$cate->cate_name}}</option>
                                            @else
                                            <option value="{{$cate->cate_id}}">{{$cate->cate_name}}</option>
                                            @endif
                                        @endforeach
                                            
                                    </select>
                                </div>
                                 <div class="form-group">
                                    <label for="exampleInputPassword1">Thương hiệu</label>
                                      <select name="producer_id" class="form-control input-sm m-bot15">
                                        @foreach($producer as $key => $prod)
                                             @if($prod->producer_id==$lap->producer_id)
                                            <option selected value="{{$prod->producer_id}}">{{$prod->producer_name}}</option>
                                             @else
                                            <option value="{{$prod->producer_id}}">{{$prod->producer_name}}</option>
                                             @endif
                                        @endforeach
                                            
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Trạng thái</label>
                                      <select name="status" class="form-control input-sm m-bot15">
                                        <option value="0">Hiển thị</option>
                                        <option value="1">Ẩn</option>
                                            
                                    </select>
                                </div>
                               
                                <button type="submit" name="edit_laptop" class="btn btn-info">Cập nhật laptop</button>
                                </form>
                                 @endforeach
                            </div>

                        </div>
                    </section>

            </div>
@endsection