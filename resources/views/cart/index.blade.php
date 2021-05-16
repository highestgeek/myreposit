@extends('layouts.app')

@section('content')
    <h2>Cart Page</h2>
        <div class="card mb-3">
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cartItems as $item)
                            <tr>
                                <td scope="row">{{ $item->name }}</td>
                                <td>
                                    {{ Cart::session(auth()->id())->get($item->id)->getPriceSum() }}
                                </td>
                                <td>
                                    <form action="{{ route('cart.update', $item->id) }}">
                                        <input name="quantity" type="number" value="{{ $item->quantity }}">
        
                                        <input type="submit" value="save quantity">
                                    </form>
                                </td>
                                <td>
                                    <a href="{{ route('cart.destroy', $item->id) }}" class="btn btn-danger btn-sm">Delete</a>
                                </td>
                            </tr>
                        @endforeach            
                    </tbody>
                </table>
            </div>
        </div>

        <h3>
            Total Price: $ <strong class="text-success">{{ Cart::session(auth()->id())->getTotal() }}</strong>
        </h3>

        <hr>

        <a class="btn btn-primary" href="{{ route('cart.checkout') }}" role="button">Checkout</a>

        @if (Session::has('msg'))
            <hr>
            <div class="alert alert-success" role="alert">
                {{ Session::get('msg') }}
            </div>      
        @endif

@endsection