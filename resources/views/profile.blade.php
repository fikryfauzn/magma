<!-- resources/views/profile.blade.php -->

@extends('layouts.app')

@push('styles')
@vite(['resources/css/profile.css'])
@endpush

@section('content')
<div class="profile-section">
    <h1>Welcome {{ Auth::user()->username }}!</h1>
</div>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endpush

@push('scripts')
    @vite(['resources/js/profile.js'])
@endpush

