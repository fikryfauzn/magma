<!DOCTYPE html>
@vite(['resources/css/notification-profile.css'])
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transactions</title>
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
            <li><a href="{{ route('admin.manages') }}" class="{{ Request::is('admin/manages') ? 'active' : '' }}">Manages</a></li>
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

        <div class="container mt-5">
        <h2>Transaction List</h2>
        <div class="table-container">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th><input type="checkbox"></th>
                        <th>Transaction ID</th>
                        <th>Product ID</th>
                        <th>User ID</th>
                        <th>Service Booking</th>
                        <th>Total Amount</th>
                        <th>Transaction Type</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Transaction Number</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transactions as $transaction)
                        <tr>
                            <td><input type="checkbox"></td>
                            <td>{{ $transaction->transaction_id }}</td>
                            <td>{{ $transaction->product_id }}</td>
                            <td>{{ $transaction->user_id }}</td>
                            <td>{{ $transaction->serviceBooking->name ?? 'N/A' }}</td> <!-- Jika service_booking_id ada -->
                            <td>{{ $transaction->total_amount }}</td>
                            <td>{{ $transaction->transaction_type }}</td>
                            <td>{{ $transaction->status }}</td>
                            <td>{{ \Carbon\Carbon::parse($transaction->transaction_date)->format('d/m/Y') }}</td> <!-- Format tanggal -->
                            <td>{{ $transaction->reference_number }}</td>
                            <td class="action-buttons">

                            <form action="{{ route('transactions.update', $transaction->id) }}" method="POST">
                                @csrf
                                @method('PATCH') <!-- This ensures the form uses the PATCH method -->
    
                                <!-- Form fields go here -->
                                <button type="submit">Update Transaction</button>
                            </form>

                                <form action="{{ route('transactions.destroy', $transaction->transaction_id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="cancel-button">Cancel</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- Pagination -->
            {{ $transactions->links() }}
        </div>
    </div>

        <!-- <div class="stats">
            <div class="stat-box">Total Income</div>
            <div class="stat-box">Total Customer</div>
            <div class="stat-box">Total Mechanic</div>
        </div> -->
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
