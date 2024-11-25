@extends('layouts.app')

@push('styles')
    @vite(['resources/css/service-details.css'])
@endpush

@section('content')
<div class="service-details-section">
    <h1>{{ $service->service_name }}</h1>

    <p><strong>Description:</strong> {{ $service->description }}</p>
    <p><strong>Price:</strong> ${{ $service->price }}</p>

    <a href="{{ route('bookings.create') }}" class="btn btn-primary">Book This Service</a>
</div>
@endsection
