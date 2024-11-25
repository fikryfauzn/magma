<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Booking Confirmation</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            line-height: 1.6;
            color: #333333;
            background-color: #f4f4f4;
            padding: 20px;
        }
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .email-header {
            text-align: center;
            margin-bottom: 30px;
        }
        .email-header h1 {
            color: #212121;
            font-size: 24px;
            font-weight: bold;
        }
        .email-content {
            margin-bottom: 20px;
        }
        .email-footer {
            text-align: center;
            color: #777777;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <h1>Booking Confirmation</h1>
        </div>
        <div class="email-content">
            <p>Dear {{ $user->name }},</p>
            <p>Thank you for booking a service with us! Below are the details of your booking:</p>
            <ul>
                <li><strong>Booking ID:</strong> {{ $booking->booking_id }}</li>
                <li><strong>Service:</strong> {{ $booking->service->service_name }}</li>
                <li><strong>Date Requested:</strong> {{ $booking->date_requested }}</li>
                <li><strong>Status:</strong> {{ $booking->status }}</li>
            </ul>
            <p>If you have any questions or need further assistance, feel free to contact us.</p>
            <p>Thank you for choosing our services!</p>
        </div>
        <div class="email-footer">
            <p>&copy; {{ date('Y') }} Magma. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
