<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <h2>Register</h2>

    <!-- resources/views/auth/register.blade.php -->
<form method="POST" action="{{ url('/register') }}">
    @csrf
    
    <!-- Name -->
    <div>
        <label for="name">Nama</label>
        <input type="text" name="name" id="name" required>
    </div>

    <!-- Username -->
    <div>
        <label for="username">Username</label>
        <input type="text" name="username" id="username" required>
    </div>

    <!-- Email -->
    <div>
        <label for="email">Email</label>
        <input type="email" name="email" id="email" required>
    </div>

    <!-- Password -->
    <div>
        <label for="password">Password</label>
        <input type="password" name="password" id="password" required>
    </div>

    <!-- Confirm Password -->
    <div>
        <label for="password_confirmation">Konfirmasi Password</label>
        <input type="password" name="password_confirmation" id="password_confirmation" required>
    </div>

    <button type="submit">Register</button>
</form>

</body>
</html>
