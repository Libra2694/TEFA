<!-- resources/views/auth/registrasi_admin.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Admin</title>
</head>
<body>
    <h1>Registrasi Admin</h1>

    <form method="POST" action="{{ route('register.admin') }}">
        @csrf

        <div>
            <label for="name">Nama:</label>
            <input type="text" id="name" name="name" required autofocus>
        </div>

        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>

        <div>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required autocomplete="new-password">
        </div>

        <div>
            <label for="password_confirmation">Konfirmasi Password:</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required autocomplete="new-password">
        </div>

        <button type="submit">Daftar</button>
    </form>
</body>
</html>
