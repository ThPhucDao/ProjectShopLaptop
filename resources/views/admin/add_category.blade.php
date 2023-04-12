@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                           Thêm danh mục sản phẩm
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
                                <form role="form" action="{{URL::to('/save-category')}}" method="post">
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Mã danh mục</label>
                                    <input type="text" class="form-control" 
                                    data-validation="length" data-validation-length="min1" data-validation-error-msg="Không được để trống"
                                    name="category_id" placeholder="mã danh mục">
                                </div>
                                
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên danh mục</label>
                                    <input type="text" class="form-control" 
                                    data-validation="length" data-validation-length="min1" data-validation-error-msg="Không được để trống"
                                    name="category_name" placeholder="danh mục" >
                                </div>

                               
                                <button type="submit" name="add_category" class="btn btn-info">Thêm danh mục</button>
                                </form>
                            </div>

                        </div>
                    </section>

            </div>
@endsection