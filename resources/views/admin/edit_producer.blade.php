@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                           Cập nhật thương hiệu
                        </header>
                        <?php
                            $message = Session::get('message');
                            if($message){
                                echo '<span class="text-alert">'.$message.'</span>';
                                Session::put('message',null);
                            }
                        ?>

                        <div class="panel-body">
                            @foreach($edit_producer as $key => $edit_value)
                            <div class="position-center">
                                <form role="form" action="{{URL::to('/update-producer/'.$edit_value->producer_id)}}" method="post">
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên thương hiệu</label>
                                    <input type="text" value="{{$edit_value->producer_name}}" 
                                    data-validation="length" data-validation-length="min1" data-validation-error-msg="Không được để trống"
                                    name="producer_name" class="form-control">
                                </div>
                                
                                <button type="submit" name="update_producer" class="btn btn-info">Cập nhật thương hiệu</button>
                                </form>
                            </div>
                            @endforeach 
                           
                        </div>
                    </section>

            </div>
@endsection