<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class LaptopController extends Controller
{

    public function add_laptop(){

        $category = DB::table('category')->orderby('cate_id','desc')->get(); 
        $producer = DB::table('producer')->orderby('producer_id','desc')->get(); 
       
        return view('admin.add_laptop')->with('category', $category)->with('producer',$producer);
    }
    
    public function all_laptop(){

        $all_laptop = DB::table('laptop')
        ->join('category','category.cate_id','=','laptop.cate_id')
        ->join('producer','producer.producer_id','=','laptop.producer_id')
        ->orderby('laptop.laptop_id','desc')->paginate(5);
    	$manager_laptop  = view('admin.all_laptop')->with('all_laptop',$all_laptop);
    	return view('admin_layout')->with('admin.all_laptop', $manager_laptop);
    }

    public function save_laptop(Request $request){

    	$data = array();
        $data['laptop_id'] = $request->laptop_id;
    	$data['laptop_name'] = $request->laptop_name;
        $data['price'] = $request->price;
        $data['quantity'] = $request->quantity;
        $data['image'] = $request->image;
        $data['specification'] = $request->specification;
        $data['cate_id'] = $request->cate_id;
        $data['producer_id'] = $request->producer_id;
        $data['status'] = $request->status;
        $get_image = $request->file('image');
      
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/laptop',$new_image);
            $data['image'] = $new_image;
            DB::table('laptop')->insert($data);
            Session::put('message','Thêm laptop mới thành công');
            return Redirect::to('add-laptop');
        }
        $data['image'] = '';

        $isExist = DB::table('laptop')->where('laptop_id',$request->laptop_id)->first();
        if($isExist){
            Session::put('message','Mã laptop bị trùng');
            return Redirect::to('/add-laptop');
        }
        else{
            DB::table('laptop')->insert($data);
            Session::put('message','Thêm laptop mới thành công');
        }

    	return Redirect::to('add-laptop');
    }

    public function unactive_laptop($email_account){

        DB::table('laptop')->where('laptop_id',$laptop_id)->update(['status'=>1]);
        Session::put('message','Ân laptop thành công');
        return Redirect::to('all-laptop');
    }

    public function active_laptop($email_account){

        DB::table('laptop')->where('laptop_id',$laptop_id)->update(['account_stat'=>0]);
        Session::put('message','Kích hoạt lại tài khoản thành công');
        return Redirect::to('all-laptop');
    }

    public function edit_laptop($laptop_id){

        $category = DB::table('category')->orderby('cate_id','desc')->get(); 
        $producer = DB::table('producer')->orderby('producer_id','desc')->get(); 

        $edit_laptop = DB::table('laptop')->where('laptop_id',$laptop_id)->get();
        $manager_laptop  = view('admin.edit_laptop')->with('edit_laptop',$edit_laptop)->with('category',$category)->with('producer',$producer);

        return view('admin_layout')->with('admin.edit_laptop', $manager_laptop);
    }

    public function update_laptop(Request $request,$laptop_id){

        $data = array();

    	$data['laptop_name'] = $request->laptop_name;
        $data['price'] = $request->price;
        $data['quantity'] = $request->quantity;
        $data['image'] = $request->image;
        $data['specification'] = $request->specification;
        $data['cate_id'] = $request->cate_id;
        $data['producer_id'] = $request->producer_id;
        $data['status'] = $request->status;
        $get_image = $request->file('image');

        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/laptop',$new_image);
            $data['image'] = $new_image;
            DB::table('laptop')->where('laptop_id',$laptop_id)->update($data);
            Session::put('message','Cập nhật thông tin laptop thành công');
            return Redirect::to('all-laptop');
        }
        DB::table('laptop')->where('laptop_id',$laptop_id)->update($data);
        Session::put('message','Cập nhật thông tin laptop thành công');
        return Redirect::to('all-laptop');           
    }
    
    public function delete_laptop($laptop_id){
        DB::table('laptop')->where('laptop_id',$laptop_id)->delete();
        Session::put('message','Xóa laptop thành công');
        return Redirect::to('all-laptop');
    }
    //End of Admin page
    
    //Start of front page
    public function details_laptop($laptop_id , Request $request){
        $category = DB::table('category')->orderby('cate_id','desc')->get(); 
        $producer = DB::table('producer')->orderby('producer_id','desc')->get(); 

        $details_laptop = DB::table('laptop')
        ->join('category','category.cate_id','=','laptop.cate_id')
        ->join('producer','producer.producer_id','=','laptop.producer_id')
        ->where('laptop.laptop_id',$laptop_id)->get();

        foreach($details_laptop as $key => $value){
            $category_id = $value->cate_id;         
            }
        return view('pages.laptop.show_details')->with('category',$category)->with('producer',$producer)->with('laptop_details',$details_laptop);

    }

    //End of front page
}
