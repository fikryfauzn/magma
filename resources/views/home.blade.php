<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/header.css') }}"> <!-- Include header-specific CSS -->
    <style> 
        /* Container and Gallery Styles */
        .container {
        position: relative;
        text-align: left;
        width: 100vw;
        height: 100vh;
        }
        .container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }
        .content {
            position: absolute;
            top: 30%;
            left: 100px;
        }
        .content h1 {
            font-size: 80px;
            font-weight: 700;
            margin-bottom: 10px;
            color: #212121;
        }
        .content p {
            font-size: 20px;
            max-width: 400px;
            margin-bottom: 20px;
            color: #212121;
        }
        .content .button {
            padding: 12px 30px;
            background-color: #212121;
            color: white;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            font-size: 18px;
            font-weight: 600;
        }
        .content .button:hover {
            background-color: #555;
        }
        .gallery {
            display: flex;
            height: 100vh;
            width: 100vw;
            overflow: hidden;
        }
        .gallery-item {
            position: relative;
            flex: 1;
            overflow: hidden;
            transition: flex 0.5s ease;
        }
        .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease, filter 0.5s ease;
        }
        .gallery:hover .gallery-item:not(:hover) img {
            filter: blur(5px);
        }
        .gallery-item:hover {
            flex: 1.5;
        }
        .gallery-item:hover img {
            transform: scale(1.05);
            filter: none;
        }
        .gallery-caption {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            color: white;
            font-size: 20px;
            font-weight: bold;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            text-align: center;
            max-width: 90%;
        }

        /* Full-Page Quote Section */
        .quote-section {
            background-color: #212121;
            color: #F5F5F5 !important;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            text-align: center;
        }
        .quote-section p {
            font-size: 64px;
            font-weight: 600;
            max-width: 800px;
            margin: 0 auto;
            line-height: 1.6;
            color: #F5F5F5 !important;
        }
    </style>
</head>
<body>

    <!-- Include Header Partial -->
    @include('partials.header')

    <!-- Main Content -->
    <div class="container">
        <img src="{{ asset('images/Landing.png') }}" alt="Landing Image">
        <div class="content">
            <h1>GROVE</h1>
            <p>AgriWheel mendukung produktivitas pertanian dengan teknologi penggerak cerdas.</p>
            <a href="#" class="button">Explore</a>
        </div>
    </div>

    <div class="gallery">
        <div class="gallery-item">
            <img src="{{ asset('images/pic4.png') }}" alt="First Image">
            <div class="gallery-caption">Specially Designed For Dry Land</div>
        </div>
        <div class="gallery-item">
            <img src="{{ asset('images/pic3.png') }}" alt="Second Image">
            <div class="gallery-caption">Improve Efficiency and Productivity</div>
        </div>
    </div>

    <!-- Full-Page Quote Section -->
    <div class="quote-section">
        <p>Never calls in sick, never complains about the weather.</p>
    </div>

</body>
</html>
