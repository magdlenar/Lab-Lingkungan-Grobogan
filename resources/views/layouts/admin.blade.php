<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel')</title>
    <link rel="icon" type="image/jpg" href="{{ secure_asset('images/logo.jpg') }}">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
 <style>

.menu-title {
    margin-top: 20px;
    margin-bottom: 6px;
    padding-left: 6px;
    font-size: 12.5px;
    text-transform: uppercase;
    color: #8ca08c;
    font-weight: 700;
    letter-spacing: .7px;
    border-left: 3px solid var(--green-dark);
}

:root {
    --green: #1fb726;
    --green-dark: #14891c;
    --green-soft: #eaffea;
    --border-light: #d9e8d9;
    --grey-text: #4a4a4a;
    --white: #ffffff;
}

body {
    margin: 0;
    padding: 0;
    background: #f5f7f9;
    font-family: 'Arial', sans-serif;
}

/* SIDEBAR */
.sidebar {
    width: 250px;
    height: 100vh;
    background: var(--white);
    border-right: 2px solid var(--border-light);
    position: fixed;
    top: 0;
    left: 0;
    padding: 25px 20px;
    box-shadow: 0 0 18px rgba(0,0,0,0.08);
    border-radius: 0 20px 20px 0;
    transition: transform .35s ease;

    /* supaya layout bisa dorong bagian bawah */
    display: flex;
    flex-direction: column;

    /* scroll kalau konten tinggi */
    overflow-y: auto;
    overflow-x: hidden;
    overscroll-behavior: contain;
}

.sidebar::-webkit-scrollbar {
    width: 6px;
}
.sidebar::-webkit-scrollbar-thumb {
    background: #d7e6d7;
    border-radius: 10px;
}
.sidebar::-webkit-scrollbar-thumb:hover {
    background: #bcd6bc;
}

/* HEADER */
.sidebar-header {
    text-align: center;
    margin-bottom: 20px;
}

.sidebar-header img {
    width: 60px;
    border-radius: 12px;
    margin-bottom: 8px;
}

.sidebar-header h4 {
    font-size: 16px;
    font-weight: 700;
    color: var(--green-dark);
}

/* Wrapper bagian bawah */
.bottom-actions {
    margin-top: auto;
    padding-top: 14px;
    border-top: 1px solid #e5efe5;
    display: flex;
    align-items: center;
    gap: 12px;
}

/* Garis pemisah vertikal */
.bottom-divider {
    width: 1px;
    height: 32px;
    background: #d8e5d8;
    border-radius: 2px;
}

/* Tombol Setelan (ikon bulat) */
.settings-icon-btn {
    width: 42px;
    height: 42px;
    border-radius: 50%;
    background: #f3f8f3;
    border: 1px solid #dce9dc;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #1b8f1f;
    font-size: 20px;
    cursor: pointer;
    transition: .25s ease;
}

.settings-icon-btn:hover {
    background: #e7f8e7;
    border-color: #1fb726;
    color: #14891c;
    transform: translateY(-2px);
    box-shadow: 0 4px 10px rgba(24, 158, 30, 0.18);
}

.settings-icon-btn.active {
    background: #e6fde6;
    border-color: #1fb726;
    color: #14891c;
}

/* Tombol Logout minimalis */
.bottom-link {
    padding: 8px 12px;
    border-radius: 10px;
    background: #fff7f7;
    border: 1px solid #f3cdcd;
    color: #b91c1c;
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 13px;
    font-weight: 600;
    transition: .25s ease;
}

.bottom-link:hover {
    background: #fee2e2;
    border-color: #f97373;
    color: #991b1b;
}

/* SUB JUDUL MENU (lebih soft, tidak menonjol) */
.menu-title {
    margin-top: 16px;
    margin-bottom: 4px;
    padding-left: 4px;
    font-size: 11px;
    text-transform: uppercase;
    color: #a0aec0;
    font-weight: 600;
    letter-spacing: .15em;
}

/* MENU LINK */
.sidebar a {
    display: flex;
    align-items: center;
    padding: 10px 12px;
    margin: 3px 0;
    color: var(--grey-text);
    text-decoration: none;
    font-size: 14px;
    font-weight: 500;
    border-radius: 10px;
    transition: 0.25s ease;
}

.sidebar a i {
    width: 22px;
    font-size: 18px;
    margin-right: 8px;
    color: var(--green-dark);
}

.sidebar a:hover {
    background: var(--green-soft);
    color: var(--green-dark);
}

.sidebar a.active {
    background: var(--green-soft);
    border-left: 4px solid var(--green-dark);
    color: var(--green-dark);
    font-weight: 600;
}

/* BAGIAN BAWAH: SETELAN & KELUAR */
.bottom-actions {
    margin-top: auto;              /* dorong ke bawah */
    padding-top: 12px;
    border-top: 1px solid #e5efe5;
    display: flex;
    gap: 8px;
}

.bottom-link {
    flex: 1;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    padding: 8px 10px;
    border-radius: 999px;
    font-size: 13px;
    font-weight: 600;
    border: 1px solid #e2efe2;
    background: #f8fbf8;
    color: #374151;
    text-decoration: none;
    transition: .2s ease;
}

.bottom-link i {
    font-size: 15px;
}

.bottom-link:hover {
    background: var(--green-soft);
    border-color: var(--green);
    color: var(--green-dark);
}

/* variasi warna khusus untuk logout */
.bottom-logout {
    background: #fff7f7;
    border-color: #f3cdcd;
    color: #b91c1c;
}
.bottom-logout:hover {
    background: #fee2e2;
    border-color: #f97373;
    color: #991b1b;
}

