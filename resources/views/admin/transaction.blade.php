<!DOCTYPE html>
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
        <div class="header">
            <h1>Transactions</h1>
            <input type="text" class="search-bar" placeholder="Search">
            <div class="icons">
                    <span class="notification-icon">🔔</span>
                    <span class="profile-icon">👤</span>
            </div>
        </div>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th><input type="checkbox"></th>
                        <th>Transaction ID</th>
                        <th>Product ID</th>
                        <th>User ID</th>
                        <th>ServiceBooking</th>
                        <th>TotalAmount</th>
                        <th>TransactionType</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>TransactionNumber</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><input type="checkbox"></td>
                        <td>8921</td>
                        <td>1912</td>
                        <td>7878</td>
                        <td>Product Purchase</td>
                        <td>1</td>
                        <td>Transaction ID</td>
                        <td>Failed</td>
                        <td>10/02/2024</td>
                        <td>Transaction ID</td>
                        <td class="action-buttons">
                            <button class="update-button">Update</button>
                            <button class="cancel-button">Cancel</button>
                        </td>
                    </tr>
                    <!-- Tambahkan lebih banyak baris transaksi jika perlu -->
                </tbody>
            </table>
        </div>

        <!-- <div class="stats">
            <div class="stat-box">Total Income</div>
            <div class="stat-box">Total Customer</div>
            <div class="stat-box">Total Mechanic</div>
        </div> -->
    </div>
</body>
</html>
