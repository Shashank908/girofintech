<?php

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

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
Route::view('/', 'welcome');
Auth::routes();

Route::get('/login/admin', 'Auth\LoginController@showAdminLoginForm');
Route::get('/login/marketing', 'Auth\LoginController@showMarketingLoginForm');

Route::get('/login/support', 'Auth\LoginController@showSupportLoginForm'); //done
Route::get('/login/customer', 'Auth\LoginController@showCustomerLoginForm'); //done

Route::get('/register/admin', 'Auth\RegisterController@showAdminRegisterForm');
Route::get('/register/marketing', 'Auth\RegisterController@showmarketingRegisterForm');
Route::get('/register/support', 'Auth\RegisterController@showSupportRegisterForm'); //done
Route::get('/register/customer', 'Auth\RegisterController@showCustomerRegisterForm'); //done

Route::post('/login/admin', 'Auth\LoginController@adminLogin');
Route::post('/login/marketing', 'Auth\LoginController@marketingLogin');
Route::post('/login/support', 'Auth\LoginController@supportLogin'); //done
Route::post('/login/customer', 'Auth\LoginController@customerLogin'); //done

Route::post('/register/admin', 'Auth\RegisterController@createAdmin');
Route::post('/register/marketing', 'Auth\RegisterController@createmarketing');
Route::post('/register/support', 'Auth\RegisterController@createsupport'); //Todo
Route::post('/register/customer', 'Auth\RegisterController@createCustomer'); //Todo


// Route::group(['middleware' => ['web']], function() {
//     Route::get('/home', 'VisitorController@index')->name('home');
//     Route::get('/list', 'VisitorController@list')->name('list'); 
// });

Route::view('/home', 'home')->middleware('auth');
Route::view('/admin', 'admin')->middleware('auth');
Route::view('/marketing', 'marketing')->middleware('auth');
Route::view('/support', 'support');//->middleware('auth');
Route::view('/customer', 'customer');//->middleware('auth');

Route::get('/payment', 'PaymentController@showPaymentForm');//->middleware('auth');
Route::post('/payment', 'PaymentController@payment');
Route::post('/checkout', 'PaymentController@checkout'); 
Route::get('/ccavResponseHandler', 'PaymentController@ccavResponseHandler');

Route::get('/product', 'ProductsController@index');
Route::get('cart', 'ProductsController@cart');
Route::get('add-to-cart/{id}', 'ProductsController@addToCart');
Route::patch('update-cart', 'ProductsController@update');
Route::delete('remove-from-cart', 'ProductsController@remove');
