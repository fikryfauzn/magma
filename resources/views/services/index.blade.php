@extends('layouts.app')

@push('styles')
    @vite(['resources/css/service-index.css'])
@endpush

@section('content')
<div class="services-section">
    <h1>Available Services</h1>

    @if ($services->count() > 0)
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Service Name</th>
                    <th>Description</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($services as $service)
                <tr>
                    <td>
                        <a href="{{ route('services.show', $service->service_id) }}" class="service-link">
                            {{ $service->service_name }}
                        </a>
                    </td>
                    <td>{{ $service->description }}</td>
                    <td>${{ $service->price }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No services are currently available.</p>
    @endif
</div>
@endsection
