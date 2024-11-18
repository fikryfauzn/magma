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
        /* Popup Profil */
        .profile-popup {
            display: none;
            position: absolute;
            top: 70px;
            right: 10px;
            width: 413px;
            height: 469px;
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            z-index: 1000;
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
                    <span class="notification-icon">🔔</span>
                    <span class="profile-icon" onclick="toggleProfilePopup()">👤</span>
                </div>

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
            </header>

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
        // Fungsi toggle popup profil
        function toggleProfilePopup() {
            const popup = document.getElementById('profile-popup');
            popup.style.display = popup.style.display === 'block' ? 'none' : 'block';
        }

        // Menutup popup jika klik di luar area popup
        document.addEventListener('click', function (event) {
            const popup = document.getElementById('profile-popup');
            const icon = document.querySelector('.profile-icon');
            if (popup.style.display === 'block' && !popup.contains(event.target) && event.target !== icon) {
                popup.style.display = 'none';
            }
        });
    </script>
</body>
</html>
