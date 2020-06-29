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

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@index');

Route::get('/product-details/{product}', 'HomeController@getProduct');

Route::get('/shop', 'HomeController@allProducts');

Route::get('/cart', 'HomeController@cart');
Route::post('/add-to-cart', 'HomeController@addToCart');
Route::delete('/removeCartItem/{product}', 'HomeController@removeCartItem');
Route::post('/moveToCart/{product}', 'HomeController@moveToCart');
Route::patch('/updateQuantity/{product}', 'HomeController@updateQuantity');

Route::post('/saveForLater/{product}', 'HomeController@saveForLater');
Route::delete('/removeSaveForLaterItem/{product}', 'HomeController@removeSaveForLaterItem');

Route::post('/addCoupon', 'HomeController@addCoupon');
Route::delete('/removeCoupon', 'HomeController@removeCoupon');

Route::get('empty', function () {
    Cart::instance('default')->destroy();
    Cart::instance('saveForLater')->destroy();
});

Route::view('/details', 'details');
