@extends('partials.layouts')
@section('title', 'Search')
@section('styles')
<!-- Styles -->
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
        <span>Search</span>
        </div>
        <div>
            @include('partials.search-input')

{{-- <form action="https://laravelecommerceexample.ca/search" method="GET" class="search-form">
    <i class="fa fa-search search-icon"></i>
    <input type="text" name="query" id="query" value="" class="search-box" placeholder="Search for product" required>
</form> --}}
        </div>
    </div>
</div> <!-- end breadcrumbs -->

    <div class="container">

            </div>

    <div class="container">
        <div class="search-results-container-algolia">
            <div>
                <h2>Search</h2>
                <div id="search-box">
                    <!-- SearchBox widget will appear here -->
                </div>

                <div id="stats-container"></div>
            </div>

            <div>
                <div id="hits">
                    <!-- Hits widget will appear here -->
                </div>

                <div id="pagination">
                    <!-- Pagination widget will appear here -->
                </div>
            </div>
        </div> <!-- end search-results-container-algolia -->
    </div> <!-- end container -->
@endSection

@section('extra-js')
    <!-- Include AlgoliaSearch JS Client and autocomplete.js library -->
    <script src="https://cdn.jsdelivr.net/algoliasearch/3/algoliasearch.min.js"></script>
    <script src="https://cdn.jsdelivr.net/autocomplete.js/0/autocomplete.min.js"></script>
    <script src="{{ asset('/assets/js/algolia.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/instantsearch.js@2.6.0"></script>
    <script src="{{ asset('assets/js/algolia-instantsearch.js') }}"></script>
@endsection
