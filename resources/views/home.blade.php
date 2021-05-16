@extends('layouts.app')

@section('content')
<div class="container text-center">
{{--    <div class="row justify-content-center">--}}
{{--        <div class="col-md-8">--}}
{{--            <div class="card">--}}
{{--                <div class="card-header">{{ __('Dashboard') }}</div>--}}

{{--                <div class="card-body">--}}
{{--                    @if (session('status'))--}}
{{--                        <div class="alert alert-success" role="alert">--}}
{{--                            {{ session('status') }}--}}
{{--                        </div>--}}
{{--                    @endif--}}

{{--                    {{ __('You are logged in!') }}--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

    <h2>Products</h2>

    @if (Session::has('msg'))
            <div class="alert alert-success" role="alert">
                {{ Session::get('msg') }}
            </div>      
        @endif

    <div class="row">

        @foreach($allProducts as $product)
            <div class="col-lg-4 col-md-6 mb-3">
                <div class="card">
                    <img class="card-img-top" src="{{ asset('default-product.jpg') }}" alt="Card image cap">
                    <div class="card-body">
                        <h4 class="card-title">{{ $product->name }}</h4>
                        <p class="card-text">{{ $product->description }}</p>
                        <hr>
                        <strong><p class="card-text text-success">{{ $product->price }} $</p></strong>
                    </div>
                    <div class="card-body">
                        <a href="{{ route('cart.add', $product->id) }}" class="card-link btn btn-primary btn-sm">Add to cart</a>
                    </div>
                </div>
            </div>
        @endforeach

    </div>
</div>
@endsection
