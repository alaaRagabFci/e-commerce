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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Product
Route::get('/', 'ProductController@index');
Route::get('/product-details/{product}', 'ProductController@getProduct');
Route::get('/shop', 'ProductController@allProducts');

// Cart
Route::get('/cart', 'CartController@cart');
Route::post('/add-to-cart', 'CartController@addToCart');
Route::delete('/removeCartItem/{product}', 'CartController@removeCartItem');
Route::post('/moveToCart/{product}', 'CartController@moveToCart');
Route::patch('/updateQuantity/{product}', 'CartController@updateQuantity');

// Save for later
Route::post('/saveForLater/{product}', 'SaveLaterController@saveForLater');
Route::delete('/removeSaveForLaterItem/{product}', 'SaveLaterController@removeSaveForLaterItem');

// Coupon
Route::post('/addCoupon', 'CouponController@addCoupon');
Route::delete('/removeCoupon', 'CouponController@removeCoupon');

// Empty cart
Route::get('empty', function () {
    Cart::destroy();
    Cart::instance('shopping')->destroy();
    Cart::instance('saveForLater')->destroy();
});

Route::view('/search-algolia', 'search');
Route::get('/checkout', 'CheckoutController@index')->middleware('auth');
Route::post('/checkout', 'CheckoutController@pay')->middleware('auth');

Route::view('confirmation', 'thankyou')->name('confirmation.index');

Route::view('my-account', 'my-account')->middleware('auth');
Route::patch('/updateMyAccount', 'ProductController@updateMyAccount')->middleware('auth');
Route::get('/my-orders', 'ProductController@myOrders')->middleware('auth');

Route::post('/paypal-checkout', 'CheckoutController@paypalCheckout')->name('checkout.paypal');

Auth::routes();
