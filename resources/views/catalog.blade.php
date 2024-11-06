<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalog</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <style>
        /* General Styles */
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #212121;
            margin: 0;
            padding: 0;
            color: #212121;
            scroll-behavior: smooth;
        }
        
        .catalog-screen {
            position: relative;
            background-image: url('{{ asset('images/farm.jpg') }}');
            background-size: cover;
            background-position: center;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #FFFFFF;
            text-align: center;
            overflow: hidden;
        }

        .catalog-screen h1 {
            font-size: 150px;
            color: #212121;
            opacity: 0;
            transform: translateY(30px);
            animation: fadeInSlideUp 1.5s ease forwards;
            animation-delay: 0.5s;
        }

        /* Product Grid */
        .product-grid {
            display: flex;
            justify-content: center;
            border-bottom: 1px solid #424242;
            flex-wrap: wrap;
            background-color: #F5F5F5;
        }
        
        .product-card {
            flex: 1 1 33%;
            max-width: 33%;
            padding: 40px 0;
            text-align: center;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
            border-right: 1px solid rgba(0, 0, 0, 0.1);
        }

        .product-card:last-child {
            border-right: none;
        }

        .product-card h2 {
            font-size: 32px;
            margin: 0px 0 0px;
            font-weight: 600;
            line-height: 1.25;
            color: #212121;
        }

        .product-card p {
            font-size: 14px;
            color: #7d7d7d;
            margin-bottom: 18px;
            line-height: 1.5;
        }

        .price-tag {
            display: inline-block;
            background-color: #D32F2F;
            padding: 10px 20px;
            border-radius: 25px;
            font-size: 16px;
            font-weight: bold;
            color: #Fff;
            margin: 10px 200px 10px 200px;
        }

        .product-card img {
            max-width: 60%;
            height: auto;
            margin-top: 10px;
        }

        /* Fade-in and Slide-up Animation for CATALOG Heading */
        @keyframes fadeInSlideUp {
            0% {
                opacity: 0;
                transform: translateY(30px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
    <!-- Include Header Partial -->
    @include('partials.header')

    <!-- Full-Screen CATALOG Heading with Background Image -->
    <div class="catalog-screen" id="catalog-screen">
        <h1>CATALOG</h1>
    </div>

    <!-- Product Grid -->
    <!-- Product Grid -->
<div class="product-grid">
    @foreach($products as $product)
        <a href="{{ route('products.show', ['slug' => $product->slug]) }}" class="product-card" style="text-decoration: none;">
            <h2>{{ $product->name }}</h2>
            <div class="price-tag">${{ number_format($product->price, 2) }}</div>
            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
        </a>
    @endforeach
</div>


    <script>
        // Parallax Effect for Background
        window.addEventListener('scroll', function() {
            const catalogScreen = document.getElementById('catalog-screen');
            const scrollPosition = window.scrollY;
            catalogScreen.style.backgroundPositionY = `${scrollPosition * 0.5}px`;
        });
    </script>
</body>
</html>
