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

use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@index');
Route::get('/product-details/{product}', 'HomeController@getProduct');
Route::get('/shop', 'HomeController@allProducts');
Route::view('/cart', 'cart');
Route::view('/details', 'details');
