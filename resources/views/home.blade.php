@extends('layouts.app')

@push('styles')
    @vite(['resources/css/home.css'])
@endpush

@push('scripts')
    @vite(['resources/js/home.js'])
@endpush

@section('content')
<div class="container">
    <img src="{{ asset('images/Landing.png') }}" alt="Landing Image">
    <div class="content">
        <h1>GROVE</h1>
        <p>AgriWheel mendukung produktivitas pertanian dengan teknologi penggerak cerdas.</p>
        <a href="{{ route('products.show', ['slug' => 'grove']) }}" class="button">Explore</a>
    </div>
</div>

<div class="gallery">
    <div class="gallery-item">
        <img src="{{ asset('images/pic4.png') }}" alt="First Image">
        <div class="gallery-caption">Specially Designed For Dry Land</div>
    </div>
    <div class="gallery-item">
        <img src="{{ asset('images/pic3.png') }}" alt="Second Image">
        <div class="gallery-caption">Improve Efficiency and Productivity</div>
    </div>
</div>

<div class="quote-section">
    <p>Never calls in sick, never complains about the weather.</p>
</div>

<div class="video-section">
    <video autoplay muted loop>
        <source src="{{ asset('videos/grove.mp4') }}" type="video/mp4">
        Your browser does not support the video tag.
    </video>
</div>
@endsection
