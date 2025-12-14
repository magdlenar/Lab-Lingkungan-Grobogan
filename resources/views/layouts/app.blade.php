<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laboratorium Lingkungan Dinas Lingkungan Hidup Kabupaten Grobogan</title>
    <link rel="icon" type="image/jpg" href="{{ asset('images/logo.jpg') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
    body { margin:0; padding:0; }
    main { padding-top:0 !important; margin-top:0 !important; }
    main > *:first-child { margin-top:0 !important; }
    .profile-bg { padding-top:0 !important; margin-top:0 !important; }
    </style>
</head>

<body class="bg-light">
<div id="app">

    <nav class="navbar navbar-expand-lg navbar-light navbar-modern shadow-sm sticky-top mb-0">
    <div class="container">
        <!-- Logo -->
        <a class="navbar-brand d-flex align-items-center gap-2" href="{{ url('/') }}">
            <img src="{{ asset('images/logo.jpg') }}" alt="Logo" width="44" height="44" class="me-1">
            <div class="brand-text">
                <span class="fw-bold primary-green d-block lh-1">Laboratorium Lingkungan</span>
                <small class="text-muted d-block lh-1">DLH Kabupaten Grobogan</small>
            </div>
        </a>

        <!-- Toggle -->
        <button class="navbar-toggler border-0 shadow-sm rounded-3 px-2 py-1"
                type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Isi Navbar -->
        <div class="collapse navbar-collapse" id="navbarNavDropdown">

            <!-- Tengah -->
            <ul class="navbar-nav mx-auto align-items-lg-center gap-lg-1 mt-3 mt-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('/') ? 'active' : '' }}"
                       href="{{ url('/') }}">
                       Beranda
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('tentang') ? 'active' : '' }}"
                       href="{{ url('/tentang') }}">
                       Tentang
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->is('layanan') ? 'active' : '' }}"
                       href="{{ url('/layanan') }}">
                       Layanan
                    </a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ request()->is('publikasi*') ? 'active' : '' }}"
                       href="#" id="publikasiDropdown" role="button"
                       data-bs-toggle="dropdown" aria-expanded="false">
                       Publikasi
                    </a>
                    <ul class="dropdown-menu dropdown-menu-modern" aria-labelledby="publikasiDropdown">
                        <li>
                            <a class="dropdown-item" href="{{ route('publik.ika') }}">
                                <i class="bi bi-droplet-half text-success"></i>
                                Indeks Kualitas Air (IKA)
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('publik.iku') }}">
                                <i class="bi bi-wind text-success"></i>
                                Indeks Kualitas Udara (IKU)
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->is('galeri*') ? 'active' : '' }}"
                       href="{{ route('galeri.index') }}">
                       Galeri
                    </a>
                </li>
            </ul>

            <!-- Kanan -->
            @guest
                <div class="d-flex gap-2 mt-3 mt-lg-0">
                    <a href="{{ route('login') }}" class="btn btn-outline-success btn-modern">
                        Masuk
                    </a>
                    <a href="{{ route('register') }}" class="btn btn-success btn-modern">
                        Daftar
                    </a>
                </div>
            @endguest

                @auth
                    @php
                        $nama = Auth::user()->nama ?? 'User';
                    @endphp

                    <ul class="navbar-nav ms-lg-3 mt-3 mt-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle user-chip"
                            href="#" id="profilDropdown"
                            role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                                <span>{{ $nama }}</span>
                                <span class="user-caret">
                                    <i class="bi bi-chevron-down"></i>
                                </span>
                            </a>

                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-modern"
                                aria-labelledby="profilDropdown">

                                {{-- ✅ Header dropdown tanpa avatar --}}
                                <li class="px-2 py-2">
                                    <div class="d-flex align-items-center gap-2 bg-light rounded-3 p-2">
                                        <div>
                                            @php
                                                $user = auth()->user();
                                                @endphp

                                                <div class="fw-bold text-dark">{{ $user->nama ?? $user->name ?? '-' }}</div>
                                                <small class="text-muted">{{ $user->instansi ?? '-' }}</small>
                                        </div>
                                    </div>
                                </li>

                                <li><hr class="dropdown-divider my-2"></li>

                                <li>
                                    <a class="dropdown-item" href="{{ route('customer.profil') }}">
                                        <i class="bi bi-person-lines-fill text-success"></i>
                                        Profil
                                    </a>
                                </li>

                                <li>
                                    <a class="dropdown-item" href="{{ route('uji.create') }}">
                                        <i class="bi bi-journal-text text-success"></i>
                                        Permintaan Uji
                                    </a>
                                </li>

                                <li>
                                    <a class="dropdown-item" href="{{ route('uji.status') }}">
                                        <i class="bi bi-clipboard-data text-success"></i>
                                        Status Permintaan Uji
                                    </a>
                                </li>

                                <li>
                                    <a class="dropdown-item" href="{{ url('/hasil-uji') }}">
                                        <i class="bi bi-bar-chart-line text-success"></i>
                                        Hasil Uji
                                    </a>
                                </li>

                                <li><hr class="dropdown-divider my-2"></li>

                                <li>
                                    <form action="{{ route('logout') }}" method="POST" class="m-0">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger">
                                            <i class="bi bi-box-arrow-right"></i>
                                            Keluar
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    </ul>
                @endauth
        </div>
    </div>
