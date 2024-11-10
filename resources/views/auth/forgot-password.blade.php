@extends('layouts.app')

@push('styles')
    @vite(['resources/css/forgot-password.css'])
@endpush

@section('content')
<div class="forgot-section">
    <div class="forgot-container">
        <h1>FORGOT PASSWORD</h1>

        @if (session('status'))
            <div class="status-message">{{ session('status') }}</div>
        @endif

        @if($errors->any())
            <div class="error-messages">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('password.email') }}" method="POST" class="forgot-form">
            @csrf
            <div class="form-group">
                <input type="email" name="email" placeholder=" " required>
                <label for="email">Email</label>
            </div>

            <button type="submit" class="forgot-button">Send Reset Link</button>
        </form>
    </div>
</div>
@endsection
