<!DOCTYPE html>
@vite(['resources/css/notification-profile.css'])
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Booking Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }

        .header {
            background-color: white;
            display: flex;
            justify-content: flex-end;
            align-items: center;
            padding: 10px 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .icons {
            display: flex;
            gap: 20px;
        }

        .notification-icon, .profile-icon {
            cursor: pointer;
            font-size: 24px;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h2 {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .box {
            padding: 20px;
            margin-bottom: 20px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .box h3 {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .details-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .details-row div {
            flex: 1;
            margin-right: 20px;
        }

        .details-row div:last-child {
            margin-right: 0;
        }

        .button-group {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 20px;
        }

        .button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .validate-button {
            background-color: #007bff;
            color: white;
        }

        .validate-button:hover {
            background-color: #0056b3;
        }

        .cancel-button {
            background-color: #dc3545;
            color: white;
        }

        .cancel-button:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="icons">
            <span class="notification-icon">🔔</span>
            <span class="profile-icon">👤</span>
        </div>
    </header>

    <!-- Main Content -->
    <div class="container">
        <h2>Service Booking Details</h2>

        <!-- Box 1 -->
        <div class="box">
            <div class="details-row">
                <div><strong>Full Name</strong>: John Doe</div>
                <div><strong>Email</strong>: john.doe@example.com</div>
                <div><strong>Phone Number</strong>: +123 456 789</div>
            </div>

            <div>
                <h3>Description</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque vehicula eros non nulla.</p>
            </div>

            <div>
                <h3>Date</h3>
                <p>25 November 2024</p>
            </div>
        </div>

        <!-- Box 2 -->
        <div class="box">
            <h3>Payment Detail</h3>
            <p><strong>Pay with:</strong> COD</p>
            <p><strong>Total Payment:</strong> $100</p>
            <p><strong>Payment Status:</strong> Paid</p>
        </div>

        <!-- Box 3 -->
        <div class="box">
            <h3>Mechanic Details</h3>
            <p><strong>Mechanic Profile ID:</strong> M12345</p>
            <p><strong>User ID:</strong> U67890</p>
            <p><strong>Specialization:</strong> Engine Repair</p>
            <p><strong>Availability Schedule:</strong> Mon-Fri, 9 AM - 5 PM</p>
        </div>

        <!-- Buttons -->
        <div class="button-group">
            <button class="button validate-button">Validate</button>
            <button class="button cancel-button">Cancel</button>
        </div>
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
