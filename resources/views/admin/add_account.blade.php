@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                           Tạo tài khoản mới
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
                                <form role="form" action="{{URL::to('/save-account')}}" method="post">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Email</label>
                                        <input type="email" name="email_account" 
                                        data-validation="email" data-validation-error-msg="Phải là một email"
                                        class="form-control" placeholder="Email">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Tên người dùng</label>
                                        <input type="text" name="username" 
                                        data-validation="length" data-validation-length="min1" data-validation-error-msg="Không được để trống"
                                        class="form-control" placeholder="Tên người dùng">
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Mật khẩu</label>
                                        <input type="password" name="pass" 
                                        data-validation="length" data-validation-length="min1" data-validation-error-msg="Không được để trống"
                                        class="form-control" placeholder="">
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Địa chỉ</label>
                                        <input type="text" name="address" 
                                        data-validation="length" data-validation-length="min1" data-validation-error-msg="Không được để trống"
                                        class="form-control" placeholder="Địa chỉ">
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Vai trò</label>
                                        <select name="role_account" class="form-control input-sm m-bot15">
                                                <option value="0">Mod</option>
                                                <option value="1">Nhân viên</option>
                                                <option value="2">Khách hàng</option>
                                            
                                        </select>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Trạng thái</label>
                                        <select name="status" class="form-control input-sm m-bot15">
                                                <option value="0">Kích hoạt</option>
                                                <option value="1">Vô hiệu hóa</option>
                                            
                                        </select>
                                    </div>
                               
                                <button type="submit" name="add_account" class="btn btn-info">Tạo tài khoản</button>
                                </form>
                            </div>

                        </div>
                    </section>

            </div>
@endsection