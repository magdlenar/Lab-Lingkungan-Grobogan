@extends('layouts.app')

@section('content')

{{-- Font Awesome (cukup di sini, jangan taruh <head> di blade content) --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
    :root{
        --green:#189e1e;
        --green-soft:#f0fdf4;
        --ink:#0f172a;
        --muted:#64748b;
        --line:#e7edf3;
        --card:#ffffff;
    }

    /* ✅ page background lebih modern + aman dari navbar */
    .page-wrapper{
        min-height: 100vh;
        padding: clamp(22px, 5vh, 56px) 0 40px;
        background:
            radial-gradient(700px circle at 10% -10%, #e8f7ec 0, transparent 55%),
            radial-gradient(700px circle at 110% 0%, #e9f6ff 0, transparent 55%),
            linear-gradient(180deg, #f6faf7 0%, #ffffff 65%);
        display:flex;
        justify-content:center;
    }

    .content-wrap{
        width:100%;
        max-width:720px;
        display:flex;
        flex-direction:column;
        gap:14px;
        padding: 0 12px;
    }

    /* ✅ Card modern konsisten */
    .section-box{
        background: var(--card);
        padding: 18px 20px;
        border-radius: 18px;
        border:1px solid var(--line);
        box-shadow: 0 10px 30px rgba(2,6,23,.06);
    }

    /* ✅ header card */
    .section-head{
        display:flex;
        align-items:center;
        justify-content:space-between;
        gap:12px;
        margin-bottom: 12px;
    }
    .section-title{
        font-size: 18px;
        font-weight: 800;
        color: var(--ink);
        display:flex;
        align-items:center;
        gap:10px;
        margin:0;
    }
    .section-title .icon{
        width:36px;height:36px;border-radius:12px;
        display:grid;place-items:center;
        background: var(--green-soft);
        color:#166534;
        border:1px solid #bbf7d0;
        font-size:16px;
        flex-shrink:0;
    }
    .section-subtitle{
        color: var(--muted);
        font-size: 13.5px;
        margin:4px 0 0 0;
    }

    /* ✅ grid input biar rapih di desktop */
    .form-grid{
        display:grid;
        grid-template-columns: 1fr 1fr;
        gap:12px;
    }
    .form-grid .full{ grid-column: 1 / -1; }

    /* ✅ input box modern */
    .input-box{
        background:#fff;
        padding: 12px 12px;
        border-radius: 14px;
        border:1.8px solid #e6e9ee;
        transition:.18s ease;
        display:flex;
        flex-direction:column;
        gap:6px;
    }
    .input-box:focus-within{
        border-color: var(--green);
        box-shadow: 0 0 0 4px rgba(24,158,30,.12);
    }
    .input-box label{
        font-weight: 700;
        font-size: 12.5px;
        color:#334155;
        margin:0;
    }
    .form-control-modern{
        border:none;
        background:transparent;
        padding: 2px 0;
        font-size:14.5px;
        color: var(--ink);
        outline:none !important;
        box-shadow:none !important;
        width:100%;
    }
    .form-control-modern::placeholder{ color:#9aa4b2; }

/* ===== Password input-group (seperti gambar) ===== */
.pw-wrap{
  display:flex;
  align-items:stretch;
  width:100%;
  border:1.8px solid #e6e9ee;
  border-radius:12px;
  overflow:hidden;
  background:#fff;
}

.pw-input{
  border:0 !important;
  outline:0 !important;
  box-shadow:none !important;
  padding:10px 12px;
  width:100%;
  font-size:14.5px;
  background:transparent;
  color: var(--ink);
}

/* kotak icon kanan */
.pw-btn{
  width:46px;
  display:flex;
  align-items:center;
  justify-content:center;
  background:#f8fafc;                 /* abu muda */
  border-left:1.8px solid #e6e9ee;    /* garis pemisah */
  cursor:pointer;
  color:#64748b;
  user-select:none;
  transition:.15s;
}

.pw-btn:hover{
  background:#eef2f7;
  color:#0f172a;
}
    /* ✅ tombol modern */
    .btn-submit-modern{
        width:100%;
        background: var(--green);
        color:white;
        border:none;
        padding:12px 14px;
        border-radius:12px;
        font-weight:800;
        font-size:14px;
        transition:.25s ease;
        box-shadow: 0 8px 18px rgba(24,158,30,.22);
        display:inline-flex;
        align-items:center;
        justify-content:center;
        gap:8px;
    }
    .btn-submit-modern:hover{
        background:#1fb726;
        transform: translateY(-1px);
        color:#fff;
    }

    .btn-wa{
        background:#16a34a;
        color:white;
        border:none;
        padding:12px 14px;
        border-radius:12px;
        font-weight:800;
        font-size:14px;
        transition:.25s ease;
        display:inline-flex;
        align-items:center;
        justify-content:center;
        gap:8px;
        box-shadow: 0 8px 18px rgba(22,163,74,.25);
    }
    .btn-wa:hover{
        background:#22c55e;
        transform: translateY(-1px);
        color:#fff;
    }

    /* ✅ alert lebih nice */
    .alert-soft{
        border-radius:12px;
        font-size:14px;
        border:1px solid rgba(0,0,0,.05);
        box-shadow: 0 4px 12px rgba(0,0,0,.04);
    }

    /* ✅ mobile */
    @media (max-width: 576px){
        .section-box{ padding:16px; border-radius:14px; }
        .section-title{ font-size:16px; }
        .form-grid{ grid-template-columns: 1fr; }
    }
</style>


<div class="page-wrapper">
    <div class="content-wrap">

        {{-- Header Profil --}}
        <div class="section-box text-center">
            <div class="d-flex flex-column align-items-center gap-2">
                <div style="width:54px;height:54px;border-radius:16px;background:var(--green-soft);display:grid;place-items:center;border:1px solid #bbf7d0;">
                    <i class="fa-solid fa-user-gear" style="color:#166534;font-size:22px;"></i>
                </div>
                <h3 class="section-title justify-content-center" style="font-size:20px;">
                    Pengaturan Profil
                </h3>
                <p class="section-subtitle mb-0">
                    Kelola informasi akun dan keamanan Anda
                </p>
            </div>
        </div>

        {{-- Alert --}}
        @if(session('success'))
            <div class="alert alert-success alert-soft mb-0">
                <i class="fa-solid fa-circle-check me-1"></i>
                {{ session('success') }}
            </div>
        @endif

        {{-- Informasi Diri --}}
        <div class="section-box">
            <div class="section-head">
                <div>
                    <h4 class="section-title">
                        <span class="icon"><i class="fa-solid fa-id-card"></i></span>
                        Informasi Diri
                    </h4>
                    <p class="section-subtitle">Pastikan data Anda valid dan terbaru.</p>
                </div>
            </div>

            <form method="POST" action="{{ route('profil.update') }}">
                @csrf

                <div class="form-grid">
                    {{-- NAMA --}}
                    <div class="input-box full">
                        <label>Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control-modern"
                               value="{{ $user->nama }}" required placeholder="Nama Anda">
                    </div>

                    {{-- EMAIL --}}
                    <div class="input-box">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control-modern"
                               value="{{ $user->email }}" required placeholder="email@contoh.com">
                    </div>

                    {{-- NOMOR HP --}}
                    <div class="input-box">
                        <label>Nomor HP</label>
                        <input type="text" name="nomor_hp" class="form-control-modern"
                               value="{{ $user->nomor_hp }}" required placeholder="08xxxxxxxxxx">
                    </div>

                    {{-- INSTANSI --}}
                    <div class="input-box full">
                        <label>Instansi</label>
                        <input type="text" name="instansi" class="form-control-modern"
                               value="{{ $user->instansi }}" required placeholder="Nama instansi/perusahaan">
                    </div>
                </div>

                <button class="btn-submit-modern mt-3">
                    <i class="fa-solid fa-floppy-disk"></i>
                    Simpan Perubahan
                </button>
            </form>
        </div>

        {{-- Keamanan Akun --}}
        <div class="section-box">
            <div class="section-head">
                <div>
                    <h4 class="section-title">
                        <span class="icon"><i class="fa-solid fa-shield-halved"></i></span>
                        Keamanan Akun
                    </h4>
                    <p class="section-subtitle">Gunakan password kuat minimal 8 karakter.</p>
                </div>
            </div>

            <form method="POST" action="{{ route('profil.password') }}">
                @csrf

                <div class="input-box full">
                    <label>Password Baru</label>

                    <div class="pw-wrap">
                        <input id="new_password"
                            type="password"
                            name="password"
                            class="pw-input"
                            required minlength="8"
                            placeholder="Password minimal 8 karakter">

                        <span class="pw-btn" onclick="togglePassword('new_password', this)">
                        <i class="fa-regular fa-eye-slash"></i>
                        </span>
                    </div>
                    </div>

                    {{-- KONFIRMASI PASSWORD --}}
                    <div class="input-box full">
                    <label>Konfirmasi Password</label>

                    <div class="pw-wrap">
                        <input id="new_password_confirm"
                            type="password"
                            name="password_confirmation"
                            class="pw-input"
                            required minlength="8"
                            placeholder="Password minimal 8 karakter">

                        <span class="pw-btn" onclick="togglePassword('new_password_confirm', this)">
                        <i class="fa-regular fa-eye-slash"></i>
                        </span>
                    </div>
                    </div>

                <button class="btn-submit-modern mt-3">
                    <i class="fa-solid fa-key"></i>
                    Update Password
                </button>
            </form>
        </div>

        {{-- Hapus Akun --}}
        <div class="section-box">
            <div class="section-head">
                <div>
                    <h4 class="section-title">
                        <span class="icon" style="background:#fff1f2;border-color:#fecdd3;color:#e11d48;">
                            <i class="fa-solid fa-triangle-exclamation"></i>
                        </span>
                        Hapus Akun
                    </h4>
                    <p class="section-subtitle">Permintaan hapus akun diproses oleh admin.</p>
                </div>
            </div>

            <div class="alert alert-warning alert-soft mb-3">
                <strong>Informasi:</strong><br>
                Untuk menghapus akun permanen, silakan hubungi Admin Laboratorium.
            </div>

            <a href="https://wa.me/6281393395905?text=Halo%20Admin,%20saya%20ingin%20menghapus%20akun%20."
               target="_blank"
               class="btn-wa w-100 text-decoration-none">
                <i class="fa-brands fa-whatsapp"></i>
                Hubungi Admin via WhatsApp
            </a>
        </div>

    </div>
</div>

<script>
function togglePassword(inputId, btnEl) {
  const field = document.getElementById(inputId);
  const icon = btnEl.querySelector("i");

  if (field.type === "password") {
    field.type = "text";
    icon.classList.remove("fa-eye-slash");
    icon.classList.add("fa-eye");
  } else {
    field.type = "password";
    icon.classList.remove("fa-eye");
    icon.classList.add("fa-eye-slash");
  }
}
</script>

@endsection
