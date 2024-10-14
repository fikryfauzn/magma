<!-- resources/views/auth/verify.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification</title>
</head>
<body>
    <h1>Please Verify Your Email Address</h1>

    @if (session('resent'))
        <p>A new verification link has been sent to your email address.</p>
    @endif

    <p>Before proceeding, please check your email for a verification link.</p>
    <p>If you did not receive the email,</p>
    
    <form method="POST" action="{{ route('verification.resend') }}">
        @csrf
        <button type="submit">Click here to request another</button>
    </form>
</body>
</html>
