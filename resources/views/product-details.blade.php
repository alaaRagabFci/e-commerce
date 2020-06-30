@extends('partials.layouts')
@section('title', $product->name)
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
            <div class="aa-input-container" id="aa-input-container">
                <input type="search" id="aa-search-input" class="aa-input-search" placeholder="Search with algolia..." name="search" autocomplete="off" />
                <svg class="aa-input-icon" viewBox="654 -372 1664 1664">
                    <path
                        d="M1806,332c0-123.3-43.8-228.8-131.5-316.5C1586.8-72.2,1481.3-116,1358-116s-228.8,43.8-316.5,131.5  C953.8,103.2,910,208.7,910,332s43.8,228.8,131.5,316.5C1129.2,736.2,1234.7,780,1358,780s228.8-43.8,316.5-131.5  C1762.2,560.8,1806,455.3,1806,332z M2318,1164c0,34.7-12.7,64.7-38,90s-55.3,38-90,38c-36,0-66-12.7-90-38l-343-342  c-119.3,82.7-252.3,124-399,124c-95.3,0-186.5-18.5-273.5-55.5s-162-87-225-150s-113-138-150-225S654,427.3,654,332  s18.5-186.5,55.5-273.5s87-162,150-225s138-113,225-150S1262.7-372,1358-372s186.5,18.5,273.5,55.5s162,87,225,150s113,138,150,225  S2062,236.7,2062,332c0,146.7-41.3,279.7-124,399l343,343C2305.7,1098.7,2318,1128.7,2318,1164z"
                    />
                </svg>
            </div>

            <form action="https://laravelecommerceexample.ca/search" method="GET" class="search-form">
                <i class="fa fa-search search-icon"></i>
                <input type="text" name="query" id="query" value="" class="search-box" placeholder="Search for product" required />
            </form>
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
@endsection
