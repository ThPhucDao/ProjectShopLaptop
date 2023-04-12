<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProducerController;
use App\Http\Controllers\PromoController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\LaptopController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;

//Frontend
Route::get('/', [HomeController::class, 'index']);
Route::get('/trang-chu', [HomeController::class, 'index']);
Route::get('/tim-kiem', [HomeController::class, 'search']);

//Homepage - CategoryProduct
Route::get('/danh-muc/{category_id}', [CategoryController::class, 'show_category_home']);
Route::get('/thuong-hieu/{producer_id}', [ProducerController::class, 'show_producer_home']);
Route::get('/chi-tiet/{laptop_id}', [LaptopController::class, 'details_laptop']);

//Cart
Route::get('/show-cart',[CartController::class, 'show_cart']);
Route::get('/delete-to-cart/{rowId}',[CartController::class, 'delete_to_cart']);
Route::post('/update-cart-quantity',[CartController::class, 'update_cart_quantity']);
Route::post('/save-cart',[CartController::class, 'save_cart']);

//Checkout
Route::get('/login-checkout',[CheckoutController::class, 'login_checkout']);
Route::get('/logout-checkout',[CheckoutController::class, 'logout_checkout']);
Route::post('/dang-ky', [CheckoutController::class, 'register']);
Route::post('/dang-nhap', [CheckoutController::class, 'login']);
Route::get('/checkout',[CheckoutController::class, 'checkout']);
Route::post('/save-checkout',[CheckoutController::class, 'save_checkout']);
Route::get('/payment',[CheckoutController::class, 'payment']);
Route::post('/order-invoice', [CheckoutController::class, 'order_invoice']);
Route::get('/payment',[CheckoutController::class, 'payment']);

//Backend
Route::get('/admin', [AdminController::class, 'index']);
Route::get('/dashboard', [AdminController::class, 'show_dashboard']);
Route::get('/logout', [AdminController::class, 'logout']);
Route::post('/admin-dashboard', [AdminController::class, 'dashboard']);

//Category
Route::get('/add-category', [CategoryController::class, 'add_category']);
Route::get('/all-category', [CategoryController::class, 'all_category']);
Route::get('/delete-category/{category_id}', [CategoryController::class, 'delete_category']);
Route::get('/edit-category/{category_id}', [CategoryController::class, 'edit_category']);

Route::post('/save-category', [CategoryController::class, 'save_category']);
Route::post('/update-category/{cate_id}', [CategoryController::class, 'update_category']);

//Producer
Route::get('/add-producer', [ProducerController::class, 'add_producer']);
Route::get('/all-producer',[ProducerController::class, 'all_producer']);
Route::get('/delete-producer/{producer_id}',[ProducerController::class, 'delete_producer']);
Route::get('/edit-producer/{producer_id}',[ProducerController::class, 'edit_producer']);

Route::post('/save-producer',[ProducerController::class, 'save_producer']);
Route::post('/update-producer/{producer_id}',[ProducerController::class, 'update_producer']);

//Promotion
Route::get('/add-promo', [PromoController::class, 'add_promo']);
Route::get('/all-promo',[PromoController::class, 'all_promo']);
Route::get('/edit-promo/{producer_id}',[PromoController::class, 'edit_promo']);

Route::get('/unactive-promo/{producer_id}',[PromoController::class, 'unactive_promo']);
Route::get('/active-promo/{producer_id}',[PromoController::class, 'active_promo']);

Route::post('/save-promo',[PromoController::class, 'save_promo']);
Route::post('/update-promo/{producer_id}',[PromoController::class, 'update_promo']);

//Account
Route::get('/add-account', [AccountController::class, 'add_account']);
Route::get('/all-account',[AccountController::class, 'all_account']);
Route::get('/delete-account/{email_account}',[AccountController::class, 'delete_account']);
Route::get('/edit-account/{email_account}',[AccountController::class, 'edit_account']);

Route::get('/unactive-account/{email_account}',[AccountController::class, 'unactive_account']);
Route::get('/active-account/{email_account}',[AccountController::class, 'active_account']);

Route::post('/save-account',[AccountController::class, 'save_acount']);
Route::post('/update-account/{email_account}',[AccountController::class, 'update_account']);


//Laptop
Route::get('/add-laptop', [LaptopController::class, 'add_laptop']);
Route::get('/all-laptop',[LaptopController::class, 'all_laptop']);
Route::get('/delete-laptop/{laptop_id}',[LaptopController::class, 'delete_laptop']);
Route::get('/edit-laptop/{laptop_id}',[LaptopController::class, 'edit_laptop']);

Route::get('/unactive-laptop/{laptop_id}',[LaptopController::class, 'unactive_account']);
Route::get('/active-laptop/{laptop_id}',[LaptopController::class, 'active_account']);

Route::post('/save-laptop',[LaptopController::class, 'save_laptop']);
Route::post('/update-laptop/{laptop_id}',[LaptopController::class, 'update_laptop']);

//Invoice
Route::get('/all-invoice',[CheckoutController::class, 'all_invoice']);
Route::get('/detail-invoice/{invoice_id}',[CheckoutController::class, 'detail_invoice']);
Route::post('/update-invoice/{invoice_id}',[CheckoutController::class, 'update_invoice']);