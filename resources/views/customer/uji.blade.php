@extends('layouts.app')

@section('content')
<style>
    :root{
        --green:#189e1e;
        --green-soft:#f0fdf4;
        --ink:#0f172a;
        --muted:#64748b;
        --line:#e7edf3;
        --card:#ffffff;
    }

    /* ✅ Background + spacing aman dari navbar */
    .profile-bg{
        min-height: 100vh;
        padding: clamp(22px, 5vh, 56px) 0 40px;
        background:
            radial-gradient(700px circle at 10% -10%, #e8f7ec 0, transparent 55%),
            radial-gradient(700px circle at 110% 0%, #e9f6ff 0, transparent 55%),
            linear-gradient(180deg, #f6faf7 0%, #ffffff 65%);
    }

    /* ✅ Card utama */
    .profile-card{
        background:var(--card);
        border-radius:20px;
        padding:26px 26px;
        box-shadow:0 12px 32px rgba(2,6,23,.08);
        border:1px solid var(--line);
        max-width: 880px;
        margin: clamp(20px, 5vh, 50px) auto 0;
    }

    /* ✅ Header title modern */
    .profile-title{
        font-weight:900;
        color:var(--ink);
        letter-spacing:.3px;
        display:flex;
        align-items:center;
        justify-content:center;
        gap:10px;
        margin:0;
    }
    .title-icon{
        width:44px;height:44px;border-radius:14px;
        display:grid;place-items:center;
        background:var(--green-soft);
        color:#166534;
        border:1px solid #bbf7d0;
        font-size:18px;
        flex-shrink:0;
        box-shadow:0 6px 14px rgba(22,163,74,.12);
    }
    .title-sub{
        color:var(--muted);
        font-size:14px;
        margin-top:6px;
        text-align:center;
    }

    /* ✅ Section header */
    .section-title{
        font-weight:800;
        font-size:12.5px;
        color:var(--green);
        letter-spacing:.9px;
        text-transform:uppercase;
        margin: 18px 0 10px;
        display:flex;
        align-items:center;
        gap:8px;
    }
    .section-title::after{
        content:"";
        flex:1;
        height:1px;
        background:#e8eef5;
    }

    /* ✅ Grid form */
    .form-grid{
        display:grid;
        grid-template-columns:1fr 1fr;
        gap:14px;
    }

    /* ✅ Input modern */
    .input-box{
        background:#fff;
        padding:12px 12px;
        border-radius:14px;
        border:1.8px solid #e6e9ee;
        display:flex;
        flex-direction:column;
        gap:6px;
        transition:.18s;
    }
    .input-box:focus-within{
        border-color:var(--green);
        box-shadow:0 0 0 4px rgba(24,158,30,.12);
    }

    .form-label{
        font-weight:800;
        font-size:12.5px;
        color:#334155;
        margin:0;
    }

    .form-control, .form-select, textarea{
        border:none !important;
        background:transparent !important;
        padding:2px 0 !important;
        font-size:14.5px !important;
        outline:none !important;
        box-shadow:none !important;
    }

    /* ✅ Textarea wrapper khusus */
    .textarea-box textarea{
        min-height:86px;
        resize:vertical;
    }

    /* ✅ Upload box modern */
    .upload-box{
        border:1.8px dashed #cbd5e1;
        background:#f8fafc;
        padding:14px;
        border-radius:14px;
    }
    .upload-hint{
        font-size:12px;
        color:var(--muted);
        margin-top:6px;
    }

    /* ✅ tombol modern */
    .btn-modern{
        background:var(--green);
        color:#fff;
        border-radius:12px;
        font-weight:800;
        padding:11px 14px;
        transition:.25s;
        border:none;
        display:inline-flex;
        align-items:center;
        justify-content:center;
        gap:8px;
        box-shadow:0 8px 18px rgba(24,158,30,.22);
    }
    .btn-modern:hover{
        background:#1fb726;
        transform:translateY(-1px);
        color:#fff;
    }

    /* ✅ Alert soft */
    .alert-soft{
        border-radius:12px;
        font-size:14px;
        border:1px solid rgba(0,0,0,.05);
        box-shadow:0 4px 12px rgba(0,0,0,.04);
    }

    /* ✅ Mobile */
    @media(max-width:768px){
        .profile-card{
            padding:20px 16px;
            margin: 22px 12px 0;
        }
        .form-grid{ grid-template-columns:1fr; }
    }
</style>

<div class="profile-bg">
    <div class="container">

        <div class="profile-card">

            <div class="text-center mb-3">
                <div class="title-icon mx-auto mb-2">
                    <i class="bi bi-clipboard2-check"></i>
                </div>
                <h3 class="profile-title">Form Permintaan Uji</h3>
                <p class="title-sub mb-0">
                    Silakan isi data berikut untuk mengajukan permintaan uji sampel.
                </p>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-soft mb-3">
                    <i class="bi bi-check-circle me-1"></i>
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger alert-soft mb-3">
                    <strong>Periksa kembali input Anda:</strong><br>
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('uji.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="section-title">Data PIC</div>
                <div class="form-grid">
                    <div class="input-box">
                        <label class="form-label">Nama PIC Order</label>
                        <input type="text" name="pic_name" class="form-control" required placeholder="Nama lengkap PIC">
                    </div>

                    <div class="input-box">
                        <label class="form-label">No WA PIC Order</label>
                        <input type="text" name="pic_phone" class="form-control" required placeholder="08xxxxxxxxxx">
                    </div>

                    <div class="input-box">
                        <label class="form-label">Email Aktif PIC Order</label>
                        <input type="email" name="pic_email" class="form-control" required placeholder="email@contoh.com">
                    </div>

                    <div class="input-box">
                        <label class="form-label">Pilihan Layanan</label>
                        <select name="service_type" class="form-select" required>
                            <option value="" disabled selected>Pilih layanan...</option>
                            <option value="uji kualitas sungai">Uji Kualitas Sungai</option>
                            <option value="uji kualitas limbah">Uji Kualitas Limbah</option>
                            <option value="uji kualitas danau">Uji Kualitas Danau / Sejenisnya</option>
                            <option value="uji kualitas lindi">Uji Kualitas Lindi</option>
                        </select>
                    </div>
                </div>

                <div class="section-title">Data Sampel</div>

                <div class="input-box textarea-box mb-3">
                    <label class="form-label">Alamat Lokasi Pengambilan Sampel</label>
                    <textarea name="sample_address" class="form-control" rows="3" required
                              placeholder="Tuliskan alamat lengkap lokasi sampel"></textarea>
                </div>

                <div class="input-box textarea-box mb-3">
                    <label class="form-label">Catatan (Opsional)</label>
                    <textarea name="notes" class="form-control" rows="3"
                              placeholder="Keterangan tambahan bila ada"></textarea>
                </div>

                <div class="section-title">Dokumen</div>
                <div class="upload-box">
                    <label class="form-label mb-1">
                        Upload Surat Permohonan <span class="text-danger">(PDF/JPG/PNG)</span>
                    </label>
                    <input type="file" name="letter_file" class="form-control" required>
                    <div class="upload-hint">
                        Pastikan file jelas & ukuran maksimal 5MB.
                    </div>
                </div>

                <button class="btn-modern w-100 mt-4">
                    <i class="bi bi-send"></i> Kirim Permintaan Uji
                </button>
            </form>

        </div>

    </div>
</div>
@endsection
