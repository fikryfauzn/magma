<form action="{{ route('admin.service_booking.update', $booking->booking_service_id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label for="service_id">Service</label>
        <select name="service_id" id="service_id" class="form-control">
            @foreach ($services as $service)
                <option value="{{ $service->service_id }}" {{ $service->service_id == $booking->service_id ? 'selected' : '' }}>
                    {{ $service->service_name }}
                </option>
            @endforeach
        </select>
        @error('service_id')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="date_scheduled">Scheduled Date</label>
        <input type="date" name="date_scheduled" id="date_scheduled" class="form-control" value="{{ old('date_scheduled', $booking->date_scheduled) }}">
        @error('date_scheduled')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="status">Status</label>
        <select name="status" id="status" class="form-control">
            <option value="pending" {{ $booking->status == 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="confirmed" {{ $booking->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
            <option value="completed" {{ $booking->status == 'completed' ? 'selected' : '' }}>Completed</option>
        </select>
        @error('status')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">Update Booking</button>
</form>
