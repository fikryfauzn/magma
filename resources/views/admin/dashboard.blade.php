<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        /* Layar Redup */
        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 100;
        }

        /* Popup Profil */
        .profile-popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 413px;
            height: 469px;
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            z-index: 101;
        }

        .profile-popup-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100%;
        }

        .profile-picture {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 20px;
        }

        .profile-buttons button {
            width: 150px;
            padding: 10px;
            margin: 5px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .edit-button {
            background-color: #007bff;
            color: white;
        }

        .edit-button:hover {
            background-color: #0056b3;
        }

        .logout-button {
            background-color: #dc3545;
            color: white;
        }

        .logout-button:hover {
            background-color: #c82333;
        }

        /* Popup Notifikasi */
        .notification-popup {
            display: none;
            position: fixed;
            top: 20px;
            right: 20px;
            width: 300px;
            padding: 15px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            z-index: 1001;
        }

        .notification-popup h4 {
            margin: 0;
            font-size: 16px;
        }

        .notification-popup p {
            margin: 10px 0 0;
            font-size: 14px;
        }

        /* Ikon Bell dan Profil */
        .notification-icon, .profile-icon {
            cursor: pointer;
            font-size: 24px; /* Ukuran yang sama dengan ikon profil */
            padding: 5px;
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
                <li><a href="{{ route('admin.manages') }}" class="{{ Request::is('admin/manages') ? 'active' : '' }}">Manages</a></li>
            </ul>
            <div class="logout">
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
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
                <div class="analytics-content">
                    <!-- Grafik analytics -->
                    <canvas id="visitorChart"></canvas>
                </div>
            </section> 

            <!-- Section Statistik -->
            <section class="stats">
                <div class="stat-box">Total Income</div>
                <div class="stat-box">Total Customer</div>
                <div class="stat-box">Total Mechanic</div>
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
