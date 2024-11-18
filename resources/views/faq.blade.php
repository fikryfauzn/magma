<!-- resources/views/faq.blade.php -->

@extends('layouts.app')

@push('styles')
    <style>
        .faq-section {
            display: flex;
            margin-top: 125px;
            flex-direction: column;
            align-items: center;
            padding: 50px;
            text-align: left;
        }

        .faq-content {
            max-width: 800px;
            font-size: 18px;
            line-height: 1.6;
            color: #333;
        }

        .faq-content h2 {
            font-size: 32px;
            margin-bottom: 20px;
            color: #212121;
            text-align: center;
        }

        .faq-item {
            margin-bottom: 30px;
        }

        .faq-item h3 {
            font-size: 20px;
            font-weight: 600;
            color: #333;
            margin-bottom: 10px;
        }

        .faq-item p {
            color: #555;
            font-size: 16px;
            margin-left: 10px;
        }
    </style>
@endpush

@section('content')
<div class="faq-section">
    <h2>Frequently Asked Questions</h2>
    <div class="faq-content">
        <div class="faq-item">
            <h3>What is AgriWheel?</h3>
            <p>AgriWheel is a company focused on creating Unmanned Ground Vehicles (UGVs) designed specifically for agricultural applications. Our vehicles aim to assist farmers by automating various farming tasks to improve productivity and efficiency.</p>
        </div>

        <div class="faq-item">
            <h3>What are UGVs, and how do they benefit agriculture?</h3>
            <p>UGVs, or Unmanned Ground Vehicles, are autonomous vehicles that operate on the ground without direct human intervention. In agriculture, UGVs can perform tasks such as planting, monitoring, soil analysis, and harvesting, helping reduce labor and optimize resource use.</p>
        </div>

        <div class="faq-item">
            <h3>What tasks can AgriWheel's UGVs perform?</h3>
            <p>Our UGVs are designed to handle a variety of agricultural tasks including soil preparation, planting, crop monitoring, precision spraying, and harvesting. They are highly versatile and can be customized to meet specific farming needs.</p>
        </div>

        <div class="faq-item">
            <h3>How do I purchase an AgriWheel UGV?</h3>
            <p>You can contact us directly via our <a href="{{ route('contact') }}">Contact</a> page. Our team will guide you through the available options and help you choose the UGV that best fits your requirements.</p>
        </div>

        <div class="faq-item">
            <h3>Does AgriWheel offer support and maintenance for their UGVs?</h3>
            <p>Yes, we provide comprehensive support and maintenance services for all our UGVs. Our support team is dedicated to ensuring your UGV operates efficiently and remains reliable throughout its lifespan.</p>
        </div>
    </div>
</div>
@endsection
