@extends('admin_layout')
@section('admin_content')
    <div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Danh sách hóa đơn
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
            <th>Mã hóa đơn</th>
            <th>Tên người đặt</th>
            <th>Tổng cộng</th>
            <th>Trạng thái</th>
            <th>Ngày lập đơn</th>
            
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($all_invoice as $key => $invoice)
          <tr>
            <td>{{ $invoice->invo_id }}</td>
            <td>{{ $invoice->username }}</td>
            <td>{{ $invoice->total_pay }}</td>
            <td>{{ $invoice->invo_status }}</td>
            <td>{{ $invoice->date_create }}</td>

            <td>
              <a href="{{URL::to('/detail-invoice/'.$invoice->invo_id)}}" class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-pencil-square-o text-success text-active"></i></a>
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
             {!!$all_invoice->links()!!}
          </ul>
        </div>
      </div>
    </footer>
  </div>
</div>
@endsection