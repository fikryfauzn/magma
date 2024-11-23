<!DOCTYPE html>
@vite(['resources/css/notification-profile.css'])
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .analytics-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        .analytics-item {
            background-color: #f4f4f4;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .analytics-item h3 {
            margin-bottom: 10px;
            font-size: 18px;
            font-weight: bold;
            color: #000; /* Warna hitam untuk judul */
        }

        .analytics-item p {
            font-size: 24px;
            font-weight: bold;
            color: #000; /* Warna hitam untuk angka */
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="logo">
                <h2>agriWheel</h2>
            </div>
            <ul class="menu">
                <li><a href="{{ route('admin.dashboard') }}" class="{{ Request::is('admin/dashboard') ? 'active' : '' }}">Dashboard</a></li>
                <li><a href="{{ route('admin.transactions') }}" class="{{ Request::is('admin/transactions') ? 'active' : '' }}">Transactions</a></li>
    
                <!-- Manages sebagai dropdown -->
                <li class="dropdown">
                    <a href="{{ route('admin.manages') }}" class="{{ Request::is('admin/manages') ? 'active' : '' }}">Manages</a>
                    <ul class="submenu">
                    <li><a href="{{ route('admin.manage_user') }}">Manage User</a></li>
                    <li><a href="{{ route('admin.manage_product') }}">Manage Product</a></li>
                    <li><a href="{{ route('admin.manage_services') }}">Manage Services</a></li>
                    <li><a href="{{ route('admin.manage_service_booking') }}">Manage Service Booking</a></li>
                    </ul>
                </li>
            </ul>

            <div class="logout">
                <!-- Tombol logout -->
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                <!-- Form logout tersembunyi -->
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <!-- Header dengan search bar dan ikon -->
            <header class="header">
                <input type="text" placeholder="Search" class="search-bar">
                <div class="icons">
                    <span class="notification-icon" onclick="toggleNotificationPopup(event)">🔔</span>
                    <span class="profile-icon" onclick="toggleProfilePopup(event)">👤</span>
                </div>
            </header>

            <!-- Overlay -->
            <div class="overlay" id="overlay" onclick="closeProfilePopup()"></div>

            <!-- Popup Profil -->
            <div id="profile-popup" class="profile-popup">
                <div class="profile-popup-content">
                    <img src="{{ asset('images/profile.jpg') }}" alt="Profile Picture" class="profile-picture">
                    <div class="profile-buttons">
                        <button class="edit-button">Edit</button>
                        <button class="logout-button" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</button>
                    </div>
                </div>
            </div>

            <!-- Popup Notifikasi -->
            <div id="notification-popup" class="notification-popup">
                <h4>New Notification</h4>
                <p>You have 3 new messages.</p>
            </div>

            <!-- Section Visitor Analytics -->
            <section class="analytics">
                <h2>Visitor Analytics</h2>
                <div class="analytics-grid">
                    <div class="analytics-item">
                        <h3>Manage User</h3>
                        <img src="{{ asset('images/useraccountico.png') }}" alt="Manage User Image" style="width: 100px; height: 100px; object-fit: cover;">
                        
                    </div>
                    <div class="analytics-item">
                        <h3>Manage Product</h3>
                        <img src="{{ asset('images/productico.png') }}" alt="Manage Product Image" style="width: 100px; height: 100px; object-fit: cover;">
                    </div>
                    <div class="analytics-item">
                        <h3>Manage Booking</h3>
                        <img src="{{ asset('images/bookingico.png') }}" alt="Manage Booking Image" style="width: 100px; height: 100px; object-fit: cover;">
                    </div>
                    <div class="analytics-item">
                        <h3>Manage Service Booking</h3>
                        <img src="{{ asset('images/carrepaiico.png') }}" alt="Manage Service Booking Image" style="width: 100px; height: 100px; object-fit: cover;">
                </div>
                </div>

            </section> 
        </main>
    </div>

    <script>
        // Fungsi untuk membuka popup profil
        function toggleProfilePopup(event) {
            event.stopPropagation(); // Mencegah klik pada ikon menutup popup
            const popup = document.getElementById('profile-popup');
            const overlay = document.getElementById('overlay');
            popup.style.display = 'block';
            overlay.style.display = 'block';
        }

        // Fungsi untuk menutup popup profil
        function closeProfilePopup() {
            const popup = document.getElementById('profile-popup');
            const overlay = document.getElementById('overlay');
            popup.style.display = 'none';
            overlay.style.display = 'none';
        }

        // Fungsi untuk toggle notifikasi
        function toggleNotificationPopup(event) {
            event.stopPropagation(); // Mencegah klik pada ikon menutup popup
            const notificationPopup = document.getElementById('notification-popup');
            notificationPopup.style.display = notificationPopup.style.display === 'block' ? 'none' : 'block';
        }

        // Menutup popup saat klik di luar popup
        window.addEventListener('click', function(event) {
            const notificationPopup = document.getElementById('notification-popup');
            const profilePopup = document.getElementById('profile-popup');
            const overlay = document.getElementById('overlay');

            // Menutup popup notifikasi dan profil jika klik di luar mereka
            if (!notificationPopup.contains(event.target) && event.target !== document.querySelector('.notification-icon')) {
                notificationPopup.style.display = 'none';
            }

            if (!profilePopup.contains(event.target) && event.target !== document.querySelector('.profile-icon')) {
                profilePopup.style.display = 'none';
                overlay.style.display = 'none';
            }
        });
    </script>
</body>
</html>
