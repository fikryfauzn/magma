<form action="{{ route('users.update', $user->user_id) }}" method="POST">
    @csrf
    @method('PUT') <!-- Gunakan metode PUT untuk update -->
    <div>
        <label for="username">Username</label>
        <input type="text" name="username" value="{{ $user->username }}">
    </div>
    <div>
        <label for="email">Email</label>
        <input type="email" name="email" value="{{ $user->email }}">
    </div>
    <div>
        <label for="role">Role</label>
        <select name="role">
            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
            <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
        </select>
    </div>
    <button type="submit">Update User</button>
</form>
