@extends('layouts.app')

@push('styles')
    @vite(['resources/css/login.css'])
@endpush

@section('content')
<div class="login-section">
    <div class="login-container">
        <h1>SIGN IN</h1>

        <!-- Status message for successful actions, like password reset email sent -->
        @if (session('status'))
            <div class="status-message">{{ session('status') }}</div>
        @endif

        <!-- Display errors if any -->
        @if($errors->any())
            <div class="error-messages">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ url('/login') }}" method="POST" class="login-form">
            @csrf
            <div class="form-group">
                <input type="text" name="login" placeholder=" " required>
                <label for="login">Email</label>
            </div>

            <div class="form-group">
                <input type="password" name="password" placeholder=" " required>
                <label for="password">Password</label>
            </div>

            <button type="submit" class="login-button">LOG IN</button>
        </form>

        <div class="links">
            <a href="{{ route('password.request') }}">FORGOT YOUR PASSWORD?</a>
        </div>
    </div>
</div>
@endsection
