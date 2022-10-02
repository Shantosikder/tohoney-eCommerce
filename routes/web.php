<?php

use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProductController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes(['verify' => true]);

Route::get('/', 'FrontendController@index');

Route::get('/contact', 'FrontendController@contact');
Route::get('/about', 'FrontendController@about');
Route::get('/product/details/{product_id}', 'FrontendController@productdetails');
Route::get('/shop', 'FrontendController@shop');

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');

//category Route Category Controller
Route::get('/add/category', 'CategoryController@addcategory');

//add category route
Route::post('/add/category/post', 'CategoryController@addcategorypost');

//update route
Route::get('/update/category/{category_id}','CategoryController@updatecategory');
Route::post('/update/category/post','CategoryController@updatecategorypost');

//Delete Category route
Route::get('/delete/category/{category_id}','CategoryController@deletecategory');

//profile Route profile Controller
Route::get('/profile', 'ProfileController@index');
Route::post('profile/post', 'ProfileController@profilepost');

//chnage password
Route::post('password/post', 'ProfileController@passwordpost');


// product Route
Route::get('/add/product', 'ProductController@addproduct');
Route::post('add/product/post', 'ProductController@addproductpost');

//cart route
Route::get('/cart','CartController@cart');
Route::get('/cart/{coupon_name}','CartController@cart');
Route::post('/add/to/cart','CartController@addtocart');
Route::get('/cart/delete/{cart_id}','CartController@cartdelete');
Route::post('/cart/update','CartController@cartupdate');

//Coupon Route
Route::get('/add/coupon','CouponController@addcoupon');
Route::post('/add/coupon/post', 'CouponController@addcouponpost');

//checkout Route
Route::post('/checkout', 'CheckoutController@index');
Route::post('checkout/post', 'CheckoutController@checkoutpost');

//Customar register Route
Route::get('/customer/register','Customer_registerController@customerregister');
Route::post('/customer/register/post','Customer_registerController@customerregisterpost');\

//payment getway Stripe

Route::get('stripe', 'StripePaymentController@stripe');
Route::post('stripe', 'StripePaymentController@stripePost')->name('stripe.post');






