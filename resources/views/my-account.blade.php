@extends('partials.layouts')
@section('title', 'MyAccount')
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
        <span>My Profile</span>
        </div>
        <div>
            @include('partials.search-input')

        </div>
    </div>
</div> <!-- end breadcrumbs -->

    <div class="container">

            </div>

    <div class="products-section container">
        <div class="sidebar">

            <ul>
              <li class="active">My Account</li>
              <li><a href="{{ url('my-orders') }}">My Orders</a></li>
            </ul>
        </div> <!-- end sidebar -->
        <div class="my-profile">
            <div class="products-header">
                <h1 class="stylish-heading">My Profile</h1>
            </div>
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
            <div>
                <form action="{{ url('updateMyAccount') }}" method="POST">
                    @csrf
                    @method('patch')
                    <div class="form-control">
                    <input id="name" type="text" name="name" value="{{ old('name', auth()->user()->name) }}" placeholder="Name" required>
                    </div>
                    <div class="form-control">
                        <input id="email" type="email" name="email" value="{{ old('name', auth()->user()->email) }}" placeholder="Email" required>
                    </div>
                    <div class="form-control">
                        <input id="password" type="password" name="password" placeholder="Password">
                        <div>Leave password blank to keep current password</div>
                    </div>
                    <div class="form-control">
                        <input id="password-confirm" type="password" name="password_confirmation" placeholder="Confirm Password">
                    </div>
                    <div>
                        <button type="submit" class="my-profile-button">Update Profile</button>
                    </div>
                </form>
            </div>

            <div class="spacer"></div>
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
