@extends('layouts.app')

@push('styles')
    @vite(['resources/css/checkout.css'])
@endpush

@section('content')
<div class="checkout-section">
    <h1>Checkout</h1>

    <form action="{{ route('checkout.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="address">Shipping Address</label>
            <textarea id="address" name="address" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Continue to Payment</button>
    </form>
</div>
@endsection
