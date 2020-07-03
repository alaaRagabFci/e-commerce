<?php

use Gloudemans\Shoppingcart\Facades\Cart;

function changePriceFormat($price): string
{
    return number_format(round($price, 2)).'£';
}

function checkFileExist($image): string
{
    return $image && file_exists($image) ? asset($image) : asset('uploads/products/1024px-No_image_available.svg.png');
}

function getNumbers()
{
    $tax = config('cart.tax') / 100;
    $discount = session()->get('coupon')['discount'] ?? 0;
    $newSubtotal = Cart::instance('default')->subtotal() - $discount;
    $newSubtotal = $newSubtotal > 0 ? $newSubtotal : 0;
    $newTax =  $newSubtotal * $tax;
    $newTotal = $newSubtotal * (1 + $tax);

    return collect([
        'discount' => $discount,
        'newSubtotal' => $newSubtotal,
        'newTax' => $newTax,
        'newTotal' => $newTotal,
    ]);
}


