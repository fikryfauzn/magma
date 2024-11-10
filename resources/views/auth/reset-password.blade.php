@extends('layouts.app')

@push('styles')
    @vite(['resources/css/reset-password.css'])
@endpush

@section('content')
<div class="reset-section">
    <div class="reset-container">
        <h1>Reset Password</h1>

        @if($errors->any())
            <div class="error-messages">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('password.update') }}" method="POST" class="reset-form">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <input type="hidden" name="email" value="{{ $email }}">

            <div class="form-group">
                <input type="password" name="password" placeholder=" " required>
                <label for="password">New Password</label>
            </div>

            <div class="form-group">
                <input type="password" name="password_confirmation" placeholder=" " required>
                <label for="password_confirmation">Confirm Password</label>
            </div>

            <button type="submit" class="reset-button">Reset Password</button>
        </form>
    </div>
</div>
@endsection
