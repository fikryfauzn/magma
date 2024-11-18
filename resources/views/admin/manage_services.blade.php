<!DOCTYPE html>
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
        <div class="header">
            <h1>Manage Service</h1>
            <input type="text" class="search-bar" placeholder="Search">
            <div class="icons">
                <span class="notification-icon">🔔</span>
                <span class="profile-icon">👤</span>
            </div>
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
                    <tr>
                        <td><input type="checkbox"></td>
                        <td>1</td>
                        <td>Cleaning</td>
                        <td>Professional cleaning service for vehicles</td>
                        <td>$100</td>
                        <td class="action-buttons">
                            <button class="update-button">Update</button>
                            <button class="delete-button">Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <td><input type="checkbox"></td>
                        <td>2</td>
                        <td>Maintenance</td>
                        <td>Routine vehicle maintenance service</td>
                        <td>$150</td>
                        <td class="action-buttons">
                            <button class="update-button">Update</button>
                            <button class="delete-button">Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <td><input type="checkbox"></td>
                        <td>3</td>
                        <td>Repair</td>
                        <td>Vehicle repair for mechanical issues</td>
                        <td>$200</td>
                        <td class="action-buttons">
                            <button class="update-button">Update</button>
                            <button class="delete-button">Delete</button>
                        </td>
                    </tr>
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
</body>
</html>
