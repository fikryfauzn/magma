@extends('layouts.app')

@push('styles')
@vite(['resources/css/profile.css'])
@endpush

@section('content')
<div class="profile-section">

    <!-- Display Alert Messages for Success or Errors -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Welcome Message -->
    <h1 id="welcome-message">Welcome, {{ Auth::user()->username }}!</h1>

    <!-- Buttons for Edit Profile and Change Password -->
    <div class="buttons" id="button-section">
        <div class="button-container">
            <button id="edit-profile-button" class="toggle-button">Edit Profile</button>
        </div>
        <div class="separator">&#8205;</div>
        <div class="button-container">
            <button id="change-password-button" class="toggle-button">Change Password</button>
        </div>
    </div>

    <!-- Edit Profile Form (hidden by default) -->
    <div id="edit-profile-form" class="form-section" style="display: none;">
        <form action="{{ route('profile.updateProfile') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" id="name" name="name" value="{{ old('name', Auth::user()->name) }}" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email', Auth::user()->email) }}" required>
            </div>

            <div class="form-group">
                <label for="telephone_number">Phone Number</label>
                <input type="text" id="telephone_number" name="telephone_number" value="{{ old('telephone_number', Auth::user()->telephone_number) }}" required>
            </div>

            <div class="form-group">
                <label for="location">Location</label>
                <input type="text" id="location" name="location" value="{{ old('location', Auth::user()->location) }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Save Profile Changes</button>
            <button type="button" id="back-profile-button" class="btn btn-secondary">Back</button>
        </form>
    </div>

    <!-- Change Password Form (hidden by default) -->
    <div id="change-password-form" class="form-section" style="display: none;">
        <form action="{{ route('profile.updatePassword') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="current_password">Current Password</label>
                <input type="password" id="current_password" name="current_password" required>
            </div>

            <div class="form-group">
                <label for="new_password">New Password</label>
                <input type="password" id="new_password" name="new_password" required>
            </div>

            <div class="form-group">
                <label for="new_password_confirmation">Confirm New Password</label>
                <input type="password" id="new_password_confirmation" name="new_password_confirmation" required>
            </div>

            <button type="submit" class="btn btn-primary">Change Password</button>
            <button type="button" id="back-password-button" class="btn btn-secondary">Back</button>
        </form>
    </div>
</div>
@endsection

@push('scripts')
    @vite(['resources/js/profile.js'])
@endpush
