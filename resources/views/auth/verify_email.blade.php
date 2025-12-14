<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Email</title>
    <link rel="icon" type="image/jpg" href="{{ asset('images/logo.jpg') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5">

            <div class="card shadow-sm border-0">
                <div class="card-body">

                    <h4 class="text-center mb-3 fw-bold">Verifikasi Email</h4>
                    <p class="text-center text-muted">
                        Masukkan kode verifikasi yang telah dikirim ke email Anda.
                    </p>

                    @if(session('status'))
                        <div class="alert alert-success text-center">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger text-center">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <form action="{{ route('verify.email') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label" for="code">Kode Verifikasi</label>
                            <input type="text"
                                   id="code"
                                   name="code"
                                   class="form-control text-center fw-semibold"
                                   placeholder="Masukkan kode 6 digit"
                                   required
                                   maxlength="6">
                        </div>

                        <button type="submit" class="btn btn-success w-100">
                            Verifikasi
                        </button>
                    </form>

                    <p class="text-center mt-3 text-muted">
                        Tidak menerima kode?
                        <a href="{{ route('verify.email.resend') }}" class="text-primary text-decoration-none">
                            Kirim ulang
                        </a>
                    </p>

                </div>
            </div>

        </div>
    </div>
</div>

</body>
</html>
