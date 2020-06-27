@extends('partials.layouts')
@section('title', 'Shop')
@section('content')
@include('partials.breadcrumb')
<div class="container"></div>

<div class="products-section container">
    <div class="sidebar">
        <h3>By Category</h3>
        <ul>
            <li class="">
                <a href="shop8387.html?category=laptops">Laptops</a>
            </li>
            <li class="">
                <a href="shop015b.html?category=desktops">Desktops</a>
            </li>
            <li class="">
                <a href="shop2d05.html?category=mobile-phones">Mobile Phones</a>
            </li>
            <li class="">
                <a href="shopdd66.html?category=tablets">Tablets</a>
            </li>
            <li class="">
                <a href="shope10b.html?category=tvs">TVs</a>
            </li>
            <li class="">
                <a href="shop8d34.html?category=digital-cameras"
                    >Digital Cameras</a
                >
            </li>
            <li class="">
                <a href="shop9a8c.html?category=appliances">Appliances</a>
            </li>
        </ul>
    </div>
    <!-- end sidebar -->
    <div>
        <div class="products-header">
            <h1 class="stylish-heading">Featured</h1>
            <div>
                <strong>Price: </strong>
                <a href="shop6330.html?sort=low_high">Low to High</a> |
                <a href="shop94e1.html?sort=high_low">High to Low</a>
            </div>
        </div>

        <div class="products text-center">
            <div class="product">
                <a href="shop/laptop-1.html"
                    ><img
                        src="storage/products/dummy/laptop-1.jpg"
                        alt="product"
                /></a>
                <a href="shop/laptop-1.html"
                    ><div class="product-name">Laptop 1</div></a
                >
                <div class="product-price">$2106.84</div>
            </div>
            <div class="product">
                <a href="shop/laptop-12.html"
                    ><img
                        src="storage/products/dummy/laptop-12.jpg"
                        alt="product"
                /></a>
                <a href="shop/laptop-12.html"
                    ><div class="product-name">Laptop 12</div></a
                >
                <div class="product-price">$2345.70</div>
            </div>
            <div class="product">
                <a href="shop/laptop-22.html"
                    ><img
                        src="storage/products/dummy/laptop-22.jpg"
                        alt="product"
                /></a>
                <a href="shop/laptop-22.html"
                    ><div class="product-name">Laptop 22</div></a
                >
                <div class="product-price">$2038.49</div>
            </div>
            <div class="product">
                <a href="shop/desktop-1.html"
                    ><img
                        src="storage/products/dummy/desktop-1.jpg"
                        alt="product"
                /></a>
                <a href="shop/desktop-1.html"
                    ><div class="product-name">Desktop 1</div></a
                >
                <div class="product-price">$4401.87</div>
            </div>
            <div class="product">
                <a href="shop/phone-2.html"
                    ><img
                        src="storage/products/dummy/phone-2.jpg"
                        alt="product"
                /></a>
                <a href="shop/phone-2.html"
                    ><div class="product-name">Phone 2</div></a
                >
                <div class="product-price">$1414.51</div>
            </div>
            <div class="product">
                <a href="shop/phone-4.html"
                    ><img
                        src="storage/products/dummy/phone-4.jpg"
                        alt="product"
                /></a>
                <a href="shop/phone-4.html"
                    ><div class="product-name">Phone 4</div></a
                >
                <div class="product-price">$1235.07</div>
            </div>
            <div class="product">
                <a href="shop/phone-8.html"
                    ><img
                        src="storage/products/dummy/phone-8.jpg"
                        alt="product"
                /></a>
                <a href="shop/phone-8.html"
                    ><div class="product-name">Phone 8</div></a
                >
                <div class="product-price">$844.00</div>
            </div>
            <div class="product">
                <a href="shop/tablet-3.html"
                    ><img
                        src="storage/products/dummy/tablet-3.jpg"
                        alt="product"
                /></a>
                <a href="shop/tablet-3.html"
                    ><div class="product-name">Tablet 3</div></a
                >
                <div class="product-price">$1425.89</div>
            </div>
            <div class="product">
                <a href="shop/tablet-5.html"
                    ><img
                        src="storage/products/dummy/tablet-5.jpg"
                        alt="product"
                /></a>
                <a href="shop/tablet-5.html"
                    ><div class="product-name">Tablet 5</div></a
                >
                <div class="product-price">$514.63</div>
            </div>
        </div>
        <!-- end products -->

        <div class="spacer"></div>
        <nav>
            <ul class="pagination">
                <li
                    class="page-item disabled"
                    aria-disabled="true"
                    aria-label="&laquo; Previous"
                >
                    <span class="page-link" aria-hidden="true">&lsaquo;</span>
                </li>

                <li class="page-item active" aria-current="page">
                    <span class="page-link">1</span>
                </li>
                <li class="page-item">
                    <a class="page-link" href="shop4658.html?page=2">2</a>
                </li>

                <li class="page-item">
                    <a
                        class="page-link"
                        href="shop4658.html?page=2"
                        rel="next"
                        aria-label="Next &raquo;"
                        >&rsaquo;</a
                    >
                </li>
            </ul>
        </nav>
    </div>
</div>
@endsection
