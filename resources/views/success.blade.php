<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Success</title>
</head>
<body>
    <h1>Login Successful</h1>

    <p>Welcome, {{ Auth::user()->username }}! You have successfully logged in.</p>

    <!-- Logout Button -->
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit">Logout</button>
    </form>
    <form action="{{ route('password.request') }}" method="GET">
        <button type="submit">Reset Password</button>
    </form>
</body>
</html>
