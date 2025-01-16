<!DOCTYPE html>
<html>
<head>
    <title>Aktivasi Akun</title>
</head>
<body>
    <p>Halo {{ $user->name }},</p>
    <p>Akun Anda telah berhasil diaktifkan. Berikut adalah detail akun Anda:</p>
    <ul>
        <li>Email: {{ $user->email }}</li>
        <li>Password: {{ $password }}</li>
        
    </ul>
    <p>Silakan gunakan informasi ini untuk login ke sistem kami.</p>
    <p>Terima kasih,</p>
    <p>Tim Support</p>
</body>
</html>
