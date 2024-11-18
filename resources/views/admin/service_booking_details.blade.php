<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Booking Details</title>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        /* Styles for the page */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        /* Header Section */
        .header {
            background-color: #f8f9fa;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo h2 {
            margin: 0;
            font-size: 24px;
        }

        /* Gray line below the header */
        .gray-line {
            border-top: 2px solid #ddd;
            margin-top: 20px;
        }

        /* Title Section */
        .title {
            margin: 30px 0 20px 30px;
            font-size: 24px;
            font-weight: bold;
        }

        /* Booking Details Box */
        .booking-box {
            margin: 0 30px;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 20px;
            border: 1px solid #ddd; /* Added border */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .booking-box h3 {
            margin: 0;
            font-weight: bold;
        }

        .booking-details {
            margin-top: 20px;
        }

        .booking-details div {
            margin-bottom: 15px;
        }

        .booking-details label {
            font-weight: bold;
            margin-right: 20px;
        }

        /* Description and other details */
        .description {
            margin-top: 20px;
        }

        .description div {
            margin-bottom: 15px;
        }

        /* Spacing for content */
        .spaced {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>

    <!-- Header -->
    <header class="header">
        <div class="logo">
            <h2>agriWheel</h2>
        </div>
    </header>

    <!-- Gray line below header -->
    <div class="gray-line"></div>

    <!-- Title Section -->
    <div class="title">
        Service Booking Details
    </div>

    <!-- Booking Details Box -->
    <div class="booking-box">
        <h3>Booking Details</h3>
        <div class="booking-details">
            <div>
                <label for="full-name">Full Name:</label>
                <span id="full-name">username1</span>
            </div>
            <div>
                <label for="email">Email:</label>
                <span id="email">usernam1@gmail.com</span>
            </div>
            <div>
                <label for="phone">Phone Number:</label>
                <span id="phone">+629823xxxx</span>
            </div>
        </div>

        <!-- Description Section -->
        <div class="description">
            <div>
                <label for="description">Deskripsi:</label>
                <span id="description">Ban depan rusak, ganti oli</span>
            </div>

            <div class="spaced">
                <label for="type-model">Tipe/Model:</label>
                <span id="type-model">XAG 8000</span>
            </div>

            <div>
                <label for="date">Tanggal:</label>
                <span id="date">12/02/2016</span>
            </div>
        </div>
    </div>

</body>
</html>