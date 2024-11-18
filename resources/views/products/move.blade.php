@extends('layouts.app')

@push('styles')
    @vite(['resources/css/coming_soon.css'])
@endpush

@section('content')
<div class="coming-soon-section">
    <h1>COMING SOON</h1>
</div>
@endsection

@push('scripts')
<script>
    // Optional JavaScript for animations if needed
</script>
@endpush
