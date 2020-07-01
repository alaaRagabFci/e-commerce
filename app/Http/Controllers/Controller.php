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
            $cartCount = 0;
            Cart::instance('default')->restore(auth()->user()->id.'_default');
            Cart::instance('default')->store(auth()->user()->id.'_default');
            $carts = session()->get('cart.default');
            if(count($carts) > 0){
                foreach($carts as $cart){
                    $cartCount += $cart->qty;
                }
            }
        }
        else{
            $carts = Cart::instance('default')->content();
            $cartCount = Cart::instance('default')->count() ?? 0;
        }

        return array('carts' => $carts, 'cartCount' => $cartCount);
    }

    public function getSavedForlater(){
        if(auth()->user()){
            $saveForLaterCount = 0;
            Cart::instance('saveForLater')->restore(auth()->user()->id.'_saveForLater');
            Cart::instance('saveForLater')->store(auth()->user()->id.'_saveForLater');
            $savedForLater = session()->get('cart.saveForLater');
            if(count($savedForLater) > 0){
                foreach($savedForLater as $item){
                    $saveForLaterCount += $item->qty;
                }
            }
        }
        else{
            $savedForLater = Cart::instance('saveForLater')->content();
            $saveForLaterCount = Cart::instance('saveForLater')->count() ?? 0;
        }

        return array('savedForLater' => $savedForLater, 'saveForLaterCount' => $saveForLaterCount);
    }
}
