<?php

namespace App\Http\Controllers;

use Gloudemans\Shoppingcart\Facades\Cart;

class SaveLaterController extends Controller
{
    public function saveForLater($id){
        $item = Cart::instance('default')->get($id);
        if(auth()->user()){
            Cart::instance('default')->restore(auth()->user()->id.'_default');
            Cart::instance('default')->remove($id);
            Cart::instance('default')->store(auth()->user()->id.'_default');
        }else{
            Cart::instance('default')->remove($id);
        }

        $duplications = Cart::instance('saveForLater')->search(function ($cartItem, $rowId) use ($id){
            return $rowId === $id;
        });

        if($duplications->isNotEmpty())
            return redirect()->to('cart')->with('success_message', 'Item is already saved for later!');

        Cart::instance('saveForLater')->add($item->id, $item->name, 1, $item->price)
            ->associate('App\Product');

        if(auth()->user()){
            Cart::instance('saveForLater')->restore(auth()->user()->id.'_saveForLater');
            Cart::instance('saveForLater')->store(auth()->user()->id.'_saveForLater');
        }

        return redirect()->to('cart')->with('success_message', 'Item was saved for later!');
    }

    public function removeSaveForLaterItem($id){
        if(auth()->user()){
            Cart::instance('saveForLater')->restore(auth()->user()->id.'_saveForLater');
            Cart::instance('saveForLater')->remove($id);
            Cart::instance('saveForLater')->store(auth()->user()->id.'_saveForLater');
        }else{
            Cart::instance('saveForLater')->remove($id);
        }

        return redirect()->to('cart')->with('success_message', 'Item has been removed!');
    }
}
