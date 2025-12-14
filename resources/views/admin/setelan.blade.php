@extends('layouts.Admin')
@section('title', 'Setelan Akun')

@section('content')

<style>
*{ box-sizing: border-box; }
.setelan-wrapper{
    max-width: 980px;
    margin: 0 auto;
    padding: 8px 6px 24px;
    width:100%;
}

/* ====== Section Title ====== */
.section-head{
    display:flex;
    align-items:flex-start;
    justify-content:space-between;
    margin: 4px 0 12px;
    gap: 8px;
    flex-wrap: wrap; /* biar aman di HP */
}
.section-left{ display:flex; flex-direction:column; gap:2px; }
.section-title{
    font-size: 18px; font-weight: 700; color:#1f2937; margin:0; line-height:1.3;
}
.section-subtitle{
    font-size: 13px; color:#6b7280; margin-top:2px; line-height:1.4;
}

/* ===== Card Utama ===== */
.setelan-card{
    background:#fff;
    border-radius: 22px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.06);
    border: 1px solid #eef2f7;
    overflow: hidden;
    width:100%;
}

/* header */
.setelan-card-header{
    background: #f3f8ff;
    padding: 16px 18px;
    border-bottom: 1px solid #e8eef5;
    display:flex;
    align-items:center;
    justify-content:space-between;
    gap: 10px;
    flex-wrap: wrap; /* penting: biar nggak overflow di HP */
}
.setelan-card-header .left{
    display:flex;
    align-items:center;
    gap: 10px;
    min-width: 0;
}
.setelan-icon{
    width: 42px; height: 42px;
    border-radius: 12px;
    background:#eafbe9;
    display:flex; align-items:center; justify-content:center;
    color:#189e1e; font-size: 20px;
    flex: 0 0 auto;
}
.setelan-card-header h5{
    margin:0; font-weight:700; font-size:16px; color:#263238;
}
.setelan-card-header small{
    color:#64748b; font-size: 12px;
}
.last-login{
    font-size:12px;
    color:#6b7280;
    white-space: nowrap;
}

/* body */
.setelan-card-body{ padding: 18px; }

