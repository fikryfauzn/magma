<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
</head>
<body>
    <h1>Forgot Password</h1>

    @if (session('status'))
        <div>{{ session('status') }}</div>
    @endif

    <form action="{{ route('password.email') }}" method="POST">
        @csrf
        <label for="email">Email:</label>
        <input type="email" name="email" required><br>
        <button type="submit">Send Reset Link</button>
    </form>
</body>
</html>
