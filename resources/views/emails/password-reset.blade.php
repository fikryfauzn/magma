<!DOCTYPE html>
<html>
<head>
    <title>Password Reset</title>
</head>
<body>
    <h1>Password Reset Request</h1>
    <p>We received a request to reset your password.</p>
    <p>Click the link below to reset your password:</p>
    <a href="{{ $details['reset_link'] }}">Reset Password</a>
    <p>If you didn't request a password reset, please ignore this email.</p>
</body>
</html>
