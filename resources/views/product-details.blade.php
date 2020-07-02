@extends('partials.layouts')
@section('title', $product->name)
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
            <span><a href="{{ url('/shop') }}">Shop</a></span>
            <i class="fa fa-chevron-right breadcrumb-separator"></i>
            <span>{{ $product->name }}</span>
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
<div class="container">

</div>

<div class="product-section container">
     <div>
        <div class="product-section-image">
            <img src="{{ checkFileExist($product->image) }}" alt="product" class="active" id="currentImage">
        </div>
        <div class="product-section-images">
            <div class="product-section-thumbnail selected">
                <img src="{{ checkFileExist($product->image) }}" alt="product">
            </div>
            @if($product->images)
                @foreach (json_decode($product->images, true) as $image)
                    <div class="product-section-thumbnail">
                        <img src="{{ checkFileExist($image) }}" alt="product">
                    </div>
                @endforeach
            @endif
        </div>
    </div>
    <div class="product-section-information">
        <h1 class="product-section-title">{{ $product->name }}</h1>
        <div class="product-section-subtitle">{{ $product->details }}</div>
        <div>
            <div class="badge badge-success">In Stock</div>
        </div>
        <div class="product-section-price">{{ changePriceFormat($product->price) }}</div>

        <p>
            {{ $product->description }}
        </p>

        <p>&nbsp;</p>

        <form action="{{ url('add-to-cart') }}" method="POST">
            @csrf
            <input type="hidden" name="id" value="{{ $product->id }}">
            <input type="hidden" name="price" value="{{ $product->price }}">
            <input type="hidden" name="name" value="{{ $product->name }}">
            <button type="submit" class="button button-plain">Add to Cart</button>
        </form>
    </div>
</div>
<!-- end product-section -->
@include('partials.might-also-like')
@endsection
@section('extra-js')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document.body).on('click', '.product-section-thumbnail', function(e) {
        $(this).addClass("selected");
        $('.product-section-thumbnail').not(this).removeClass('selected');
        var selectedImageSrc = $(this).children("img").attr("src");
        $('.product-section-image').children("img").attr("src", selectedImageSrc);
    });
</script>
    <!-- Include AlgoliaSearch JS Client and autocomplete.js library -->
    <script src="https://cdn.jsdelivr.net/algoliasearch/3/algoliasearch.min.js"></script>
    <script src="https://cdn.jsdelivr.net/autocomplete.js/0/autocomplete.min.js"></script>
    <script src="{{ asset('/assets/js/algolia.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/instantsearch.js@2.6.0"></script>
    <script src="{{ asset('assets/js/algolia-instantsearch.js') }}"></script>
@endsection
