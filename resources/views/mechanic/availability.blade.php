@extends('layouts.app')

@section('content')
<div class="availability-section">
    <h1>Manage Availability</h1>

    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    @if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif

    @if ($bookings->count() > 0)
    <div class="bookings-list">
        @foreach ($bookings as $booking)
        <div class="booking-card">
            <p><strong>Booking ID:</strong> {{ $booking->booking_id }}</p>
            <p><strong>Service:</strong> {{ $booking->service->service_name }}</p>
            <p><strong>Customer:</strong> {{ $booking->customer->name }}</p>
            <p><strong>Date Requested:</strong> {{ $booking->date_requested }}</p>
            <p><strong>Status:</strong> {{ $booking->status }}</p>

            @if (is_null($booking->mechanic_id))
            <!-- Claim Booking -->
            <form action="{{ route('mechanic.claim', $booking->booking_id) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-primary">Claim Booking</button>
            </form>
            @else
            <!-- Update Schedule -->
            <form action="{{ route('mechanic.updateSchedule', $booking->booking_id) }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="schedule_date_{{ $booking->booking_id }}">Schedule Date</label>
                    <input type="date" name="schedule_date" id="schedule_date_{{ $booking->booking_id }}" required>
                </div>
                <button type="submit" class="btn btn-primary">Update Schedule</button>
            </form>
            @endif
        </div>
        @endforeach
    </div>
    @else
    <p>No pending bookings available.</p>
    @endif
</div>
@endsection
