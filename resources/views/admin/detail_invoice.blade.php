@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Chi tiết hóa đơn
    </div>   
  </div>
</div>
<br><br>

<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Thông tin người mua
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
            <th>Tên người mua</th>
            <th>Email</th>
            
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          
          <tr>
            <td>{{$detail_by_id[0]->username}}</td>
            <td>{{$detail_by_id[0]->email}}</td>

          </tr>

        </tbody>
      </table>
    </div>
  </div>
</div>
<br>

<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Thông tin vận chuyển
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
            <th>Tên người nhận</th>
            <th>Địa chỉ</th>
            <th>Ghi chú đơn hàng</th>
            
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          
          <tr>
            <td>{{$detail_by_id[0]->shipping_name}}</td>
            <td>{{$detail_by_id[0]->shipping_address}}</td>
            <td>{{$detail_by_id[0]->note}}</td>

          </tr>

        </tbody>
      </table>
    </div>
  </div>
</div>
<br>

<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Thông tin sản phẩm
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
            <th>Tên sản phẩm</th>
            <th>Giá</th>
            <th>Số lượng</th>
            <th>Thành tiền</th>
            
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
        <?php $i=0?>
        @foreach($detail_by_id as $content)
          <tr>
            <td>{{$detail_by_id[$i]->laptop_name}}</td>
            <td>{{$detail_by_id[$i]->price}}</td>
            <td>{{$detail_by_id[$i]->quantity}}</td>
            <td>{{$detail_by_id[$i]->price*$detail_by_id[$i]->quantity}}</td>
          </tr>
        <?php $i++ ?>
        @endforeach

        </tbody>
      </table>
    </div>
  </div>
</div>
<br>

<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Tình trạng đơn hàng
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

        <tbody>
          
          <tr>

            <div class="form-group">
            <form role="form" action="{{URL::to('/update-invoice/'.$detail_by_id[0]->invo_id)}}" method="post">
                {{ csrf_field() }}
                <select name="status" class="form-control input-sm m-bot15">
                  @if($detail_by_id[0]->invo_status=='Đang chờ xử lý')
                  <option selected value="Đang chờ xử lý">Đang chờ xử lý</option>
                  <option value="Đã xác nhận">Đã xác nhận</option>
                  <option value="Đang giao hàng">Đang chờ xử lý</option>
                  <option value="Hoàn thành">Hoàn thành</option>
                  <option value="Đã hủy">Đã hủy</option>
                  @elseif($detail_by_id[0]->invo_status=='Đã xác nhận')
                  <option value="Đang chờ xử lý">Đang chờ xử lý</option>
                  <option selected value="Đã xác nhận">Đã xác nhận</option>
                  <option value="Đang giao hàng">Đang giao hàng</option>
                  <option value="Hoàn thành">Hoàn thành</option>
                  <option value="Đã hủy">Đã hủy</option>
                  @elseif($detail_by_id[0]->invo_status=='Đang giao hàng')
                  <option value="Đang chờ xử lý">Đang chờ xử lý</option>
                  <option selected value="Đã xác nhận">Đã xác nhận</option>
                  <option value="Đang giao hàng">Đang giao hàng</option>
                  <option value="Hoàn thành">Hoàn thành</option>
                  <option value="Đã hủy">Đã hủy</option>
                  @elseif($detail_by_id[0]->invo_status=='Hoàn thành')
                  <option value="Đang chờ xử lý">Đang chờ xử lý</option>
                  <option selected value="Đã xác nhận">Đã xác nhận</option>
                  <option value="Đang giao hàng">Đang giao hàng</option>
                  <option value="Hoàn thành">Hoàn thành</option>
                  <option value="Đã hủy">Đã hủy</option>
                  @else
                  <option value="Đang chờ xử lý">Đang chờ xử lý</option>
                  <option value="Đã xác nhận">Đã xác nhận</option>
                  <option value="Đang giao hàng">Đang giao hàng</option>
                  <option value="Hoàn thành">Hoàn thành</option>
                  <option selected value="Đã hủy">Đã hủy</option>
                  @endif

                                            
                </select>
                <button type="submit" name="update_invoice" class="btn btn-info">Cập nhật tình trạng hóa đơn</button>
                </form>
            </div>
          </tr>

        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection