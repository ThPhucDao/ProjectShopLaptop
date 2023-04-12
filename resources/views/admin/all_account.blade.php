@extends('admin_layout')
@section('admin_content')
    <div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Danh sách tài khoản
    </div>
    
    <div class="table-responsive">
                      <?php
                            $message = Session::get('message');
                            if($message){
                                echo '<span class="text-alert">'.$message.'</span>';
                                Session::put('message',null);
                            }
                            ?>
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th style="width:20px;">
              <label class="i-checks m-b-none">
                <input type="checkbox"><i></i>
              </label>
            </th>
            <th>Email</th>
            <th>Tên tài khoản</th>
            <th>Địa chỉ</th>
            <th>Vai trò</th>
            <th>Trạng thái</th>
            
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($all_account as $key => $account)
          <tr>
            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
            <td>{{ $account->email }}</td>
            <td>{{ $account->username }}</td>
            <td>{{ $account->address }}</td>
            <td>
              <?php
              if($account->role==0){
                ?>Mod<?php
              }else if($account->role==1){
                ?>Nhân viên<?php
              }else{
                ?>Khách hàng<?php
              }
            ?></td>

            <td><span class="text-ellipsis">
                <?php
                if($account->status==0){
                ?>
                <a href="{{URL::to('/unactive-account/'.$account->email)}}"><span class="fa-thumb-styling fa fa-thumbs-up"></span></a>
                <?php
                 }else{
                ?>  
                 <a href="{{URL::to('/active-account/'.$account->email)}}"><span class="fa-thumb-styling fa fa-thumbs-down"></span></a>
                <?php
               }
                ?>
            </span></td>
           
            <td>
              <a href="{{URL::to('/edit-account/'.$account->email)}}" class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-pencil-square-o text-success text-active"></i></a>
              <a onclick="return confirm('Bạn có chắc là muốn xóa tài khoản này không?')" href="{{URL::to('/delete-account/'.$account->email)}}" class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-times text-danger text"></i>
              </a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <footer class="panel-footer">
      <div class="row">
        
        <div class="col-sm-5 text-center">
          <small class="text-muted inline m-t-sm m-b-sm">showing 2-3 of ?? items</small>
        </div>
        <div class="col-sm-7 text-right text-center-xs">                
          <ul class="pagination pagination-sm m-t-none m-b-none">
             {!!$all_account->links()!!}
          </ul>
        </div>
      </div>
    </footer>
  </div>
</div>
@endsection