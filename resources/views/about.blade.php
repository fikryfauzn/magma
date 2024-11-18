<!-- resources/views/about.blade.php -->

@extends('layouts.app')

@push('styles')
    <style>
        .about-section {
            display: flex;
            margin-top: 125px;
            flex-direction: column;
            align-items: center;
            padding: 50px;
            text-align: center;
        }

        .about-content {
            max-width: 800px;
            font-size: 18px;
            line-height: 1.8;
            color: #333;
        }

        .about-content h2 {
            font-size: 32px;
            margin-bottom: 20px;
            color: #212121;
        }

        .about-content p {
            margin-bottom: 20px;
            color: #555;
        }
    </style>
@endpush

@section('content')
<div class="about-section">
    <h2>About AgriWheel</h2>
    <div class="about-content">
        <p>AgriWheel is a pioneering company in the development and application of Unmanned Ground Vehicles (UGV) specifically designed for agriculture and farming industries. Our mission is to support and empower farmers by enhancing productivity, efficiency, and sustainability through the use of advanced robotics technology.</p>

        <p>With a focus on UGV technology, AgriWheel is dedicated to automating labor-intensive tasks and enabling precise, data-driven farming. Our autonomous ground vehicles are engineered to operate in diverse environments, making them versatile tools for a wide range of agricultural tasks, from soil preparation and planting to harvesting and maintenance.</p>

        <p>At AgriWheel, we believe in the power of technology to transform agriculture. By providing innovative solutions, we strive to help farmers increase yield, reduce environmental impact, and secure a sustainable future for agriculture. Join us in our journey to modernize farming and build a better future for the agricultural sector.</p>
    </div>
</div>
@endsection
