@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                           Cập nhật khuyến mãi
                        </header>
                         <?php
                            $message = Session::get('message');
                            if($message){
                                echo '<span class="text-alert">'.$message.'</span>';
                                Session::put('message',null);
                            }
                            ?>
                        <div class="panel-body">
                            @foreach($edit_promo as $key => $edit_value)
                            <div class="position-center">
                                <form role="form" action="{{URL::to('/update-promo/'.$edit_value->promo_id)}}" method="post">
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên khuyến mãi</label>
                                    <input type="text" value="{{$edit_value->promo_name}}" 
                                    data-validation="length" data-validation-length="min1" data-validation-error-msg="Không được để trống"
                                    name="promotion_name" class="form-control">
                                </div>
                                
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Nội dung khuyến mãi</label>
                                    <textarea style="resize: none" rows="8" class="form-control" name="promotion_info" id="exampleInputPassword1" >{{$edit_value->promo_info}}</textarea>
                                </div>

                                <div class="form-group">
                                        <label for="exampleInputEmail1">Giá trị khuyến mãi</label>
                                        <input type="text" value="{{$edit_value->promo_value}}" 
                                        data-validation="number" data-validation-allowing="range[1;90]" data-validation-error-msg="Phải là một số và có giá trị trong khoản 1 đến 90"
                                        name="promotion_value" class="form-control" placeholder="Giá trị khuyến mãi">
                                    </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Hiển thị</label>
                                      <select name="promotion_status" class="form-control input-sm m-bot15">
                                            <option value="0">Ẩn</option>
                                            <option value="1">Hiển thị</option>
                                            
                                    </select>
                                </div>
                                <button type="submit" name="update_promo" class="btn btn-info">Cập nhật khuyến mãi</button>
                                </form>
                            </div>
                            @endforeach 
                           
                        </div>
                    </section>

            </div>
@endsection