<?php

namespace App\Http\Controllers;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Validator;
use Cartalyst\Stripe\Laravel\Facades\Stripe;

class CheckoutController extends Controller
{
    public function index(){
        $data = $this->getCarts();

        return view('checkout',[
            'carts' => $data['carts'],
            'cartCount' => $data['cartCount'],
            'newSubtotal' => getNumbers()->get('newSubtotal'),
            'newTax' => getNumbers()->get('newTax'),
            'newTotal' => getNumbers()->get('newTotal'),
            'discount' => getNumbers()->get('discount'),
        ]);
    }

    public function pay(){
        $emailValidation = auth()->user() ? 'required|email' : 'required|email|unique:users';

        Validator::make(request()->all(), [
            'email' => $emailValidation,
            'name' => 'required',
            'address' => 'required',
            'city' => 'required',
            'province' => 'required',
            'postalcode' => 'required',
            'phone' => 'required',
        ]);

        $contents = Cart::content()->map(function ($item) {
                return $item->model->slug.', '.$item->qty;
            })->values()->toJson();

            $stripe = Stripe::make('sk_test_YFy2fVUR5bECaG8LCbHBDjfX');

            try {
                $charge =$stripe->charges()->create([
                    'amount' => getNumbers()->get('newTotal'),
                    'currency' => 'EGP',
                    'source' => request()->stripeToken,
                    'description' => 'New Order',
                    'receipt_email' => request()->email,
                    'metadata' => [
                        'contents' => $contents,
                        'quantity' => Cart::instance('default')->count(),
                        'discount' => collect(session()->get('coupon'))->toJson(),
                    ],
                ]);

                Cart::instance('default')->restore(auth()->user()->id.'_default');
                Cart::instance('default')->destroy();
                Cart::instance('default')->store(auth()->user()->id.'_default');
                session()->forget('coupon');

                return redirect()->route('confirmation.index')->with('success_message', 'Thank you! Your payment has been successfully accepted!');
            } catch (\Cartalyst\Stripe\Exception\CardErrorException $e) {
                return back()->withInput()->withErrors('Error! ' . $e->getMessage());
            } catch (\Cartalyst\Stripe\Exception\MissingParameterException $e) {
                return back()->withInput()->withErrors('Error! ' . $e->getMessage());
            } catch (\Exception  $e) {
                return back()->withInput()->withErrors('Error! ' . $e->getMessage());
            }

    }
}


