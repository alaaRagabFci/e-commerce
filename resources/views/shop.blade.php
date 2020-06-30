@extends('partials.layouts')
@section('title', 'Shop')
@section('content')
<div class="breadcrumbs">
    <div class="breadcrumbs-container container">
        <div>
            <a href="{{ url('/') }}">Home</a>
            <i class="fa fa-chevron-right breadcrumb-separator"></i>
            <span>Shop</span>
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
