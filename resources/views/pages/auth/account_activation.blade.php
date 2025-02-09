<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aktivasi Akun</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h4>Aktivasi Akun</h4>
            </div>
            <div class="card-body">
                <p>Halo <strong>{{ $user->name }}</strong>,</p>
                <li>Email: {{ $user->email }}</li>
                <li>Password: {{ $password }}</li>
                <p>Akun Anda hampir siap digunakan. Silakan klik tombol di bawah ini untuk mengaktifkan akun Anda:</p>

                <form action="{{ route('user.activate', $activationToken) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary">Aktifkan Akun</button>
                </form>

                <p>Jika Anda tidak mendaftar untuk akun ini, Anda dapat mengabaikan email ini.</p>
            </div>
        </div>
    </div>
</body>
</html>
