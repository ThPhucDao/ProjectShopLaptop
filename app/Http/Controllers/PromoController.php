<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class PromoController extends Controller
{
    public function add_promo(){

    	return view('admin.add_promo');
    }
    
    public function all_promo(){

    	$all_promo = DB::table('promotion')->paginate(5);
    	$manager_promotion  = view('admin.all_promo')->with('all_promo',$all_promo);
    	return view('admin_layout')->with('admin.all_promo', $manager_promotion);
    }

    public function save_promo(Request $request){

    	$data = array();

        $data['promo_id'] = $request->promotion_id;
    	$data['promo_name'] = $request->promotion_name;
        $data['promo_info'] = $request->promotion_info;
        $data['promo_value'] = $request->promotion_value;
        $data['promo_stat'] = $request->promotion_status;

        $isExist = DB::table('promotion')->where('promo_id',$request->promotion_id)->first();
        if($isExist){
            Session::put('message','Mã khuyến mãi bị trùng');
            return Redirect::to('/add-promo');
        }
        else{
            DB::table('promotion')->insert($data);
            Session::put('message','Thêm khuyến mãi thành công');
        }

    	return Redirect::to('add-promo');
    }

    public function unactive_promo($promo_id){
        DB::table('promotion')->where('promo_id',$promo_id)->update(['promo_stat'=>1]);
        Session::put('message','Ẩn khuyến mãi thành công');
        return Redirect::to('all-promo');
    }

    public function active_promo($promo_id){
        DB::table('promotion')->where('promo_id',$promo_id)->update(['promo_stat'=>0]);
        Session::put('message','Hiện khuyến mãi thành công');
        return Redirect::to('all-promo');
    }

    public function edit_promo($promo_id){
        $edit_promo = DB::table('promotion')->where('promo_id',$promo_id)->get();
        $manager_promo  = view('admin.edit_promo')->with('edit_promo',$edit_promo);

        return view('admin_layout')->with('admin.edit_promo', $manager_promo);
    }

    public function update_promo(Request $request,$promo_id){
        $data = array();

        $data['promo_name'] = $request->promotion_name;
        $data['promo_info'] = $request->promotion_info;
        $data['promo_value'] = $request->promotion_value;
        $data['promo_stat'] = $request->promotion_status;

        DB::table('promotion')->where('promo_id',$promo_id)->update($data);
        Session::put('message','Cập nhật khuyến mãi thành công');
        return Redirect::to('all-promo');
    }
    
    //End of Admin page
}
