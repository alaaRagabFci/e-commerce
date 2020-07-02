@extends('partials.layouts')
@section('title', 'Shop')
@section('styles')
    <link rel="stylesheet" href="{{ asset('/assets/css/algolia.css')}}" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/instantsearch.js@2.6.0/dist/instantsearch.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/instantsearch.js@2.6.0/dist/instantsearch-theme-algolia.min.css">
@endsection
@section('content')
<div class="breadcrumbs">
    <div class="breadcrumbs-container container">
        <div>
            <a href="{{ url('/') }}">Home</a>
            <i class="fa fa-chevron-right breadcrumb-separator"></i>
            <span>Shop</span>
        </div>
        <div>
            @include('partials.search-input')

            {{-- <form action="https://laravelecommerceexample.ca/search" method="GET" class="search-form">
                <i class="fa fa-search search-icon"></i>
                <input type="text" name="query" id="query" value="" class="search-box" placeholder="Search for product" required />
            </form> --}}
        </div>
    </div>
</div>
<!-- end breadcrumbs -->
<div class="container"></div>

<div class="products-section container">
    <div class="sidebar">
        <h3>By Category</h3>
        <ul>
            @foreach ($categories as $category)
                <li class="{{ $category->slug == request()->category ? 'active' : '' }}">
                    <a href="{{ url('/shop?category='.$category->slug) }}">{{ $category->name }}</a>
                </li>
            @endforeach
        </ul>
    </div>
    <!-- end sidebar -->
    <div>
        <div class="products-header">
            <h1 class="stylish-heading">{{ $categoryName }}</h1>
            <div>
                <strong>Price: </strong>
                <a href="{{ url('/shop?category='.request()->category.'&sort=asc') }}">Low to High</a> |
                <a href="{{ url('/shop?category='.request()->category.'&sort=desc') }}">High to Low</a>
            </div>
        </div>

        <div class="products text-center">
            @forelse ($products as $product)
                <div class="product">
                    <a href="{{ url('/product-details', $product->slug) }}"
                        ><img
                            src="{{ checkFileExist($product->image) }}"
                            alt="product"
                    /></a>
                    <a href="{{ url('/product-details', $product->slug) }}"
                        ><div class="product-name">{{ $product->name }}</div></a
                    >
                    <div class="product-price">{{ changePriceFormat($product->price) }}</div>
                </div>
            @empty
            <div>No items found!</div>
            @endforelse
        </div>
        <!-- end products -->

        <div class="spacer"></div>
        <nav>
            {{ $products->appends(request()->input())->links() }}
        </nav>
    </div>
</div>
@endsection
@section('extra-js')
    <!-- Include AlgoliaSearch JS Client and autocomplete.js library -->
    <script src="https://cdn.jsdelivr.net/algoliasearch/3/algoliasearch.min.js"></script>
    <script src="https://cdn.jsdelivr.net/autocomplete.js/0/autocomplete.min.js"></script>
    <script src="{{ asset('/assets/js/algolia.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/instantsearch.js@2.6.0"></script>
    <script src="{{ asset('assets/js/algolia-instantsearch.js') }}"></script>
@endsection
