@extends('layouts.app')

@section('content')
    <h2>Checkout Process</h2>
    <h3><small>Billing information</small></h3>

    <form action="{{ route('orders.store') }}" method="post">
        @csrf
        {{-- @include('_errors') --}}

        <div class="form-group">
            <label for="">Full Name</label>
            <input type="text" name="shipping_fullname" id="" class="form-control">
        </div>

        <div class="form-group">
            <label for="">State</label>
            <input type="text" name="shipping_state" id="" class="form-control">
        </div>

        <div class="form-group">
            <label for="">City</label>
            <input type="text" name="shipping_city" id="" class="form-control">
        </div>

        <div class="form-group">
            <label for="">Zip</label>
            <input type="number" name="shipping_zipcode" id="" class="form-control">
        </div>

        <div class="form-group">
            <label for="">Full Address</label>
            <input type="text" name="shipping_address" id="" class="form-control">
        </div>

        <div class="form-group">
            <label for="">Mobile</label>
            <input type="text" name="shipping_phone" id="" class="form-control">
        </div>

        <h4>Payment options</h4>

        <div class="form-check">
            <label class="form-check-label">
            <input type="radio" class="form-check-input" name="payment_method" id="" value="cash_on_delivery" checked>
            Cash on delivery
          </label>
        </div>
        <div class="form-check">
            <label class="form-check-label">
            <input type="radio" class="form-check-input" name="payment_method" id="" value="paypal">
            Pay with paypal
          </label>
        </div>
        <hr>
        <button type="submit" class="btn btn-primary">Place Order</button>

    </form>
@endsection