<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Masuk Akun</title>
    <link rel="icon" type="image/jpg" href="{{ asset('images/logo.jpg') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>

<div class="login-wrapper">
    <div class="login-card">

        <div class="d-flex justify-content-between align-items-center mb-2">
            <h3 class="login-title mb-0">Masuk</h3>

            <!-- ICON HOME -->
            <a href="{{ url('/') }}" class="text-decoration-none">
                <i class="bi bi-house-door-fill fs-3 text-dark"></i>
            </a>
        </div>
        {{-- ALERT JIKA LOGIN GAGAL --}}
            @if (session('error'))
                <div class="alert alert-danger text-center">
                    {{ session('error') }}
                </div>
            @endif

            @if ($errors->login->any())
                <div class="alert alert-danger text-center">
                    {{ $errors->login->first() }}
                </div>
            @endif
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="Masukkan email Anda" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Password</label>
                <div class="input-group">
                    <input id="password" type="password" name="password" class="form-control" placeholder="Password minimal 8 karakter" minlength="8" required>
                    <span class="input-group-text password-toggle" onclick="togglePassword('password','iconPass')">
                        <i id="iconPass" class="bi bi-eye-slash"></i>
                    </span>
                </div>
            </div>

            <div class="d-flex justify-content-between align-items-center mb-3">
                <label class="form-check">
                    <input type="checkbox" name="remember" value="1"
                        class="form-check-input"
                        {{ old('remember') ? 'checked' : '' }}>
                    Ingat saya
                </label>

                <!-- Trigger Modal -->
                <a href="#" class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#forgotModal">
                    Lupa password?
                </a>
            </div>

            <button type="submit" class="btn-login w-100">Login</button>
        </form>

        <div class="text-center mt-3">
            <a href="{{ route('auth.google') }}" class="btn google-btn">
                <i class="bi bi-google me-2"></i>
                Masuk dengan Google
            </a>
        </div>

        <div class="text-center mt-3">
            <small>Belum punya akun? <a href="{{ route('register') }}">Daftar</a></small>
        </div>

    </div>
</div>

<!--     MODAL LUPA PASSWORD -->
<div class="modal fade" id="forgotModal" tabindex="-1" aria-labelledby="forgotModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="forgotModalLabel">Reset Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                {{-- ALERT RESET PASSWORD --}}
                @if ($errors->forgot->any())
                    <div class="alert alert-danger">
                        {{ $errors->forgot->first('email') }}
                    </div>
                @endif
            
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                <div class="modal-body">
                    <p class="text-muted">Masukkan email Anda untuk menerima link reset password.</p>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email"
                               name="email"
                               class="form-control"
                               placeholder="Contoh: email@gmail.com"
                               required>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Kirim Link Reset</button>
                </div>
            </form>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
