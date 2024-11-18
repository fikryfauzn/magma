@extends('layouts.app')

@push('styles')
@vite(['resources/css/coming_soon.css'])
@endpush

@section('content')
<div class="product-details-section">
    <h1>{{ $product->name }}</h1>
    <p>{{ $product->description }}</p>
    <p>Price: ${{ number_format($product->price, 2) }}</p>
</div>
@endsection
