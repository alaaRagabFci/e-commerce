@extends('partials.layouts')
@section('title', 'MyOrders')
@section('styles')
    <link rel="stylesheet" href="{{ asset('/assets/css/algolia.css')}}" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/instantsearch.js@2.6.0/dist/instantsearch.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/instantsearch.js@2.6.0/dist/instantsearch-theme-algolia.min.css">
    <style>
        .collapsible {
          background-color: #535353;
          color: white;
          cursor: pointer;
          padding: 18px;
          width: 100%;
          border: none;
          text-align: left;
          outline: none;
          font-size: 15px;
        }

        button.active, .collapsible:hover {
          background-color: #777;
        }

        .content {
          padding: 0 18px;
          display: none;
          overflow: hidden;
          background-color: #777;
        }
        button.accordion:after {
    content: '\002B';
    color: white;
    font-weight: bold;
    float: right;
    margin-left: 5px;
}
        </style>
@endsection
@section('content')

    <div class="breadcrumbs">
    <div class="breadcrumbs-container container">
        <div>
            <a href="{{ url('/') }}">Home</a>
        <i class="fa fa-chevron-right breadcrumb-separator"></i>
        <span>My Orders</span>
        </div>
        <div>
            @include('partials.search-input')
        </div>
    </div>
</div> <!-- end breadcrumbs -->

    <div class="container">

            </div>

    <div class="products-section my-orders container">
        <div class="sidebar">

            <ul>
              <li><a href="{{ url('my-account') }}">My Account</a></li>
              <li class="active">My Orders</></li>
            </ul>
        </div> <!-- end sidebar -->
        <div class="my-profile">
            <div class="products-header">
                <h1 class="stylish-heading">My Orders</h1>
            </div>
@forelse ($orders as $order)
<button type="button" class="collapsible accordion">Order # {{ $order->id }}
    <span style="margin-left: 18px;"">Total {{changePriceFormat($order->billing_total) }}</span>
    <span style="margin-left: 18px;"">placed at {{ date('d-m-Y', strtotime($order->created_at)) }}</span>
</button>
<div class="content">
    <div class="order-products">
        @foreach ($order->products as $product)
        <div class="order-product-item">
            <div><img src="{{ checkFileExist($product->image) }}" alt="Product Image"></div>
            <div>
                <div>
                    <a href="{{ url('product-details', $product->slug) }}">{{ $product->name }}</a>
                </div>
                <div>
                    {{changePriceFormat($product->price) }}
                </div>
                <div>
                    Quantity: {{ $product->pivot->quantity }}
                </div>
            </div>
        </div>
        @endforeach

</div>
    <div class="order-products">
        <table class="table" style="width:50%">
            <tbody>
                <tr>
                    <td>Name</td>
                    <td>{{ $order->billing_name }}</td>
                </tr>
                <tr>
                    <td>Address</td>
                    <td>{{ $order->billing_address }}</td>
                </tr>
                <tr>
                    <td>City</td>
                    <td>{{ $order->billing_city }}</td>
                </tr>
                <tr>
                    <td>Subtotal</td>
                    <td>{{ changePriceFormat($order->billing_subtotal) }}</td>
                </tr>
                <tr>
                    <td>Tax</td>
                    <td>{{ changePriceFormat($order->billing_tax) }}</td>
                </tr>
                <tr>
                    <td>Total</td>
                    <td>{{ changePriceFormat($order->billing_total) }}</td>
                </tr>
            </tbody>
        </table>

    </div>
</div>
@empty
<h2>No orders</h2>
@endforelse
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
    <script>
        var coll = document.getElementsByClassName("collapsible");
        var i;

        for (i = 0; i < coll.length; i++) {
          coll[i].addEventListener("click", function() {
            this.classList.toggle("active");
            $('.collapsible').not(this).removeClass('active');
            $('.content').css('display','none');
            var content = this.nextElementSibling;
            if ($(this).hasClass("active")) {
              content.style.display = "block";
            } else {
              content.style.display = "none";
            }
          });
        }
        </script>
@endsection