/* info strip */
.info-strip{
    background: #f9fbfd;
    border: 1px dashed #e2e8f0;
    padding: 10px 12px;
    border-radius: 12px;
    font-size: 13px;
    color:#475569;
    display:flex;
    gap:8px;
    align-items:flex-start;
    margin-bottom: 12px;
}
.info-strip i{ color:#189e1e; font-size: 16px; margin-top:1px; }

/* form grid desktop */
.form-grid{
    display:grid;
    grid-template-columns: 1fr 1fr;
    gap: 12px 14px;
    width:100%;
}
.form-group{ display:flex; flex-direction:column; gap:6px; min-width:0; }
.label-judul{ font-weight: 600; color: #334155; font-size: 13.5px; }
.form-control{
    border-radius: 12px;
    border: 1px solid #e6edf5;
    padding: 10px 12px;
    font-size: 14px;
    width:100%;
}
.form-control:focus{
    border-color:#189e1e;
    box-shadow: 0 0 0 3px rgba(24,158,30,0.12) !important;
}

/* password wrapper */
.password-wrapper{ position: relative; width:100%; }
.password-wrapper .toggle-password{
    position:absolute; top:50%; right:12px;
    transform: translateY(-50%);
    cursor:pointer; font-size:18px; color:#64748b; transition:.2s;
}
.password-wrapper .toggle-password:hover{ color:#0f7f15; }

/* footer actions */
.setelan-card-footer{
    padding: 14px 18px;
    border-top: 1px solid #eef2f7;
    display:flex;
    justify-content:flex-end;
    gap:10px;
    flex-wrap: wrap;
}
.btn-save{
    background:#189e1e; color:#fff; border:none; border-radius: 12px;
    padding: 10px 18px; font-weight:600; font-size:14px; transition:.2s;
    min-width:160px;
}
.btn-save:hover{ background:#0f7f15; }
.btn-soft{
    background:#f1f5f9; color:#334155; border:none; border-radius:12px;
    padding:10px 14px; font-weight:600; font-size:14px;
}
.alert{ border-radius: 12px; font-size: 14px; padding: 10px 12px; }

/* ================= MOBILE SUPER FRIENDLY ================= */
@media (max-width: 768px){
    .setelan-wrapper{ padding: 6px 4px 18px; }

    .section-title{ font-size: 16.5px; }
    .section-subtitle{ font-size: 12.5px; }

    .setelan-card-header{
        padding: 12px 12px;
        gap: 6px;
    }
    .last-login{
        width:100%;
        white-space: normal;  /* biar turun rapi */
        text-align:left;
    }

    .setelan-card-body{ padding: 12px; }

    /* FIX: form jadi 1 kolom total */
    .form-grid{ grid-template-columns: 1fr; }

    /* FIX: hilangkan efek span di mobile */
    .form-grid .span-2{ grid-column: auto !important; }

    .setelan-card-footer{
        padding: 12px;
        flex-direction: column;
        align-items: stretch;
    }
    .btn-save, .btn-soft{ width:100%; }
}

@media (max-width: 420px){
    .section-title{ font-size: 15.5px; }
    .setelan-icon{ width:38px; height:38px; font-size:18px; }
    .form-control{ font-size:13.5px; padding:9px 11px; }
}
</style>

<div class="setelan-wrapper">
    <div class="setelan-card">

        <div class="setelan-card-header">
            <div class="left">
                <div class="setelan-icon">
                    <i class="bi bi-person-gear"></i>
                </div>
                <div>
                    <h5>Pengaturan Akun</h5>
                    <small>Perubahan berlaku setelah disimpan</small>
                </div>
            </div>

          {{--   <div class="last-login">
                Terakhir login:
                {{ optional($user->last_login_at)->format('d M Y H:i') ?? '-' }}
            </div> --}}
        </div>

        <div class="setelan-card-body">

            @if(session('success'))
                <div class="alert alert-success mb-3">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger mb-3">{{ session('error') }}</div>
            @endif

            <div class="info-strip">
                <i class="bi bi-info-circle"></i>
                <div>
                    Pastikan email aktif. Password boleh dikosongkan bila tidak ingin mengubahnya.
                </div>
            </div>

            <form action="{{ route('admin.setelan.update') }}" method="POST">
                @csrf

                <div class="form-grid">
                    {{-- EMAIL --}}
                    <div class="form-group span-2">
                        <label class="label-judul">Email Admin</label>
                        <input type="email" name="email" class="form-control"
                               value="{{ $user->email }}" required>
                    </div>

                    {{-- PASSWORD BARU --}}
                    <div class="form-group">
                        <label class="label-judul">Password Baru</label>
                        <div class="password-wrapper">
                            <input type="password" name="password" class="form-control"
                                   id="password" placeholder="Kosongkan jika tidak ingin ubah">
                            <i class="bi bi-eye-fill toggle-password"
                               onclick="togglePass('password', this)"></i>
                        </div>
                        <small class="text-muted" style="font-size:12px;">
                            Minimal 8 karakter (disarankan kombinasi huruf & angka).
                        </small>
                    </div>

                    {{-- KONFIRMASI --}}
                    <div class="form-group">
                        <label class="label-judul">Konfirmasi Password</label>
                        <div class="password-wrapper">
                            <input type="password" name="password_confirmation" class="form-control"
                                   id="password2" placeholder="Ulangi password baru">
                            <i class="bi bi-eye-fill toggle-password"
                               onclick="togglePass('password2', this)"></i>
                        </div>
                    </div>
                </div>

                <div class="setelan-card-footer mt-3">
                    <button type="reset" class="btn-soft">
                        <i class="bi bi-arrow-counterclockwise me-1"></i> Reset
                    </button>
                    <button type="submit" class="btn-save">
                        <i class="bi bi-save2 me-1"></i> Update Setelan
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

<script>
function togglePass(id, icon) {
    const input = document.getElementById(id);
    if (input.type === "password") {
        input.type = "text";
        icon.classList.remove("bi-eye-fill");
        icon.classList.add("bi-eye-slash-fill");
    } else {
        input.type = "password";
        icon.classList.remove("bi-eye-slash-fill");
        icon.classList.add("bi-eye-fill");
    }
}
</script>

@endsection
