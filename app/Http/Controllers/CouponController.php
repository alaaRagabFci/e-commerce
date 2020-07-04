<?php

namespace App\Http\Controllers;

use App\Coupon;
use App\ShoppingCart;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\DB;

class CouponController extends Controller
{
    public function addCoupon(){
        $counpon = Coupon::where('code', request()->couponCode)->first();

        if(!$counpon)
            return back()->withErrors('Invalid coupon code. Please try again.');

        session()->put('coupon', [
            'id' => $counpon->id,
            'name' => $counpon->code,
            'discount' => $counpon->discount(Cart::subtotal()),
        ]);

        $shopingCart = ShoppingCart::where('identifier', auth()->user()->id.'_default')->first();
        if($shopingCart){
            $shopingCart->coupon_id  = $counpon->id;
            $shopingCart->save();
        }

        return back()->with('success_message', 'Coupon has been applied!');
    }

    public function removeCoupon(){
        $shopingCart = ShoppingCart::where('identifier', auth()->user()->id.'_default')->first();
        if($shopingCart){
            $shopingCart->coupon_id  = null;
            $shopingCart->save();
        }
        session()->forget('coupon');
        return back()->with('success_message', 'Coupon has been removed!');
    }
}
