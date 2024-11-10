@extends('layouts.app')

@push('styles')
    @vite(['resources/css/register.css'])
@endpush

@section('content')
<div class="register-section">
    <div class="register-container">
        <h1>REGISTER</h1>

        @if($errors->any())
            <div class="error-messages">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ url('/register') }}" method="POST" class="register-form">
            @csrf
            <div class="form-group">
                <input type="text" name="username" placeholder=" " required>
                <label for="username">Username</label>
            </div>

            <div class="form-group">
                <input type="email" name="email" placeholder=" " required>
                <label for="email">Email</label>
            </div>

            <div class="form-group">
                <input type="password" name="password" placeholder=" " required>
                <label for="password">Password</label>
            </div>

            <div class="form-group">
                <input type="password" name="password_confirmation" placeholder=" " required>
                <label for="password_confirmation">Confirm Password</label>
            </div>

            <button type="submit" class="register-button">REGISTER</button>
        </form>
        <div class="links">
            <a href="{{ route('password.request') }}">FORGOT YOUR PASSWORD?</a>
        </div>
    </div>
</div>
@endsection
