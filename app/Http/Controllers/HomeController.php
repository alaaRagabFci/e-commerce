<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    /////////////////////////////////// Home Page
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::inRandomOrder()->take(8)->get();

        return view('home', [
            'products' => $products
        ]);
    }

    /////////////////////////////////// Product details
    public function getProduct($slug){
        $product = Product::where('slug', $slug)->firstOrFail();
        $mightAlsoLike = Product::where('slug', '!=', $slug)->inRandomOrder()->take(4)->get();

        return view('product-details', [
            'product' => $product,
            'mightAlsoLike' => $mightAlsoLike
        ]);
    }

     /////////////////////////////////// Shop page
    public function allProducts(){
        $products = Product::inRandomOrder()->paginate(12);

        return view('shop', [
            'products' => $products,
        ]);
    }

     /////////////////////////////////// Cart
    public function cart(){
        $mightAlsoLike = Product::inRandomOrder()->take(4)->get();

        return view('cart', [
            'mightAlsoLike' => $mightAlsoLike
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

        return redirect()->to('cart')->with('success_message', 'Item was added to your cart!');
    }

    public function removeCartItem($id){
        Cart::remove($id);

        return redirect()->to('cart')->with('success_message', 'Item has been removed!');
    }

    public function moveToCart($id){
        $item = Cart::instance('saveForLater')->get($id);
        Cart::instance('saveForLater')->remove($id);

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

        Cart::update($id, request()->quantity);
        session()->flash('success_message', 'Quantity was updated successfully!');
        return response()->json(['success' => true]);
    }

    ///////////////////////Save for later
    public function saveForLater($id){
        $item = Cart::instance('default')->get($id);
        Cart::instance('default')->remove($id);

        $duplications = Cart::instance('saveForLater')->search(function ($cartItem, $rowId) use ($id){
            return $rowId === $id;
        });

        if($duplications->isNotEmpty())
            return redirect()->to('cart')->with('success_message', 'Item is already saved for later!');

        Cart::instance('saveForLater')->add($item->id, $item->name, 1, $item->price)
            ->associate('App\Product');

        return redirect()->to('cart')->with('success_message', 'Item was saved for later!');
    }

    public function removeSaveForLaterItem($id){
        Cart::instance('saveForLater')->remove($id);

        return redirect()->to('cart')->with('success_message', 'Item has been removed!');
    }

}
