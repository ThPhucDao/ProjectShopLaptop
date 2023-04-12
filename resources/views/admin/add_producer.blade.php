@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                           Thêm thương hiệu
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
                                <form role="form" action="{{URL::to('/save-producer')}}" method="post">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Mã thương hiệu</label>
                                        <input type="text" name="producer_id" 
                                        data-validation="length" data-validation-length="min1" data-validation-error-msg="Không được để trống"
                                        class="form-control" placeholder="mã hãng sản xuất">
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Tên thương hiệu</label>
                                        <input type="text" name="producer_name" 
                                        data-validation="length" data-validation-length="min1" data-validation-error-msg="Không được để trống"
                                        class="form-control" placeholder="tên hãng sản xuất">
                                    </div>
                               
                                <button type="submit" name="add_add_producer" class="btn btn-info">Thêm thương hiệu</button>
                                </form>
                            </div>

                        </div>
                    </section>

            </div>
@endsection