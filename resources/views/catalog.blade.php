@extends('layouts.app')

@push('styles')
    @vite(['resources/css/catalog.css']) <!-- Load catalog-specific CSS with Vite -->
@endpush

@section('content')
    <!-- Inline background-image using asset helper -->
    <div class="catalog-screen" id="catalog-screen" style="background-image: url('{{ asset('images/farm.jpg') }}');">
        <h1>CATALOG</h1>
    </div>

    <div class="product-grid">
        @foreach($products as $product)
            <a href="{{ route('products.show', ['slug' => $product->slug]) }}" class="product-card" style="text-decoration: none;">
                <h2>{{ $product->name }}</h2>
                <div class="price-tag">${{ number_format($product->price, 2) }}</div>
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
            </a>
        @endforeach
    </div>
@endsection
