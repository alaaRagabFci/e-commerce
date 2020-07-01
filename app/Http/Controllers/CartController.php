<?php

namespace App\Http\Controllers;

use App\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    public function cart(){
        $data = $this->getCarts();
        $savedForlaterData = $this->getSavedForlater();
        $tax = config('cart.tax') / 100;
        $discount = session()->get('coupon')['discount'];
        $newSubtotal = Cart::instance('default')->subtotal() - $discount;
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
            'savedForLater' => $savedForlaterData['savedForLater'],
            'saveForLaterCount' => $savedForlaterData['saveForLaterCount'],
        ]);
    }

    public function addToCart(){
        $duplications = Cart::instance('default')->search(function ($cartItem, $rowId){
            return $cartItem->id === request()->id;
        });

        if($duplications->isNotEmpty())
            return redirect()->to('cart')->with('success_message', 'Item is already at your cart!');

        Cart::instance('default')->add(request()->id, request()->name, 1, request()->price)
            ->associate('App\Product');

        if(auth()->user()){
            Cart::instance('default')->restore(auth()->user()->id.'_default');
            Cart::instance('default')->store(auth()->user()->id.'_default');
        }

        return redirect()->to('cart')->with('success_message', 'Item was added to your cart!');
    }

    public function removeCartItem($id){
        if(auth()->user()){
            Cart::instance('default')->restore(auth()->user()->id.'_default');
            Cart::instance('default')->remove($id);
            Cart::instance('default')->store(auth()->user()->id.'_default');
        }else{
            Cart::instance('default')->remove($id);
        }

        return redirect()->to('cart')->with('success_message', 'Item has been removed!');
    }

    public function moveToCart($id){
        $item = Cart::instance('saveForLater')->get($id);
        if(auth()->user()){
            Cart::instance('saveForLater')->restore(auth()->user()->id.'_default');
            Cart::instance('saveForLater')->remove($id);
            Cart::instance('saveForLater')->store(auth()->user()->id.'_default');
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
            Cart::instance('default')->restore(auth()->user()->id.'_default');
            Cart::instance('default')->update($id, request()->quantity);
            Cart::instance('default')->store(auth()->user()->id.'_default');
        }else{
            Cart::instance('default')->update($id, request()->quantity);
        }

        session()->flash('success_message', 'Quantity was updated successfully!');
        return response()->json(['success' => true]);
    }

}
