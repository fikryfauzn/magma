@extends('layouts.app')

@push('styles')
    @vite(['resources/css/bookings.css'])
@endpush


@section('content')
<div class="bookings-section">
    <h1>Your Bookings</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($bookings->count() > 0)
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Booking ID</th>
                    <th>Service</th>
                    <th>Date Requested</th>
                    <th>Date Scheduled</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bookings as $booking)
                <tr>
                    <td>{{ $booking->booking_id }}</td>
                    <td>{{ $booking->service->service_name }}</td>
                    <td>{{ $booking->date_requested }}</td>
                    <td>{{ $booking->date_scheduled }}</td>
                    <td>{{ $booking->status }}</td>
                    <td>
                        <a href="{{ route('bookings.show', $booking->booking_id) }}" class="btn btn-info">Details</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>You have no bookings yet.</p>
    @endif
</div>
@endsection
