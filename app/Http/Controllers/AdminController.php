<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
session_start();

class AdminController extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('email');
        $admin_role = Session::get('role');
        if($admin_id){
            return Redirect::to('dashboard');
        }else if($admin_role==2){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }

    public function index()
    {
        return view('admin_login');
    }

    public function show_dashboard(){
        $this->AuthLogin();
        $laptop_num = DB::table('laptop')->get();
        $lap_num = count($laptop_num);

        $user_account = DB::table('account')->where('role','2')->get();
        $count_user = count($user_account);

        $invoice_this_month = DB::table('invoice')->whereBetween('date_create',[Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->get();
        $count_invoice = count($invoice_this_month);

    	return view('admin.dashboard')->with('lap_num',$lap_num)->with('count_user',$count_user)->with('count_invoice',$count_invoice);
    }

    public function dashboard(Request $request){
    	$admin_email = $request->admin_email;
    	$admin_password = md5($request->admin_password);

    	$result = DB::table('account')->where('email',$admin_email)->where('password',$admin_password)->first();
    	if($result){
                Session::put('username',$result->username);
                Session::put('email',$result->email);
                return Redirect::to('/dashboard');
        }else{
                Session::put('message','Mật khẩu hoặc tài khoản bị sai. Hãy nhập lại');
                return Redirect::to('/admin');
        }
    }

    public function logout(){
        $this->AuthLogin();
        Session::put('username',null);
        Session::put('email',null);
        return Redirect::to('/admin');
    }
}
