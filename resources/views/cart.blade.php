@extends('partials.layouts')
@section('title', 'Cart')
@section('content')
@include('partials.breadcrumb')
<div class="cart-section container">
    <div>
        <h3>No items in Cart!</h3>
        <div class="spacer"></div>
        <a href="shop.html" class="button">Continue Shopping</a>
        <div class="spacer"></div>

        <h3>You have no items Saved for Later.</h3>
    </div>
</div>
<!-- end cart-section -->

<div class="might-like-section">
    <div class="container">
        <h2>You might also like...</h2>
        <div class="might-like-grid">
            <a href="shop/laptop-17.html" class="might-like-product">
                <img src="storage/products/dummy/laptop-17.jpg" alt="product" />
                <div class="might-like-product-name">Laptop 17</div>
                <div class="might-like-product-price">$2286.30</div>
            </a>
            <a href="shop/laptop-21.html" class="might-like-product">
                <img src="storage/products/dummy/laptop-21.jpg" alt="product" />
                <div class="might-like-product-name">Laptop 21</div>
                <div class="might-like-product-price">$2412.17</div>
            </a>
            <a href="shop/laptop-20.html" class="might-like-product">
                <img src="storage/products/dummy/laptop-20.jpg" alt="product" />
                <div class="might-like-product-name">Laptop 20</div>
                <div class="might-like-product-price">$1710.36</div>
            </a>
            <a href="shop/phone-7.html" class="might-like-product">
                <img src="storage/products/dummy/phone-7.jpg" alt="product" />
                <div class="might-like-product-name">Phone 7</div>
                <div class="might-like-product-price">$1160.86</div>
            </a>
        </div>
    </div>
</div>
@endsection
