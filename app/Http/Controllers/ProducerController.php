<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class ProducerController extends Controller
{
    public function add_producer(){
    	return view('admin.add_producer');
    }
    public function all_producer(){
        
        $all_producer = DB::table('producer')->paginate(10);
    	$manager_producer  = view('admin.all_producer')->with('all_producer',$all_producer);
    	return view('admin_layout')->with('admin.all_producer', $manager_producer);


    }
    public function save_producer(Request $request){
               
    	$data = array();
        $data['producer_id'] = $request->producer_id;
    	$data['producer_name'] = $request->producer_name;

        $isExist = DB::table('producer')->where('producer_id',$request->producer_id)->first();
        if($isExist){
            Session::put('message','Mã thương hiệu bị trùng');
            return Redirect::to('/add-producer');
        }
        else{
            DB::table('producer')->insert($data);
            Session::put('message','Thêm hãng sản xuất thành công');
        }

    	return Redirect::to('add-producer');
    }

    public function edit_producer($producer_id){

        $edit_producer = DB::table('producer')->where('producer_id',$producer_id)->get();
        $manager_producer  = view('admin.edit_producer')->with('edit_producer',$edit_producer);

        return view('admin_layout')->with('admin.edit_producer', $manager_producer);
    }
    public function update_producer(Request $request,$producer_id){

        $data = array();
        $data['producer_name'] = $request->producer_name;

        DB::table('producer')->where('producer_id',$producer_id)->update($data);
        Session::put('message','Cập nhật thương hiệu sản phẩm thành công');
        return Redirect::to('all-producer');
    }
    public function delete_producer($producer_id){
        $isExist = DB::table('laptop')->where('laptop.producer_id',$producer_id)->first();
        if($isExist){
            Session::put('message','Đã tồn tại 1 sản phẩm thuộc thương hiệu này không thể xóa');
            return Redirect::to('/all-producer');
        }
        else{
            DB::table('producer')->where('producer_id',$producer_id)->delete();
            Session::put('message','Xóa thương hiệu sản phẩm thành công');
        }
        return Redirect::to('all-producer');
    }
    //End of Admin page

    //Start of Home page
    public function show_producer_home($producer_id){
        $category = DB::table('category')->orderby('cate_id','desc')->get(); 
        $producer = DB::table('producer')->orderby('producer_id','desc')->get(); 
               
        $producer_by_id = DB::table('laptop')->join('producer','laptop.producer_id','=','producer.producer_id')->where('producer.producer_id',$producer_id)->paginate(6);

        $producer_name = DB::table('producer')->where('producer.producer_id',$producer_id)->limit(1)->get();
         
        return view('pages.producer.show_producer')->with('category',$category)->with('producer',$producer)->with('producer_by_id',$producer_by_id)->with('producer_name', $producer_name);
    }

    //End of Home page
}
