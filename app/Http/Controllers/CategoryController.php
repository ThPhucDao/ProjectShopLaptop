<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class CategoryController extends Controller
{
   
    public function add_category(){

    	return view('admin.add_category');
    }
    
    public function all_category(){

    	$all_category = DB::table('category')->paginate(10);
    	$manager_category  = view('admin.all_category')->with('all_category',$all_category);
    	return view('admin_layout')->with('admin.all_category', $manager_category);
    }

    public function save_category(Request $request){

    	$data = array();

        $data['cate_id'] = $request->category_id;
    	$data['cate_name'] = $request->category_name;
        $isExist = DB::table('category')->where('cate_id',$request->category_id)->first();
        if($isExist){
            Session::put('message','Mã danh mục bị trùng');
            return Redirect::to('/add-category');
        }
        else{
            DB::table('category')->insert($data);
            Session::put('message','Thêm danh mục sản phẩm thành công');
        }

    	return Redirect::to('all-category');
    }

    public function edit_category($category_id){

        $edit_category = DB::table('category')->where('cate_id',$category_id)->get();

        $manager_category  = view('admin.edit_category')->with('edit_category',$edit_category);

        return view('admin_layout')->with('admin.edit_category', $manager_category);
    }

    public function update_category(Request $request,$category_id){

        $data = array();
        $data['cate_name'] = $request->category_name;
        DB::table('category')->where('cate_id',$category_id)->update($data);
        Session::put('message','Cập nhật danh mục sản phẩm thành công');
        return Redirect::to('all-category');
    }
    public function delete_category($category_id){
        $isExist = DB::table('laptop')->where('laptop.cate_id',$category_id)->first();
        if($isExist){
            Session::put('message','Đã tồn tại 1 sản phẩm thuộc danh mục này không thể xóa');
            return Redirect::to('/all-category');
        }
        else{
            DB::table('category')->where('cate_id',$category_id)->delete();
            Session::put('message','Xóa danh mục sản phẩm thành công');
        }

        return Redirect::to('all-category');
    }
    //End of Admin page

    public function show_category_home($category_id){
        $category = DB::table('category')->orderby('cate_id','desc')->get();    
        $producer = DB::table('producer')->orderby('producer_id','desc')->get(); 
               
        $category_by_id = DB::table('laptop')->join('category','laptop.cate_id','=','category.cate_id')->where('category.cate_id',$category_id)->paginate(6);    
        $category_name = DB::table('category')->where('cate_id',$category_id)->limit(1)->get();
                
        return view('pages.category.show_category')->with('category',$category)->with('producer',$producer)->with('category_by_id',$category_by_id)->with('cate_name',$category_name);
    }
}
