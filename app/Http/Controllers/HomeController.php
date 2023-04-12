<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(){
    	$category = DB::table('category')->orderby('cate_id','desc')->get(); 
        $producer = DB::table('producer')->orderby('producer_id','desc')->get(); 

		$all_laptop = DB::table('laptop')->where('status','0')->orderby('laptop_id','desc')->limit(6)->get();

    	return view('pages.home')->with('category',$category)->with('producer',$producer)->with('all_laptop',$all_laptop);
    }

    public function search(Request $request){
        $keyword = $request->keyword_submit;

        $category = DB::table('category')->orderby('cate_id','desc')->get(); 
        $producer = DB::table('producer')->orderby('producer_id','desc')->get(); 

        $search_product = DB::table('laptop')->where('laptop_name','like','%'.$keyword.'%')->get();
    	return view('pages.laptop.search')->with('category',$category)->with('producer',$producer)->with('search_product',$search_product);
    }


}
