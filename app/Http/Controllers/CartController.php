<?php

namespace App\Http\Controllers;

use App\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    public function cart(){
        $data = $this->getCarts();
        $tax = config('cart.tax') / 100;
        $discount = session()->get('coupon')['discount'];
        $newSubtotal = Cart::subtotal() - $discount;
        $newTax =  $newSubtotal * $tax;
        $newTotal = $newSubtotal * (1 + $tax);
        $mightAlsoLike = Product::inRandomOrder()->take(4)->get();

        return view('cart', [
            'mightAlsoLike' => $mightAlsoLike,
            'newSubtotal' => $newSubtotal,
            'newTax' => $newTax,
            'newTotal' => $newTotal,
            'discount' => $discount,
            'carts' => $data['carts'],
            'cartCount' => $data['cartCount'],
        ]);
    }

    public function addToCart(){
        $duplications = Cart::search(function ($cartItem, $rowId){
            return $cartItem->id === request()->id;
        });

        if($duplications->isNotEmpty())
            return redirect()->to('cart')->with('success_message', 'Item is already at your cart!');

        Cart::add(request()->id, request()->name, 1, request()->price)
            ->associate('App\Product');

        if(auth()->user()){
            Cart::restore(auth()->user()->email);
            Cart::store(auth()->user()->email);
        }

        return redirect()->to('cart')->with('success_message', 'Item was added to your cart!');
    }

    public function removeCartItem($id){
        if(auth()->user()){
            Cart::restore(auth()->user()->email);
            Cart::remove($id);
            Cart::store(auth()->user()->email);
        }else{
            Cart::remove($id);
        }

        return redirect()->to('cart')->with('success_message', 'Item has been removed!');
    }

    public function moveToCart($id){
        $item = Cart::instance('saveForLater')->get($id);
        if(auth()->user()){
            Cart::restore(auth()->user()->email);
            Cart::instance('saveForLater')->remove($id);
            Cart::store(auth()->user()->email);
        }else{
            Cart::instance('saveForLater')->remove($id);
        }

        $duplications = Cart::instance('default')->search(function ($cartItem, $rowId) use ($id){
            return $rowId === $id;
        });

        if($duplications->isNotEmpty())
            return redirect()->to('cart')->with('success_message', 'Item is already at your cart!');

        Cart::instance('default')->add($item->id, $item->name, 1, $item->price)
            ->associate('App\Product');

        return redirect()->to('cart')->with('success_message', 'Item was moved to your cart!');
    }

    public function updateQuantity($id){
        $validator = Validator::make(request()->all(), [
            'quantity' => 'required|numeric|between:1,5'
        ]);

        if ($validator->fails()) {
            session()->flash('errors', collect(['Quantity must be between 1 and 5.']));
            return response()->json(['success' => false], 400);
        }

        if(auth()->user()){
            Cart::restore(auth()->user()->email);
            Cart::update($id, request()->quantity);
            Cart::store(auth()->user()->email);
        }else{
            Cart::update($id, request()->quantity);
        }

        session()->flash('success_message', 'Quantity was updated successfully!');
        return response()->json(['success' => true]);
    }

}
