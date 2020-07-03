<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderProduct;
use App\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Validator;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Cartalyst\Stripe\Exception\CardErrorException;
use Cartalyst\Stripe\Exception\MissingParameterException;

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

                $data = request()->all();
                $data['user_id'] = auth()->user()->id;
                $data['transaction_id'] = $charge['id'];
                $data['object'] = $charge['object'];
                $data['captured'] = $charge['captured'];
                $data['currency'] = $charge['currency'];
                $data['last4'] = $charge['source']['last4'];
                $data['exp_month'] = $charge['source']['exp_month'];
                $data['exp_year'] = $charge['source']['exp_year'];
                $this->createOrder($data, null);

                $this->decreaseQuantities();

                Cart::instance('default')->restore(auth()->user()->id.'_default');
                Cart::instance('default')->destroy();
                Cart::instance('default')->store(auth()->user()->id.'_default');
                session()->forget('coupon');

                return redirect()->route('confirmation.index')->with('success_message', 'Thank you! Your payment has been successfully accepted!');
            } catch (CardErrorException $e) {
                $this->createOrder(request()->all(), $e->getMessage());
                return back()->withInput()->withErrors('Error! ' . $e->getMessage());
            } catch (MissingParameterException $e) {
                $this->createOrder(request()->all(), $e->getMessage());
                return back()->withInput()->withErrors('Error! ' . $e->getMessage());
            } catch (\Exception  $e) {
                $this->createOrder(request()->all(), $e->getMessage());
                return back()->withInput()->withErrors('Error! ' . $e->getMessage());
            }

    }

    public function createOrder($parameters, $error)
    {
        // Insert into orders table
        $order = Order::create([
            'user_id' => auth()->user()->id,
            'billing_email' => auth()->user()->email,
            'billing_name' => $parameters['name'],
            'billing_address' => $parameters['address'],
            'billing_city' => $parameters['city'],
            'billing_province' => $parameters['province'],
            'billing_postalcode' => $parameters['postalcode'],
            'billing_phone' => $parameters['phone'],
            'billing_name_on_card' => $parameters['name_on_card'],
            'billing_discount' => getNumbers()->get('discount'),
            'billing_discount_code' => session()->get('coupon') ? session()->get('coupon')['name'] : 'null',
            'billing_subtotal' => getNumbers()->get('newSubtotal'),
            'billing_tax' => getNumbers()->get('newTax'),
            'billing_total' => getNumbers()->get('newTotal'),
            'error' => $error,
            'transaction_id' => !$error ? $parameters['transaction_id'] : null,
            'object' => !$error ? $parameters['object'] : null,
            'captured' => !$error ?$parameters['captured'] : null,
            'currency' => !$error ? $parameters['currency'] : null,
            'last4' => !$error ? $parameters['last4'] : null,
            'exp_month' => !$error ? $parameters['exp_month'] : null,
            'exp_year' => !$error ? $parameters['exp_year'] : null,
        ]);
        // ->products()->attach([1,2], ["quantity" => 5]);
        foreach (Cart::content() as $item) {
            OrderProduct::create([
                'order_id' => $order->id,
                'product_id' => $item->model->id,
                'quantity' => $item->qty,
            ]);
        }

        return $order;

    }

    protected function decreaseQuantities()
    {
        foreach (Cart::content() as $item) {
            $product = Product::find($item->model->id);
            $product->quantity = $product->quantity - $item->qty;
            $product->save();
        }
    }

}