/* HAMBURGER & CONTENT tetap seperti sebelumnya */
.content {
    margin-left: 250px;
    padding: 25px;
    transition: .35s ease;
}
@media (max-width: 992px) {
    .sidebar {
        transform: translateX(-100%);
        z-index: 999;
    }
    .sidebar.active {
        transform: translateX(0);
    }
    .content {
        margin-left: 0;
        width: 100%;
    }
}
.mobile-toggle {
    display: none;
    position: fixed;
    top: 15px;
    left: 15px;
    z-index: 1000;
    background: var(--green-dark);
    color: white;
    border: none;
    border-radius: 8px;
    padding: 10px 12px;
}
@media (max-width: 992px) {
    .mobile-toggle {
        display: block;
    }
}

</style>

</head>

<body>
    <button class="mobile-toggle" onclick="toggleSidebar()">
    <i class="bi bi-list"></i>
    </button>


    <!-- SIDEBAR -->
    <div class="sidebar">

    <div class="sidebar-header">
        <img src="{{ asset('images/logo.jpg') }}" alt="Logo">
        <h4>Admin Laboratorium</h4>
    </div>

    {{-- BERANDA (di luar grup, tapi ada label kecil) --}}
    <div class="menu-title">Beranda</div>
    <a href="{{ url('/admin/dashboard') }}" class="{{ request()->is('admin/dashboard') ? 'active' : '' }}">
        <i class="bi bi-speedometer2"></i> Dashboard
    </a>

    {{-- 1. MANAJEMEN CUSTOMER --}}
    <div class="menu-title">Manajemen Customer</div>
    <a href="{{ url('/admin/akun') }}" class="{{ request()->is('admin/akun') ? 'active' : '' }}">
        <i class="bi bi-people-fill"></i> Akun Terdaftar
    </a>

    {{-- 2. MANAJEMEN PENGUJIAN --}}
    <div class="menu-title">Manajemen Pengujian</div>
    <a href="{{ url('/admin/permintaan') }}" class="{{ request()->is('admin/permintaan') ? 'active' : '' }}">
        <i class="bi bi-file-earmark-text"></i> Permintaan Uji
    </a>
    <a href="{{ route('admin.hasiluji.index') }}" class="{{ request()->routeIs('admin.hasiluji.*') ? 'active' : '' }}">
        <i class="bi bi-bar-chart-line"></i> Hasil Uji
    </a>

    {{-- 3. MANAJEMEN UMUM --}}
    <div class="menu-title">Manajemen Umum</div>

    @php
        $publikasiOpen = request()->is('admin/ika*') || request()->is('admin/iku*');
    @endphp

    <a href="#publikasiMenu"
       class="{{ $publikasiOpen ? 'active' : '' }}"
       data-bs-toggle="collapse"
       role="button"
       aria-expanded="{{ $publikasiOpen ? 'true' : 'false' }}"
       aria-controls="publikasiMenu">
        <i class="bi bi-journal-text"></i>
        <span>Publikasi IKA & IKU</span>
        <i class="bi bi-caret-down-fill ms-auto small"
           style="color:#94a3b8; font-size:12px;"></i>
    </a>

    <div class="collapse {{ $publikasiOpen ? 'show' : '' }}" id="publikasiMenu">
        <div class="ps-4 mt-1 d-flex flex-column gap-1">
            <a href="{{ route('admin.ika.index') }}"
               class="{{ request()->is('admin/ika*') ? 'active' : '' }}"
               style="font-size:14px; padding:10px 14px; border-radius:9px;">
                <i class="bi bi-droplet-half"></i> Input IKA
            </a>
            <a href="{{ route('admin.iku.index') }}"
               class="{{ request()->is('admin/iku*') ? 'active' : '' }}"
               style="font-size:14px; padding:10px 14px; border-radius:9px;">
                <i class="bi bi-cloud-haze2"></i> Input IKU
            </a>
        </div>
    </div>

    <a href="{{ route('admin.struktur.index') }}" class="{{ request()->is('admin/struktur*') ? 'active' : '' }}">
        <i class="bi bi-diagram-3-fill"></i> Struktur Organisasi
    </a>
    <a href="{{ route('admin.galeri.index') }}"
   class="{{ request()->is('admin/galeri*') ? 'active' : '' }}">
    <i class="bi bi-images"></i> Galeri
    </a>

    {{-- BAGIAN PALING BAWAH: SETELAN + KELUAR, SEJAJAR & MINIMALIS --}}
   <div class="bottom-actions">

    {{-- Ikon Setelan --}}
    <a href="{{ url('/admin/setelan') }}"
       class="settings-icon-btn {{ request()->is('admin/setelan') ? 'active' : '' }}"
       title="Setelan">
        <i class="bi bi-gear-fill"></i>
    </a>

    {{-- Garis Pemisah Vertikal --}}
    <div class="bottom-divider"></div>

    {{-- Tombol Keluar --}}
    <form method="POST" action="{{ route('logout') }}" class="m-0 p-0">
        @csrf
        <button type="submit" class="bottom-link bottom-logout">
            <i class="bi bi-box-arrow-right"></i>
            <span>Keluar</span>
        </button>
    </form>

</div>

</div>


    <!-- CONTENT -->
    <div class="content">
        @yield('content')
    </div>
<script>
function toggleSidebar() {
    document.querySelector('.sidebar').classList.toggle('active');
}
</script>

</body>
</html>
