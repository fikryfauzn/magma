<!DOCTYPE html>
@vite(['resources/css/notification-profile.css'])
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Service</title>
    <link rel="stylesheet" href="{{ asset('css/transaction.css') }}">
</head>
<body>
    <div class="sidebar">
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
                <li><a href="{{ route('admin.manage_user') }}" class="{{ Request::is('admin/manage_user') ? 'active' : '' }}">Manage User</a></li>
                <li><a href="{{ route('admin.manage_product') }}" class="{{ Request::is('admin/manage_product') ? 'active' : '' }}">Manage Product</a></li>
                <li><a href="{{ route('admin.manage_services') }}" class="{{ Request::is('admin/manage_services') ? 'active' : '' }}">Manage Services</a></li>
                <li><a href="{{ route('admin.manage_service_booking') }}" class="{{ Request::is('admin/manage_service_booking') ? 'active' : '' }}">Manage Service Booking</a></li>
                </ul>
            </li>
        </ul>
        <div class="logout">
            <a href="{{ route('logout') }}">Logout</a>
        </div>
    </div>

    <div class="main-content">
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

        <div class="table-container">
            <!-- Create Button -->
            <div class="create-button-container">
                <button class="create-button">Create</button>
            </div>

            <table>
                <thead>
                    <tr>
                        <th><input type="checkbox"></th>
                        <th>Service ID</th>
                        <th>Service Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($services as $service)
                        <tr>
                            <td><input type="checkbox"></td>
                            <td>{{ $service->service_id }}</td>
                            <td>{{ $service->service_name }}</td>
                            <td>{{ $service->description }}</td>
                            <td>${{ number_format($service->price, 2) }}</td>
                            <td class="action-buttons">
                                <button onclick="window.location.href='{{ route('admin.service.edit', $service->service_id) }}'" class="update-button">Update</button>
                                <form action="{{ route('admin.service.destroy', $service->service_id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="delete-button" onclick="return confirm('Are you sure you want to delete this service?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>

    <style>
        /* Styling for Create button */
        .create-button-container {
            text-align: right;
            margin-bottom: 20px;
        }

        .create-button {
            background-color: #28a745;
            color: white;
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .create-button:hover {
            background-color: #218838;
        }

        /* Table Styling */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f4f4f4;
        }

        .action-buttons button {
            margin-right: 10px;
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .update-button {
            background-color: #007bff;
            color: white;
        }

        .update-button:hover {
            background-color: #0056b3;
        }

        .delete-button {
            background-color: #dc3545;
            color: white;
        }

        .delete-button:hover {
            background-color: #c82333;
        }
    </style>
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
