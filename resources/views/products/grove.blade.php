@extends('layouts.app')

@push('styles')
@vite(['resources/css/grove.css'])
@endpush

@section('content')
<div class="product-section">
    <div class="product-header">
        <img src="{{ asset('images/ProductB.png') }}" alt="Grove Robot" class="product-image">
        <div class="product-info">
            <h1>Outwork, Outgrow, Outshine Without Lifting a Finger!</h1>
            <form action="{{ route('cart.store') }}" method="POST">
                @csrf
                <input type="hidden" name="product_id" value="2"> <!-- Directly set product_id to 2 -->
                <input type="hidden" name="quantity" value="1">
                <button type="submit" class="btn btn-primary order-button">Order Grove - $1,499</button>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Optional JavaScript for interactivity can be added here if needed
    });
</script>
@endpush