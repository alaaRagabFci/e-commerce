@extends('partials.layouts')
@section('title', 'Shop')
@section('content')
@include('partials.breadcrumb')
<div class="container">

</div>

<div class="product-section container">
    <div>
        <div class="product-section-image">
            <img src="../storage/products/dummy/appliance-1.jpg" alt="product" class="active" id="currentImage">
        </div>
        <div class="product-section-images">
            <div class="product-section-thumbnail selected">
                <img src="../storage/products/dummy/appliance-1.jpg" alt="product">
            </div>

            <div class="product-section-thumbnail">
                <img src="../storage/products/dummy/laptop-2.jpg" alt="product">
            </div>
            <div class="product-section-thumbnail">
                <img src="../storage/products/dummy/laptop-3.jpg" alt="product">
            </div>
            <div class="product-section-thumbnail">
                <img src="../storage/products/dummy/laptop-4.jpg" alt="product">
            </div>
        </div>
    </div>
    <div class="product-section-information">
        <h1 class="product-section-title">Appliance 1</h1>
        <div class="product-section-subtitle">Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis, dolorum!</div>
        <div>
            <div class="badge badge-success">In Stock</div>
        </div>
        <div class="product-section-price">$891.14</div>

        <p>
            Lorem 1 ipsum dolor sit amet, consectetur adipisicing elit. Ipsum temporibus iusto ipsa, asperiores voluptas unde aspernatur praesentium in? Aliquam, dolore!
        </p>

        <p>&nbsp;</p>

        <form action="https://laravelecommerceexample.ca/cart/76" method="POST">
            <input type="hidden" name="_token" value="nvggLkr4XriuW6x32myBjszYdQox8Hbu2QMoh7BR">
            <button type="submit" class="button button-plain">Add to Cart</button>
        </form>
    </div>
</div>
<!-- end product-section -->

<div class="might-like-section">
    <div class="container">
        <h2>You might also like...</h2>
        <div class="might-like-grid">
            <a href="camera-4.html" class="might-like-product">
                <img src="../storage/products/dummy/camera-4.jpg" alt="product">
                <div class="might-like-product-name">Camera 4</div>
                <div class="might-like-product-price">$1460.76</div>
            </a>
            <a href="camera-5.html" class="might-like-product">
                <img src="../storage/products/dummy/camera-5.jpg" alt="product">
                <div class="might-like-product-name">Camera 5</div>
                <div class="might-like-product-price">$1176.00</div>
            </a>
            <a href="tablet-1.html" class="might-like-product">
                <img src="../storage/products/dummy/tablet-1.jpg" alt="product">
                <div class="might-like-product-name">Tablet 1</div>
                <div class="might-like-product-price">$657.07</div>
            </a>
            <a href="laptop-7.html" class="might-like-product">
                <img src="../storage/products/dummy/laptop-7.jpg" alt="product">
                <div class="might-like-product-name">Laptop 7</div>
                <div class="might-like-product-price">$1751.81</div>
            </a>

        </div>
    </div>
</div>

@endsection
