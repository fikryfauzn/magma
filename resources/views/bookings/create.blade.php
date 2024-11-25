@extends('layouts.app')

@push('styles')
    @vite(['resources/css/bookings-create.css'])
@endpush

@section('content')
<div class="booking-section">
    <h1>Request a Service</h1>

    <form action="{{ route('bookings.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="service_id">Select a Service</label>
            <select name="service_id" id="service_id" class="form-control" required>
                @foreach ($services as $service)
                    <option value="{{ $service->service_id }}">{{ $service->service_name }} - ${{ $service->price }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="date_requested">Request Date and Time</label>
            <input type="datetime-local" name="date_requested" id="date_requested" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Request Booking</button>
    </form>
</div>
@endsection
