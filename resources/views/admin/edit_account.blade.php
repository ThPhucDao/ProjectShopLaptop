@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                           Sửa thông tin tài khoản
                        </header>
                         <?php
                            $message = Session::get('message');
                            if($message){
                                echo '<span class="text-alert">'.$message.'</span>';
                                Session::put('message',null);
                            }
                            ?>
                        <div class="panel-body">
                            @foreach($edit_account as $key => $edit_value)
                            <div class="position-center">
                                <form role="form" action="{{URL::to('/update-account/'.$edit_value->email)}}" method="post">
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên người dùng</label>
                                    <input type="text" value="{{$edit_value->username}}" 
                                    data-validation="length" data-validation-length="min1" data-validation-error-msg="Không được để trống"
                                    name="username" class="form-control">
                                </div>
                                
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mật khẩu</label>
                                    <input type="password" value="{{$edit_value->password}}" 
                                    data-validation="length" data-validation-length="min1" data-validation-error-msg="Không được để trống"
                                    name="pass" class="form-control" placeholder="">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Địa chỉ</label>
                                    <input type="text" value="{{$edit_value->address}}" 
                                    data-validation="length" data-validation-length="min1" data-validation-error-msg="Không được để trống"
                                    name="address" class="form-control">
                                </div>

                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Vai trò</label>
                                        <select name="role_account" class="form-control input-sm m-bot15">
                                            <?php if($edit_value->role==0){ ?>
                                                <option value="0" selected>Mod</option>
                                                <option value="1">Nhân viên</option>
                                                <option value="2" >Khách hàng</option>
                                                
                                                <?php
                                            } else if($edit_value->role==1){ ?>
                                                <option value="0">Mod</option>
                                                <option value="1" selected>Nhân viên</option>
                                                <option value="2">Khách hàng</option>
                                                <?php
                                            } else{ ?>
                                                <option value="0">Mod</option>
                                                <option value="1">Nhân viên</option>
                                                <option value="2" selected>Khách hàng</option>
                                                <?php
                                            } ?>
                                            
                                        </select>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Trạng thái</label>
                                        <select name="status" class="form-control input-sm m-bot15">
                                        <?php if($edit_value->status==0){ ?>
                                                <option value="0" selected>Kích hoạt</option>
                                                <option value="1">Vô hiệu hóa</option>
                                                
                                            <?php
                                            } else{ ?>
                                                <option value="0">Kích hoạt</option>
                                                <option value="1" selected>Vô hiệu hóa</option>
                                                <?php
                                            } ?>   
                                            
                                        </select>
                                    </div>
                                <button type="submit" name="update_account" class="btn btn-info">Cập nhật tài khoản</button>
                                </form>
                            </div>
                            @endforeach 
                           
                        </div>
                    </section>

            </div>
@endsection