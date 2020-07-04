<?php

namespace App\Http\Controllers;

use App\Coupon;
use App\ShoppingCart;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function getCarts($couponId = null){
        if(auth()->user()){
            $cartCount = 0;
            //Restore user cart [Restore function delete database records] & store again
            Cart::instance('default')->restore(auth()->user()->id.'_default');
            Cart::instance('default')->store(auth()->user()->id.'_default');

            //Check cart coupon if used => save again and relate it with user
            if($couponId){
                $shopingCart = ShoppingCart::where('identifier', auth()->user()->id.'_default')->first();
                if($shopingCart){
                    $shopingCart->coupon_id  = $couponId;
                    $shopingCart->save();
                    $coupon = Coupon::find($couponId);
                    session()->put('coupon', [
                        'id' => $coupon->id,
                        'name' => $coupon->code,
                        'discount' => $coupon->discount(Cart::subtotal()),
                    ]);
                }
            }

            $carts = session()->get('cart.default');
            //Calculate cart quantity
            if($carts && count($carts) > 0){
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
            //Restore user saved for later [Restore function delete database records] & store again
            Cart::instance('saveForLater')->restore(auth()->user()->id.'_saveForLater');
            Cart::instance('saveForLater')->store(auth()->user()->id.'_saveForLater');

            $savedForLater = session()->get('cart.saveForLater');
            //Calculate saved for later quantity
            if($savedForLater && count($savedForLater) > 0){
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