</nav>

    <!-- ✅ Konten utama TANPA padding atas -->
    <main class="pt-0 pb-4">  {{-- sebelumnya py-4 --}}
        @yield('content')
    </main>

    <!-- Footer -->
    <div class="footer-wrapper">
        <footer class="bg-light text-black text-center py-4 mt-0" style="margin-top: -1px;">
            <div class="footer-circle"></div>
            <div class="footer-circle-2"></div>
            <div class="container">
                <div class="row text-start text-md-start">
                    <!-- Jam Operasional -->
                    <div class="col-md-4 mb-4">
                        <h6 class="text-uppercase fw-bold mb-3" style="color:#189e1e;">
                            Jam Operasional
                        </h6>

                        <div class="d-flex mb-2">
                            <i class="bi bi-calendar-week text-success me-2"></i>
                            <div>
                                <strong>Senin – Kamis</strong><br>
                                <span class="text-muted small">07.15 – 15.30 WIB</span>
                            </div>
                        </div>

                        <div class="d-flex">
                            <i class="bi bi-calendar-event text-success me-2"></i>
                            <div>
                                <strong>Jumat</strong><br>
                                <span class="text-muted small">07.15 – 13.30 WIB</span>
                            </div>
                        </div>
                    </div>

                    <!-- Kontak Kami -->
                    <div class="col-md-4 mb-4">
                        <h6 class="text-uppercase fw-bold" style="color: #189e1e;">Kontak Kami</h6>
                        <ul class="list-unstyled mb-0">
                            <li class="d-flex align-items-start mb-3">
                                <a href="https://maps.app.goo.gl/o9crZ8h6McybtM1F7" class="text-dark text-decoration-none social-link">
                                    <i class="bi bi-geo-alt-fill me-3 fs-5" style="color: #189e1e;"></i>
                                    <span class="text-dark" style="line-height: 1.6;">
                                        Simpang Utara, Purwodadi, <br>Grobogan Regency, Central Java 58111
                                    </span>
                                </a>
                            </li>
                            <li class="d-flex align-items-start mb-3">
                                <i class="bi bi-telephone-fill me-3 fs-5" style="color: #189e1e;"></i>
                                <div class="text-dark" style="line-height: 1.6;">
                                    <div>
                                        <a href="https://wa.me/qr/H2A2IQFVXGTKJ1" class="text-dark text-decoration-none social-link">
                                            0813 9339 5905
                                        </a>
                                    </div>
                                    <div>
                                        <a href="https://wa.me/qr/H2A2IQFVXGTKJ1" class="text-dark text-decoration-none social-link">
                                            0813 2568 5066
                                        </a>
                                    </div>
                                </div>
                            </li>
                            <li class="d-flex align-items-start mb-2">
                                <a href="https://mail.google.com/mail/?view=cm&fs=1&to=laboratoriumdlh@gmail.com&su=Permintaan%20Informasi%20Layanan%20Laboratorium%20Lingkungan"
                                   class="text-dark text-decoration-none social-link">
                                    <i class="bi bi-envelope-fill me-3 fs-5" style="color: #189e1e;"></i>
                                    <span>laboratoriumdlh@gmail.com</span>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <!-- Sosial Media -->
                    <div class="col-md-4 mb-4">
                        <h6 class="text-uppercase fw-bold" style="color: #189e1e;">Sosial Media</h6>
                        <ul class="list-unstyled mb-0">
                            <li class="d-flex align-items-center mb-2">
                                <a href="https://www.instagram.com/lab_ling_grobogan?igsh=MTlxNXFjMnBubzZtcg=="
                                   class="text-dark text-decoration-none social-link">
                                    <i class="bi bi-instagram me-2 fs-4" style="color: #E1306C;"></i>
                                    <span>@lab_ling_grobogan</span>
                                </a>
                            </li>
                            <li class="d-flex align-items-center mb-2">
                                <a href="https://www.facebook.com/DLHGrobogan/"
                                   class="text-dark text-decoration-none social-link">
                                    <i class="bi bi-facebook me-2 fs-4" style="color: #1877F2;"></i>
                                    <span>Laboratorium Lingkungan DLH Grobogan</span>
                                </a>
                            </li>
                            <li class="d-flex align-items-center">
                                <a href="https://www.youtube.com/@DLHGROBOGAN"
                                   class="text-dark text-decoration-none social-link">
                                    <i class="bi bi-youtube me-2 fs-4" style="color: #FF0000;"></i>
                                    <span>Laboratorium Lingkungan DLH Grobogan</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <hr class="border-secondary">
            <div class="text-center small text-muted">
                &copy; {{ date('Y') }} Laboratorium Lingkungan DLH Kabupaten Grobogan. All rights reserved.
            </div>
        </footer>
    </div>

</div>
</body>
</html>
