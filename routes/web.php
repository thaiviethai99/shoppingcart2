<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', 'HomeController@index');
Route::get('mua-hang/{id}/{tensanpham}', ['as' => 'muahang', 'uses' => 'HomeController@muahang']);
Route::get('gio-hang', ['as' => 'giohang', 'uses' => 'HomeController@giohang']);
Route::get('xoa-gio-hang/{id}', ['as' => 'xoagiohang', 'uses' => 'HomeController@xoagiohang']);
Route::get('cap-nhat-gio-hang/{id}/{qty}', ['as' => 'capnhatgiohang', 'uses' => 'HomeController@capnhatgiohang']);
Route::get('checkout', ['as' => 'checkout', 'uses' => 'HomeController@checkout']);
Route::get('placeOrder', ['as' => 'placeOrder', 'uses' => 'HomeController@placeOrder']);
Route::get('orderSuccess', ['as' => 'orderSuccess', 'uses' => 'HomeController@orderSuccess']);
