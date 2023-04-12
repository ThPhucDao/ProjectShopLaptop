<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class AccountController extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('email');
        $admin_role = Session::get('role');
        if($admin_id){
            return Redirect::to('dashboard');
        }else if($admin_role!=0){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }

    public function add_account(){
        $this->AuthLogin();
    	return view('admin.add_account');
    }
    
    public function all_account(){
        $this->AuthLogin();
    	$all_account = DB::table('account')->paginate(10);
    	$manager_account  = view('admin.all_account')->with('all_account',$all_account);
    	return view('admin_layout')->with('admin.all_account', $manager_account);
    }

    public function save_acount(Request $request){
        $this->AuthLogin();
    	$data = array();

        $data['email'] = $request->email_account;
    	$data['username'] = $request->username;
        $data['password'] = md5($request->pass);
        $data['role'] = $request->role_account;
        $data['status'] = $request->status;

        $isExist = DB::table('account')->where('account.email',$request->email_account)->first();
        if($isExist){
            Session::put('message','Email này đã được dùng đăng ký');
            return Redirect::to('/all-account');
        }
        else{
            DB::table('account')->insert($data);
            Session::put('message','Tạo mới khoản thành công');
        }

    	DB::table('account')->insert($data);
    	Session::put('message','Tạo mới khoản thành công');
    	return Redirect::to('all-account');
    }

    public function unactive_account($email_account){
        $this->AuthLogin();
        DB::table('account')->where('email',$email_account)->update(['account_stat'=>1]);
        Session::put('message','Vô hiệu tài khoản thành công');
        return Redirect::to('all-account');
    }

    public function active_account($email_account){
        $this->AuthLogin();
        DB::table('account')->where('email',$email_account)->update(['account_stat'=>0]);
        Session::put('message','Kích hoạt lại tài khoản thành công');
        return Redirect::to('all-account');
    }

    public function edit_account($email_account){
        $this->AuthLogin();
        $edit_account = DB::table('account')->where('email',$email_account)->get();
        $manager_account  = view('admin.edit_account')->with('edit_account',$edit_account);

        return view('admin_layout')->with('admin.edit_account', $manager_account);
    }

    public function update_account(Request $request,$email_account){
        $this->AuthLogin();
        $data = array();

        $data['username'] = $request->username;
        $data['password'] = $request->pass;
        $data['role'] = $request->role_account;
        $data['status'] = $request->status;

        DB::table('account')->where('email',$email_account)->update($data);
        Session::put('message','Cập nhật tài khoản thành công');
        return Redirect::to('all-account');
    }

    public function delete_account($email_account){
        $this->AuthLogin();
        DB::table('account')->where('email',$email_account)->delete();
        Session::put('message','Xóa tài khoản thành công');
        return Redirect::to('all-account');
    }
    
    //End of Admin page
}
