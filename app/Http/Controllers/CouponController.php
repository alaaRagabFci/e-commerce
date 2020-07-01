<?php

namespace App\Http\Controllers;

use App\Coupon;
use Gloudemans\Shoppingcart\Facades\Cart;

class CouponController extends Controller
{
    public function addCoupon(){
        $counpon = Coupon::where('code', request()->couponCode)->first();

        if(!$counpon)
            return back()->withErrors('Invalid coupon code. Please try again.');

        session()->put('coupon', [
            'name' => $counpon->code,
            'discount' => $counpon->discount(Cart::subtotal()),
        ]);

        return back()->with('success_message', 'Coupon has been applied!');
    }

    public function removeCoupon(){
        session()->forget('coupon');
        return back()->with('success_message', 'Coupon has been removed!');
    }
}
