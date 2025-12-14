<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
    <link rel="icon" type="image/jpg" href="{{ asset('images/logo.jpg') }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>

<div class="login-wrapper">
    <div class="login-card">

        <h3 class="login-title">Reset Password</h3>

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $token }}">

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input 
                    type="email" 
                    name="email" 
                    class="form-control"
                    value="{{ old('email') }}" 
                    required>
            </div>

            <div class="mb-3">
                <label class="form-label">Password Baru</label>
                <div class="input-group">
                    <input 
                        type="password" 
                        id="password"
                        name="password" 
                        class="form-control" 
                        required>
                    <span class="input-group-text password-toggle" onclick="togglePassword('password','iconPass1')">
                        <i id="iconPass1" class="bi bi-eye-slash"></i>
                    </span>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Konfirmasi Password</label>
                <div class="input-group">
                    <input 
                        type="password"
                        id="password_confirmation" 
                        name="password_confirmation" 
                        class="form-control" 
                        required>
                    <span class="input-group-text password-toggle" onclick="togglePassword('password_confirmation','iconPass2')">
                        <i id="iconPass2" class="bi bi-eye-slash"></i>
                    </span>
                </div>
            </div>

            <button type="submit" class="btn-login w-100">Reset Password</button>
        </form>

        <div class="text-center mt-3">
            <small><a href="{{ route('login') }}">Kembali ke Login</a></small>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>