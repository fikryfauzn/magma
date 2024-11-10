<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    
    <!-- Global and Layout Styles -->
    @vite(['resources/css/header.css', 'resources/css/footer.css', 'resources/css/app.css'])

    @stack('styles') <!-- Page-specific styles -->
</head>
<body class="lenis lenis-smooth">
    <!-- Header -->
    @include('partials.header')

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    @include('partials.footer')

    <!-- Global and Page-Specific Scripts -->
    @vite(['resources/js/app.js'])
    @vite(['resources/js/header.js'])
    @vite(['resources/js/footer.js'])
    @stack('scripts')
</body>
</html>
