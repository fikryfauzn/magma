<!DOCTYPE html>
<html>
<head>
    <style>
        /* Include the professional styling shared earlier */
    </style>
</head>
<body>
    <div class="email-container">
        <h1>Your Booking is Confirmed</h1>
        <p>Dear {{ $customer->name }},</p>
        <p>We are pleased to inform you that your service booking has been scheduled. Below are the details of your booking:</p>

        <div class="details">
            <p><strong>Service Name:</strong> {{ $booking->service->service_name }}</p>
            <p><strong>Mechanic:</strong> {{ $mechanic->name }} ({{ $mechanic->email }})</p>
            <p><strong>Scheduled Date:</strong> {{ $booking->date_scheduled }}</p>
            <p><strong>Booking ID:</strong> {{ $booking->booking_id }}</p>
        </div>

        <p>If you have any questions or need to reschedule, please do not hesitate to contact us.</p>
        
        <div class="footer">
            <p>Thank you for choosing our services. We look forward to serving you!</p>
            <p>&copy; {{ date('Y') }} MAGMA. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
