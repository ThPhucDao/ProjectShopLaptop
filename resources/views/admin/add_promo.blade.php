@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                           Thêm khuyến mãi
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
                                <form role="form" action="{{URL::to('/save-promo')}}" method="post">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Mã khuyến mãi</label>
                                        <input type="text" name="promotion_id" 
                                        data-validation="length" data-validation-length="min1" data-validation-error-msg="Không được để trống"
                                        class="form-control" placeholder="Mã khuyến mãi">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Tên khuyến mãi</label>
                                        <input type="text" name="promotion_name" 
                                        data-validation="length" data-validation-length="min1" data-validation-error-msg="Không được để trống"
                                        class="form-control" placeholder="Tên khuyến mãi">
                                    </div>
                                
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Nội dung khuyến mãi</label>
                                        <textarea style="resize: none" rows="8" class="form-control" name="promotion_info" placeholder="Mô tả khuyến mãi"></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Giá trị khuyến mãi</label>
                                        <input type="text" name="promotion_value" 
                                        data-validation="number" data-validation-allowing="range[1;90]" data-validation-error-msg="Phải là một số và có giá trị trong khoản 1 đến 90"
                                        class="form-control" placeholder="Giá trị khuyến mãi">
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Trạng thái</label>
                                        <select name="promotion_status" class="form-control input-sm m-bot15">
                                                <option value="0">Hiển thị</option>
                                                <option value="1">Ẩn</option>
                                            
                                        </select>
                                    </div>
                               
                                <button type="submit" name="add_promo" class="btn btn-info">Thêm khuyến mãi</button>
                                </form>
                            </div>

                        </div>
                    </section>

            </div>
@endsection