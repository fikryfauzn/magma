@extends('layouts.app')

@push('styles')
    @vite(['resources/css/bookings-show.css'])
@endpush


@section('content')
<div class="booking-details-section">
    <h1>Booking Details</h1>

    <div class="booking-info">
        <p><strong>Booking ID:</strong> {{ $booking->booking_id }}</p>
        <p><strong>Service:</strong> {{ $booking->service->service_name }}</p>
        <p><strong>Date Requested:</strong> {{ $booking->date_requested }}</p>
        <p><strong>Date Scheduled:</strong> {{ $booking->date_scheduled }}</p>
        <p><strong>Status:</strong> {{ $booking->status }}</p>
    </div>
    <a href="{{ route('bookings.index') }}" class="btn btn-secondary">Back to Bookings</a>
</div>
@endsection
