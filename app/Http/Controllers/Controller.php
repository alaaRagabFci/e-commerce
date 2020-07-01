<?php

namespace App\Http\Controllers;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function getCarts(){
        if(auth()->user()){
            Cart::restore(auth()->user()->email);
            Cart::store(auth()->user()->email);
            $carts = session()->get('cart.default');
        }else{
            $carts = Cart::instance('default')->content();
        }

        $cartCount = $carts ? count($carts) : 0;
        return array('carts' => $carts, 'cartCount' => $cartCount);
    }
}
