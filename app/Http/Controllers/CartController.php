<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Cart;
session_start();

class CartController extends Controller
{
    public function save_cart(Request $request){
        $laptopId = $request->productid_hidden;
        $quantity = $request->qty;
        $laptop_info = DB::table('laptop')->where('laptop_id',$laptopId)->first(); 

        $data['id'] = $laptop_info->laptop_id;
        $data['qty'] = $quantity;
        $data['name'] = $laptop_info->laptop_name;
        $data['price'] = $laptop_info->price;
        $data['weight'] = $laptop_info->price;
        $data['options']['image'] = $laptop_info->image;
        Cart::add($data);
        Cart::setGlobalTax(0);

        return Redirect::to('/show-cart');     
    }
    public function show_cart(Request $request){
        $category = DB::table('category')->orderby('cate_id','desc')->get(); 
        $producer = DB::table('producer')->orderby('producer_id','desc')->get(); 
        return view('pages.cart.show_cart')->with('category',$category)->with('producer',$producer);
    }
    public function delete_to_cart($rowId){
        Cart::update($rowId,0);
        return Redirect::to('/show-cart');
    }
    public function update_cart_quantity(Request $request){
        $rowId = $request->rowId_cart;
        $qty = $request->cart_quantity;
        Cart::update($rowId,$qty);
        return Redirect::to('/show-cart');
    }
}
