<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
</head>
<body>
  <h2>Halo, {{ $user->nama }}</h2>
  <p>Terima kasih telah mendaftar. Silakan gunakan kode berikut untuk memverifikasi akun Anda:</p>
  <h3>{{ $user->verification_code }}</h3>
  <p>Masukkan kode ini pada halaman verifikasi kami untuk mengaktifkan akun Anda.</p>
</body>
</html>
