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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('/assets/css/app.css') }}" />
    <link rel="stylesheet" href="{{ asset('/assets/css/responsive.css') }}" />
    <style>
        .dropbtn {
          color: white;
          padding: 16px;
          font-size: 16px;
          border: none;
        }

        .dropdown {
          position: relative;
          display: inline-block;
        }

        .dropdown-content {
          display: none;
          position: absolute;
          background-color: #555555;
          min-width: 160px;
          box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
          z-index: 1;
        }

        .dropdown-content a {
          color: black;
          padding: 12px 16px;
          text-decoration: none;
          display: block;
          font-size: 12px;
        }

        .dropdown-content a:hover {background-color: ##59595;}

        .dropdown:hover .dropdown-content {display: block;}

        </style>
</head>

<body>
    <div id="app">
        <header class="with-background">
            <div class="top-nav container">
                <div class="top-nav-left">
                    <div class="logo">Ecommerce</div>
                    <ul>
                        <li><a href="{{ url('shop') }}">Shop</a></li>
                        <li><a href="{{ url('cart') }}">Cart
                            @if ($cartCount)
                                <span class="cart-count"><span>{{ $cartCount }}</span></span>
                            @endif
                        </a></li>
                    </ul>
                </div>
                <div class="top-nav-right">
                    <ul>
                        @guest
                        <li><a href="{{ route('register') }}">Sign Up</a></li>
                        <li><a href="{{ route('login') }}">Login</a></li>
                        @else
                        <div class="dropdown">
                            <span class="dropbtn">Welcome,  {{ auth()->user()->name }}</span>
                            <div class="dropdown-content">
                              <a href="{{ url('my-account',  auth()->user()->id) }}">My Account</a>
                              <a href="{{ url('my-orders',  auth()->user()->id) }}">My Orders</a>
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                              document.getElementById('logout-form').submit();">
                                 {{ __('Logout') }}
                            </a>
                            </div>
                          </div>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                        @endguest
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
                        {{-- <a href="{{ url('') }}" class="button button-white">Screencasts</a
                            > --}}
                            <a
                                href="{{ url('shop') }}"
                                class="button button-white"
                                >Let's start</a
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
                        @foreach ($products as $product)
                            <div class="product">
                                <a href="{{ url('/product-details', $product->slug) }}">
                                    <img src="{{ checkFileExist($product->image) }}" alt="product" /></a>
                                <a href="{{ url('/product-details', $product->slug) }}">
                                    <div class="product-name">{{ $product->name }}</div>
                                </a>
                                <div class="product-price">{{ changePriceFormat($product->price) }}</div>
                            </div>
                        @endforeach
                    </div>
                    <!-- end products -->

                    <div class="text-center button-container">
                        <a href="{{ url('shop') }}" class="button">View more products</a
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
                        Made with <i class="fa fa-heart heart"></i> by Alaa Ragab
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
