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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
 	Route::group(['prefix' => 'inventory', 'middleware' => ['is_admin']], function(){
 		Route::resource('check_ins', 'CheckInController');
 		Route::resource('categories', 'CategoryController');
 		Route::resource('products', 'ProductController');

    Route::get('products/editPrice/{product}', 'ProductController@editPrice')->name('products.editPrice');
    Route::get('products/editQuantity/{product}', 'ProductController@editQuantity')->name('products.editQuantity');

    Route::post('products/updatePrice/{product}', 'ProductController@updatePrice')->name('products.updatePrice');
    Route::post('products/updateQuantity/{product}', 'ProductController@updateQuantity')->name('products.updateQuantity');
	});

	Route::group(['prefix' => 'outlet'], function(){
  	Route::resource('check_outs', 'CheckOutController');
  	Route::resource('bills', 'BillController');
  	// Route::resource('customers', 'CustomerController');
	});
});