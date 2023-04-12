@extends('admin_layout')
@section('admin_content')
<h3><center>Chào mừng bạn đến với Admin</center></h3>

<p><b>Thống kê</b></p>
<p>Số lượng sản phẩm hiện có: {{$lap_num}}</p>
<p>Số lượng tài khoản khách hàng hiện có: {{$count_user}}</p>
<p>Số lượng đơn hàng hiện tại: {{$count_invoice}}</p>


@endsection