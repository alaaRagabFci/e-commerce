<?php

namespace App\Http\Controllers;

use App\Category;
use App\Order;
use App\Product;
use App\ShoppingCart;
use App\User;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Hash;

class ProductController extends Controller
{
    public function index()
    {
        if(auth()->user()){
            //Get coupon from DB if found to apply on cart && get cart && cart count
            $shopingCart = ShoppingCart::where('identifier', auth()->user()->id.'_default')->first();
            $data = $this->getCarts($shopingCart->coupon_id);
        }else{
            // Get cart && cart count
            $data = $this->getCarts();
        }

        $products = Product::where('featured', 1)->take(8)->inRandomOrder()->get();

        return view('home', [
            'products' => $products,
            'cartCount' => $data['cartCount'],
        ]);
    }

    public function getProduct($slug){
        // Get cart && cart count
        $data = $this->getCarts();

        $product = Product::where('slug', $slug)->firstOrFail();
        $mightAlsoLike = Product::where('slug', '!=', $slug)->inRandomOrder()->take(4)->get();

        return view('product-details', [
            'product' => $product,
            'mightAlsoLike' => $mightAlsoLike,
            'cartCount' => $data['cartCount'],
        ]);
    }

    public function allProducts(){
        // Get cart && cart count
        $data = $this->getCarts();

        $sort = request()->sort ? request()->sort : 'ASC';
        if(request()->category){
            $products = Product::with('categories')->whereHas('categories', function($query){
                $query->where('slug', request()->category);
            })->orderBy('price', $sort)->paginate(12);
            $categoryName = Category::where('slug', request()->category)->first()->name;
        }else{
            $products = Product::where('featured', 1)->orderBy('price', $sort)->paginate(12);
            $categoryName = 'Featured';
        }

        $categories = Category::get();

        return view('shop', [
            'products' => $products,
            'categories' => $categories,
            'categoryName' => $categoryName,
            'cartCount' => $data['cartCount'],
        ]);
    }

    public function updateMyAccount()
    {
        request()->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.auth()->id(),
            'password' => 'sometimes|nullable|string|min:6|confirmed',
        ]);

        $user = User::find(auth()->user()->id);
        $user->update([
            'name' => request()->name,
            'email' => request()->email,
        ]);

        if(request()->password){
            $user->update([
                'password' => Hash::make(request()->password),
            ]);
        }

        return back()->with('success_message', 'Profile updated successfully!');
    }

    public function myOrders()
    {
        $orders = auth()->user()->orders()->with('products')->latest()->get();
        return view('my-orders', compact('orders'));
    }
}
