@extends('layouts.app')

@push('styles')
@vite(['resources/css/guide.css'])
@endpush

@push('scripts')
@vite(['resources/js/guide.js'])
@endpush

@section('content')
<div class="guide-section">
    <h1 class="guide-title">Product Guide</h1>

    <!-- Move controls outside the guide-carousel -->
    <button class="carousel-control prev">❮</button>
    <div class="guide-carousel">
        <div class="carousel-container">
            @foreach ($products as $product)
            <div class="product-slide" data-product-id="{{ $product->id }}">
                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="product-image">
                <h2>{{ $product->name }}</h2>
                <p>{{ $product->description }}</p>
                @if ($product->brochure)
                <a href="{{ asset('storage/brochures/' . $product->brochure . '.pdf') }}" class="download-button" target="_blank">Download the brochure</a>
                @else
                <p>No brochure available</p>
                @endif


            </div>
            @endforeach
        </div>
    </div>
    <button class="carousel-control next">❯</button>
</div>
@endsection