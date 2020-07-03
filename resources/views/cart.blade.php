@extends('partials.layouts')
@section('title', 'Cart')
@section('styles')
    <link rel="stylesheet" href="{{ asset('/assets/css/algolia.css')}}" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/instantsearch.js@2.6.0/dist/instantsearch.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/instantsearch.js@2.6.0/dist/instantsearch-theme-algolia.min.css">
@endsection
<meta name="csrf-token" content="{{ csrf_token() }}">
@section('content')
<div class="breadcrumbs">
    <div class="breadcrumbs-container container">
        <div>
            <a href="{{ url('/') }}">Home</a>
            <i class="fa fa-chevron-right breadcrumb-separator"></i>
            <span>Shoping Cart</span>
        </div>
        @include('partials.search-input')
{{--
            <form
                action="https://laravelecommerceexample.ca/search"
                method="GET"
                class="search-form"
            >
                <i class="fa fa-search search-icon"></i>
                <input
                    type="text"
                    name="query"
                    id="query"
                    value=""
                    class="search-box"
                    placeholder="Search for product"
                    required
                />
            </form> --}}
        </div>
    </div>
</div>
<!-- end breadcrumbs -->
<div class="cart-section container">
    <div>
        @if (session()->has('success_message'))
        <div class="alert alert-success">
            {{ session()->get('success_message') }}
        </div>
        @endif
        @if(count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        @if ($cartCount)
        <h2>{{ $cartCount }} item(s) in Shopping Cart</h2>
        <div class="cart-table">
            @foreach ($carts as $item)
            <div class="cart-table-row">
                <div class="cart-table-row-left">
                    <a href="{{ url('/product-details', $item->model->slug) }}"><img
                            src="{{ checkFileExist($item->model->image) }}" alt="item" class="cart-table-img"/></a>
                    <div class="cart-item-details">
                        <div class="cart-table-item">
                            <a href="{{ url('/product-details', $item->model->slug) }}">{{ $item->model->name }}</a>
                        </div>
                        <div class="cart-table-description">
                            {{ $item->model->details }}
                        </div>
                    </div>
                </div>
                <div class="cart-table-row-right">
                    <div class="cart-table-actions">
                        <form action="{{ url('/removeCartItem',$item->rowId) }}" method="POST">
                            @csrf
                            {{ method_field('DELETE') }}
                            <button type="submit" class="cart-options">
                                Remove
                            </button>
                        </form>

                        <form action="{{ url('/saveForLater',$item->rowId) }}" method="POST">
                            @csrf
                            <button type="submit" class="cart-options">
                                Save for Later
                            </button>
                        </form>
                    </div>
                    <div>
                        <select class="quantity" data-id="{{ $item->rowId }}" data-quantity = "{{ $item->model->quantity }}">
                            @for ($i = 1; $i <= 5 ; $i++)
                            <option {{ $item->qty == $i ? 'selected' : '' }}>{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                    <div>{{ changePriceFormat($item->subtotal) }}</div>
                </div>
            </div>
            <!-- end cart-table-row -->
            @endforeach
        </div>
        <div class="cart-totals">
            <div class="cart-totals-left">
                Shipping is free because we’re awesome like that. Also because that’s additional stuff I don’t feel like figuring out :).
            </div>

            <div class="cart-totals-right">
                <div>
                    Subtotal <br>
                    @if(session()->has('coupon'))
                        Code({{ session()->get('coupon')['name'] }})
                        <form action="{{ url('/removeCoupon') }}" method="POST" style="display: inline">
                            @csrf
                            {{ method_field('DELETE') }}
                            <button type="submit"><i class="fa fa-window-close" aria-hidden="true"></i>
                            </button>
                        </form>
                        <br>
                        <hr>
                        New Subtotal
                        <br>
                    @endif
                    Tax ({{ config('cart.tax') }}%)<br>
                    <span class="cart-totals-total">Total</span>
                </div>
                <div class="cart-totals-subtotal">
                    {{ changePriceFormat(Cart::instance('default')->subtotal()) }} <br>
                    @if(session()->has('coupon'))
                        -{{ changePriceFormat($discount) }}
                        <br>
                        <hr>
                        {{ changePriceFormat($newSubtotal) }}
                        <br>
                    @endif
                    {{ changePriceFormat($newTax) }} <br>
                    <span class="cart-totals-total">{{ changePriceFormat($newTotal) }}</span>
                </div>
            </div>
        </div>
        @if(!session()->has('coupon'))
            <a href="#" class="have-code">Have a Code?</a>

            <div class="have-code-container">
                <form action="{{ url('/addCoupon') }}" method="POST">
                    @csrf
                    <input type="text" name="couponCode" id="coupon_code">
                    <button type="submit" class="button button-plain">Apply</button>
                </form>
            </div> <!-- end have-code-container -->
            <br>
        @endif


        <div class="cart-buttons">
            <a href="{{ url('shop') }}" class="button">Continue Shopping</a>
            <a href="{{ url('checkout') }}" class="button-primary">Proceed to Checkout</a>
        </div>
        @else
            <h3>No items in Cart!</h3>
            <div class="spacer"></div>
            <a href="{{ url('/shop') }}" class="button">Continue Shopping</a>
            <div class="spacer"></div>
        @endif

         @if($saveForLaterCount)
        <h2>{{ $saveForLaterCount }} item(s) Saved For Later</h2>
        <div class="saved-for-later cart-table">
            @foreach ($savedForLater as $item)
                <div class="cart-table-row">
                    <div class="cart-table-row-left">
                        <a href="{{ url('/product-details', $item->model->slug) }}">
                            <img src="{{ checkFileExist($item->model->image) }}" alt="item" class="cart-table-img"></a>
                        <div class="cart-item-details">
                            <div class="cart-table-item"><a href="{{ url('/product-details', $item->model->slug) }}">{{ $item->model->name }}</a></div>
                            <div class="cart-table-description">{{ $item->model->details }}</div>
                        </div>
                    </div>
                    <div class="cart-table-row-right">
                        <div class="cart-table-actions">
                            <form action="{{ url('/removeSaveForLaterItem',$item->rowId) }}" method="POST">
                                @csrf
                                {{ method_field('DELETE') }}

                                <button type="submit" class="cart-options">Remove</button>
                            </form>

                            <form action="{{ url('/moveToCart',$item->rowId) }}" method="POST">
                                @csrf
                                <button type="submit" class="cart-options">Move to Cart</button>
                            </form>
                        </div>

                        <div>{{ changePriceFormat($item->model->price) }}</div>
                    </div>
                </div> <!-- end cart-table-row -->
            @endforeach
        </div>
        @else
            <h3>You have no items Saved for Later.</h3>
        @endif
    </div>
</div>
<!-- end cart-section -->

@include('partials.might-also-like')
@endsection

@section('extra-js')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document.body).on('change', '.quantity', function(e) {
        const id = $(this).data("id");
        const numOfQuantity = $(this).data("quantity");
        $.ajax({
                url: "{{ url('updateQuantity') }}" + "/" + id ,
                type: "patch",
                headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                data: {
                    quantity: $(this).val(),
                    productQuantity: numOfQuantity,
                    },
                error: function(){
                    window.location.reload();
                },
                success: function(){
                    window.location.reload();
                }
        });
    });
</script>
    <!-- Include AlgoliaSearch JS Client and autocomplete.js library -->
    <script src="https://cdn.jsdelivr.net/algoliasearch/3/algoliasearch.min.js"></script>
    <script src="https://cdn.jsdelivr.net/autocomplete.js/0/autocomplete.min.js"></script>
    <script src="{{ asset('/assets/js/algolia.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/instantsearch.js@2.6.0"></script>
    <script src="{{ asset('assets/js/algolia-instantsearch.js') }}"></script>
@endsection
