<form action="{{ route('create.admin') }}" method="POST">
    @csrf
    <label for="username">Username:</label>
    <input type="text" name="username" required><br>

    <label for="email">Email:</label>
    <input type="email" name="email" required><br>

    <label for="password">Password:</label>
    <input type="password" name="password" required><br>

    <label for="password_confirmation">Confirm Password:</label>
    <input type="password" name="password_confirmation" required><br>

    <button type="submit">Create Admin</button>
</form>
