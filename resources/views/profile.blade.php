<!-- resources/views/profile.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
</head>
<body>
    <h1>Welcome to your profile, {{ Auth::user()->name }}!</h1>
    <p>Email: {{ Auth::user()->email }}</p>
</body>
</html>
