<!-- resources/views/contact.blade.php -->

@extends('layouts.app')

@push('styles')
    <style>
        .contact-section {
            display: flex;
            margin-top: 145px;
            flex-direction: column;
            align-items: center;
            padding: 50px;
            text-align: center;
        }

        .contact-details {
            max-width: 600px;
            font-size: 18px;
            line-height: 1.6;
            color: #333;
        }

        .contact-details h2 {
            font-size: 32px;
            margin-bottom: 20px;
            color: #212121;
        }

        .contact-info {
            margin: 20px 0;
        }

        .contact-info p {
            font-weight: 600;
            color: #555;
            margin: 10px 0;
        }

        .contact-info span {
            display: block;
            color: #212121;
        }
    </style>
@endpush

@section('content')
<div class="contact-section">
    <h2>Contact Us</h2>
    <div class="contact-details">
        <div class="contact-info">
            <p>Email:</p>
            <span>info@agriwheel.com</span>
        </div>
        <div class="contact-info">
            <p>Phone:</p>
            <span>+1 234 567 890</span>
        </div>
        <div class="contact-info">
            <p>Address:</p>
            <span>AgriWheel Inc.<br>3828 Piermont Dr NE<br>Albuquerque, NM 87111, USA</span>
        </div>
        <div class="contact-info">
            <p>Working Hours:</p>
            <span>Monday - Friday: 9:00 AM - 5:00 PM (MST)</span>
        </div>
    </div>
</div>
@endsection
