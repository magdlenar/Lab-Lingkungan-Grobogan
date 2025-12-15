<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Akun</title>
    <link rel="icon" type="image/jpg" href="{{ asset('images/logo.jpg') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>

<div class="login-wrapper">
    <div class="login-card">

        <div class="d-flex justify-content-between align-items-center mb-2">
            <h3 class="login-title mb-0">Daftar Akun</h3>

            <!-- ICON HOME -->
            <a href="{{ url('/') }}" class="text-decoration-none">
                <i class="bi bi-house-door-fill fs-3 text-dark"></i>
            </a>
        </div>
                {{-- ERROR MESSAGE --}}
                @if ($errors->any())
            <div class="alert alert-danger mt-3">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('status'))
            <div class="alert alert-success mt-3">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label">Nama</label>
                <input type="text" name="nama" value="{{ old('nama') }}" class="form-control" placeholder="Masukkan nama lengkap Anda" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="Masukkan email (contoh: nama@gmail.com)" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Nomor HP</label>
                <input type="text" name="nomor_hp" value="{{ old('nomor_hp') }}" class="form-control"  placeholder="Masukkan nomor HP aktif" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Instansi</label>
                <input type="text" name="instansi" value="{{ old('instansi') }}" class="form-control" placeholder="Masukkan nama instansi Anda" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Password</label>
                <div class="input-group">
                    <input id="password" type="password" name="password" class="form-control" placeholder="Minimal 8 karakter" required minlength="8">
                    <span class="input-group-text password-toggle"
                          onclick="togglePassword('password','iconPass')">
                        <i id="iconPass" class="bi bi-eye-slash"></i>
                    </span>
                </div>
            </div>

            <div class="mb-1">
                <label class="form-label">Konfirmasi Password</label>
                <div class="input-group">
                    <input id="password_confirmation" type="password" name="password_confirmation"
                           class="form-control" required minlength="8" onkeyup="checkPasswordMatch()">
                    <span class="input-group-text password-toggle"
                          onclick="togglePassword('password_confirmation','iconConfirm')">
                        <i id="iconConfirm" class="bi bi-eye-slash"></i>
                    </span>
                </div>
            </div>

            <small id="passwordMessage" class="text-danger d-none">Password tidak sama!</small>

            <button class="btn-login w-100 mt-3">Daftar</button>
        </form>

        <div class="text-center mt-3">
            <a href="{{ route('auth.google') }}" class="btn google-btn">
                <i class="bi bi-google me-2"></i>
                Daftar / Masuk dengan Google
            </a>
        </div>

        <div class="text-center mt-3">
            <small>Sudah punya akun? <a href="{{ route('login') }}">Masuk</a></small>
        </div>

    </div>
</div>

</body>
</html>
