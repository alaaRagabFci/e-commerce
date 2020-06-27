<!DOCTYPE html>
<html lang="en">
<!-- Mirrored from laravelecommerceexample.ca/ by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 27 Jun 2020 21:16:06 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<!-- /Added by HTTrack -->

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>Laravel Ecommerce Example</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat%7CRoboto:300,400,700" rel="stylesheet" />
    <link rel="stylesheet" href="../maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('/assets/css/app.css') }}" />
    <link rel="stylesheet" href="{{ asset('/assets/css/responsive.css') }}" />
</head>

<body>
    <div id="app">
        <header class="with-background">
            <div class="top-nav container">
                <div class="top-nav-left">
                    <div class="logo">Ecommerce</div>
                    <ul>
                        <li>
                            <a href="{{ url('shop') }}">
                                    Shop
                                </a>
                        </li>
                        <li>
                            <a href="#">
                                    About
                                </a>
                        </li>
                        <li>
                            <a href="https://blog.laravelecommerceexample.ca/">
                                    Blog
                                </a>
                        </li>
                    </ul>
                </div>
                <div class="top-nav-right">
                    <ul>
                        <li><a href="register.html">Sign Up</a></li>
                        <li><a href="login.html">Login</a></li>
                        <li><a href="{{ url('cart') }}">Cart </a></li>
                    </ul>
                </div>
            </div>
            <!-- end top-nav -->
            <div class="hero container">
                <div class="hero-copy">
                    <h1>Laravel Ecommerce Demo</h1>
                    <p>
                        Includes multiple products, categories, a shopping cart and a checkout system with Stripe integration.
                    </p>
                    <div class="hero-buttons">
                        <a href="https://www.youtube.com/playlist?list=PLEhEHUEU3x5oPTli631ZX9cxl6cU_sDaR" class="button button-white">Screencasts</a
                            >
                            <a
                                href="https://github.com/drehimself/laravel-ecommerce-example"
                                class="button button-white"
                                >GitHub</a
                            >
                        </div>
                    </div>
                    <!-- end hero-copy -->

                    <div class="hero-image">
                        <img
                            src="{{ asset('/assets/img/macbook-pro-laravel.png')}}"
                            alt="hero image"
                        />
                    </div>
                    <!-- end hero-image -->
                </div>
                <!-- end hero -->
            </header>

            <div class="featured-section">
                <div class="container">
                    <h1 class="text-center">Laravel Ecommerce</h1>

                    <p class="section-description">
                        Lorem ipsum dolor sit amet, consectetur adipisicing
                        elit. Dolore vitae nisi, consequuntur illum dolores
                        cumque pariatur quis provident deleniti nesciunt officia
                        est reprehenderit sunt aliquid possimus temporibus enim
                        eum hic lorem.
                    </p>

                    <div class="text-center button-container">
                        <a href="#" class="button">Featured</a>
                        <a href="#" class="button">On Sale</a>
                    </div>

                    <div class="products text-center">
                        <div class="product">
                            <a href="shop/laptop-22.html"><img src="storage/products/dummy/laptop-22.jpg" alt="product" /></a>
                            <a href="shop/laptop-22.html">
                                <div class="product-name">Laptop 22</div>
                            </a>
                            <div class="product-price">$2038.49</div>
                        </div>
                        <div class="product">
                            <a href="shop/phone-2.html"><img src="storage/products/dummy/phone-2.jpg" alt="product" /></a>
                            <a href="shop/phone-2.html">
                                <div class="product-name">Phone 2</div>
                            </a>
                            <div class="product-price">$1414.51</div>
                        </div>
                        <div class="product">
                            <a href="shop/appliance-5.html"><img src="storage/products/dummy/appliance-5.jpg" alt="product" /></a>
                            <a href="shop/appliance-5.html">
                                <div class="product-name">Appliance 5</div>
                            </a>
                            <div class="product-price">$826.55</div>
                        </div>
                        <div class="product">
                            <a href="shop/phone-4.html"><img src="storage/products/dummy/phone-4.jpg" alt="product" /></a>
                            <a href="shop/phone-4.html">
                                <div class="product-name">Phone 4</div>
                            </a>
                            <div class="product-price">$1235.07</div>
                        </div>
                        <div class="product">
                            <a href="shop/laptop-1.html"><img src="storage/products/dummy/laptop-1.jpg" alt="product" /></a>
                            <a href="shop/laptop-1.html">
                                <div class="product-name">Laptop 1</div>
                            </a>
                            <div class="product-price">$2106.84</div>
                        </div>
                        <div class="product">
                            <a href="shop/desktop-1.html"><img src="storage/products/dummy/desktop-1.jpg" alt="product" /></a>
                            <a href="shop/desktop-1.html">
                                <div class="product-name">Desktop 1</div>
                            </a>
                            <div class="product-price">$4401.87</div>
                        </div>
                        <div class="product">
                            <a href="shop/tablet-3.html"><img src="storage/products/dummy/tablet-3.jpg" alt="product" /></a>
                            <a href="shop/tablet-3.html">
                                <div class="product-name">Tablet 3</div>
                            </a>
                            <div class="product-price">$1425.89</div>
                        </div>
                        <div class="product">
                            <a href="shop/camera-3.html"><img src="storage/products/dummy/camera-3.jpg" alt="product" /></a>
                            <a href="shop/camera-3.html">
                                <div class="product-name">Camera 3</div>
                            </a>
                            <div class="product-price">$1834.99</div>
                        </div>
                    </div>
                    <!-- end products -->

                    <div class="text-center button-container">
                        <a href="shop.html" class="button">View more products</a
                        >
                    </div>
                </div>
                <!-- end container -->
            </div>
            <!-- end featured-section -->

            <blog-posts></blog-posts>

            <footer>
                <div class="footer-content container">
                    <div class="made-with">
                        Made with <i class="fa fa-heart heart"></i> by Andre
                        Madarang
                    </div>
                    <ul>
                        <li>Follow Me:</li>
                        <li>
                            <a href="#"><i class="fa Follow Me:"></i></a>
                        </li>
                        <li>
                            <a href="http://andremadarang.com/"><i class="fa fa-globe"></i
                            ></a>
                        </li>
                        <li>
                            <a href="http://youtube.com/drehimself"><i class="fa fa-youtube"></i
                            ></a>
                        </li>
                        <li>
                            <a href="http://github.com/drehimself"><i class="fa fa-github"></i
                            ></a>
                        </li>
                        <li>
                            <a href="http://twitter.com/drehimself"><i class="fa fa-twitter"></i
                            ></a>
                        </li>
                        </ul>
                    </div>
                    <!-- end footer-content -->
                    </footer>
                </div>
                <!-- end #app -->
                <script src="{{ asset('/assets/js/app.js')}}"></script>
</body>

<!-- Mirrored from laravelecommerceexample.ca/ by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 27 Jun 2020 21:16:24 GMT -->

</html>
