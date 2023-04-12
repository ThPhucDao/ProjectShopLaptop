<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use Cart;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class CheckoutController extends Controller
{
    public function login_checkout(){

        $category = DB::table('category')->orderby('cate_id','desc')->get(); 
        $producer = DB::table('producer')->orderby('producer_id','desc')->get(); 

        return view('user_login')->with('category',$category)->with('producer',$producer);
    }

    public function register(Request $request){

    	$data = array();

        $data['email'] = $request->user_email;
    	$data['username'] = $request->username;
        $data['password'] = md5($request->user_password);
        $data['address'] = $request->address;
        $data['role'] = 2;
        $data['status'] = 0;

    	DB::table('account')->insert($data);
    	Session::put('email',$request->user_email);
        Session::put('username',$request->username);
    	return Redirect::to('/checkout');
    }

    public function checkout(){
        $category = DB::table('category')->orderby('cate_id','desc')->get(); 
        $producer = DB::table('producer')->orderby('producer_id','desc')->get(); 

        return view('pages.checkout.show_checkout')->with('category',$category)->with('producer',$producer);
    }

    public function save_checkout(Request $request){
        $data = array();

        $data['email'] = $request->email;
    	$data['shipping_name'] = $request->username;

        $data['shipping_address'] = $request->address;
        $data['note'] = $request->note;

    	$shipping_id = DB::table('shipping')->insertGetId($data);
    	Session::put('shipping_id',$shipping_id);

    	return Redirect::to('/payment');
    }

    public function payment(){
        $category = DB::table('category')->orderby('cate_id','desc')->get(); 
        $producer = DB::table('producer')->orderby('producer_id','desc')->get(); 

        return view('pages.checkout.payment')->with('category',$category)->with('producer',$producer);
    }

    public function order_invoice(Request $request){
        $data = array();

        //insert payment
        $data['payment_type'] = $request->payment_type;
    	$data['payment_status'] = "Chưa thanh toán";
        $payment_id = DB::table('payment')->insertGetId($data);

        //insert invoice
        $invoice = array(); 
        $invoice['email'] = Session::get('email');
        $invoice['shipping_id'] = Session::get('shipping_id');
        $invoice['payment_id'] = $payment_id;
        $invoice['total_pay'] = Cart::total();
        $invoice['invo_status'] = 'Đang chờ xử lý';

    	$invoice_id = DB::table('invoice')->insertGetId($invoice);

        //insert invoice detail
        $content = Cart::content();
        foreach($content as $v_content){
            $invoice_d_data['invo_id']=  $invoice_id;
            $invoice_d_data['laptop_id']=  $v_content->id;
            $invoice_d_data['laptop_name']=  $v_content->name;
            $invoice_d_data['price']=  $v_content->price;
            $invoice_d_data['quantity']=  $v_content->qty;
            DB::table('invoice_detail')->insert($invoice_d_data);
        }
        if($data['payment_type']==1)
            echo 'Ví điện tử';
        else
            $category = DB::table('category')->orderby('cate_id','desc')->get(); 
            $producer = DB::table('producer')->orderby('producer_id','desc')->get();

            return view('/pages.checkout.handcash')->with('category',$category)->with('producer',$producer);

    	return Redirect::to('/payment');
    }

    public function logout_checkout(){
        Session::flush();
        return Redirect::to('/login-checkout');
    }

    public function login(Request $request){
        $user_email = $request->user_email;
    	$user_password = md5($request->user_password);

    	$result = DB::table('account')->where('email',$user_email)->where('password',$user_password)->first();
    	if($result){
                Session::put('email',$result->email);
                return Redirect::to('/trang-chu');
        }else{
                Session::put('message','Mật khẩu hoặc tài khoản bị sai. Hãy nhập lại');
                return Redirect::to('/login-checkout');
        }
    }

    public function all_invoice(){
    
        $all_invoice = DB::table('invoice')
        ->join('account','account.email','=','invoice.email')
        ->select('invoice.*','account.username')->where('invo_status','Đang chờ xử lý')
        ->orderby('invoice.invo_id','desc')->paginate(10);
        $manage_invoice  = view('admin.all_invoice')->with('all_invoice',$all_invoice);
        return view('admin_layout')->with('admin.all_invoice', $manage_invoice);
    }

    public function detail_invoice($invoice_id){
        $detail_by_id = DB::table('invoice')
        ->join('account','account.email','=','invoice.email')
        ->join('shipping','shipping.shipping_id','=','invoice.shipping_id')
        ->join('invoice_detail','invoice_detail.invo_id','=','invoice.invo_id')
        ->select('invoice.*', 'account.*', 'shipping.*', 'invoice_detail.*')->where('invoice_detail.invo_id',$invoice_id)
        ->get();

        $manage_detail_by_id  = view('admin.detail_invoice')->with('detail_by_id',$detail_by_id);
        return view('admin_layout')->with('admin.detail_invoice', $manage_detail_by_id);
    }

    public function update_invoice(Request $request,$invoice_id){

        $data = array();

        $data['invo_status'] = $request->status;

        DB::table('invoice')->where('invo_id',$invoice_id)->update($data);
        Session::put('message','Cập nhật hóa đơn thành công');
        return Redirect::to('all-invoice');
    }
}
