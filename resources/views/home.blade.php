{{-- resources/views/home.blade.php --}}
@extends('layouts.app')

@section('content')
@php
  use Illuminate\Support\Facades\Storage;
  use Illuminate\Support\Str;
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
      .gallery-preview-card{
        background:#fff;border:1px solid #eef1f5;border-radius:16px;
        box-shadow:0 6px 18px rgba(0,0,0,.05);
        transition:.18s ease;height:100%;
        display:flex;flex-direction:column;gap:8px;position:relative;
        overflow:hidden; /* biar gambar rapi ikut rounded */
      }
      .gallery-preview-card:hover{
        transform:translateY(-2px);
        box-shadow:0 10px 22px rgba(0,0,0,.08);
        border-color:#d9f2de;
      }

      /* ✅ THUMBNAIL */
      .gallery-thumb{
        width:100%;
        height:160px;
        object-fit:cover;
        background:#f3f4f6;
        display:block;
      }

      .gallery-body{
        padding:14px 14px 12px;
        display:flex;flex-direction:column;gap:8px;flex:1;
      }

      .gallery-badge{
        font-size:11.5px;font-weight:900;letter-spacing:.2px;
        color:#166534;background:#f0fdf4;border:1px solid #bbf7d0;
        padding:3px 8px;border-radius:999px;display:inline-flex;gap:6px;
        align-items:center;width:fit-content;
      }
      .gallery-title{
        font-weight:900;color:#0f172a;font-size:15px;line-height:1.35;margin:0;
      }
      .gallery-excerpt{
        font-size:13.5px;color:#475569;line-height:1.6;margin:0;flex:1;
      }
      .gallery-meta{
        font-size:12px;color:#94a3b8;display:flex;align-items:center;gap:8px;margin-top:2px;
      }
      .gallery-read{
        font-size:12.5px;font-weight:900;color:#189e1e;
        display:inline-flex;align-items:center;gap:6px;margin-top:4px;
      }
      .gallery-preview-card a.stretched-link{ text-decoration:none;color:inherit; }

      @media(max-width:576px){
        .gallery-thumb{ height:140px; }
        .gallery-title{ font-size:14.5px; }
        .gallery-excerpt{ font-size:13px; }
      }
    </style>
</head>
<body>

<!-- 🔹 HERO SECTION -->
<section class="hero-section text-white d-flex align-items-center justify-content-center text-center">
  <div class="container py-5">
    <div class="row justify-content-center">
      <div class="col-md-7">

        <!-- badge kecil biar lebih hidup -->
        <div class="hero-badge mx-auto">
          <i class="bi bi-shield-check"></i> Layanan Resmi & Terpercaya
        </div>

        <h1 class="hero-title fw-bold">
          <span class="lab">Laboratorium</span>
          <span class="ling">Lingkungan</span>
        </h1>

        <p class="hero-sub lead">
          Layanan pengujian & analisis kualitas lingkungan tepat, cepat, dan akurat
          untuk mendukung kebijakan lingkungan di wilayah Grobogan.
        </p>

        <div class="d-flex justify-content-center flex-wrap gap-3">
          <a href="{{ url('/layanan') }}"
             class="btn btn-light text-success btn-lg shadow-lg border-0">
            <i class="bi bi-card-checklist me-2"></i> Lihat Layanan
          </a>

          <!-- ✅ DROPDOWN WHATSAPP -->
          <div class="dropdown">
            <button class="btn btn-success text-white btn-lg shadow-lg border-0 dropdown-toggle"
                    type="button" data-bs-toggle="dropdown">
              <i class="bi bi-whatsapp me-2"></i> Hubungi Kami
            </button>
            <ul class="dropdown-menu shadow-sm border-0">
              <li>
                <a href="https://wa.me/6281393395905" target="_blank"
                   class="dropdown-item d-flex align-items-center">
                  <i class="bi bi-person-circle text-success me-2"></i> WhatsApp Admin 1
                </a>
              </li>
              <li>
                <a href="https://wa.me/6281325685066" target="_blank"
                   class="dropdown-item d-flex align-items-center">
                  <i class="bi bi-person-circle text-success me-2"></i> WhatsApp Admin 2
                </a>
              </li>
            </ul>
          </div>
        </div>

      </div>
    </div>
  </div>
</section>

<!-- 🔹 SERVICES SECTION -->
<section class="py-5" style="background-color:#f8fff8;"> 
  <div class="container">

    <div class="alert alert-success d-flex align-items-center shadow-sm mb-4 rounded-3 banner-animatif"> 
      <i class="bi bi-check-circle-fill fs-3 me-3" style="color: #189e1e;"></i> <div> <h5 class="fw-bold mb-1" style="color: #189e1e;">
        Pengujian Gratis
      </h5> 
      <p class="mb-0 text-muted">Layanan pengujian tersedia gratis sesuai ketentuan Laboratorium Lingkungan Hidup Kabupaten Grobogan.

      </p> 
    </div>
  </div>

    <div class="text-center mb-5">
      <h2 class="fw-bold" style="color:#189e1e">Layanan Uji Kualitas Lingkungan</h2>
      <p class="text-muted">Berbagai layanan pengujian kualitas lingkungan air yang dilakukan oleh Laboratorium Lingkungan Hidup Kabupaten Grobogan.</p>
    </div>

    <div class="row g-4">
      @php
        $services = [
          ['icon' => 'bi-water', 'title' => 'Uji Kualitas Air Sungai', 'desc' => 'Pengujian air sungai parameter air seperti pH, BOD, COD, TSS, DO, dan parameter lainnya sesuai baku mutu.'],
          ['icon' => 'bi-droplet-half', 'title' => 'Uji Kualitas Air Limbah', 'desc' => 'Analisis air limbah domestik dan industri untuk memastikan kesesuaian terhadap peraturan lingkungan.'],
          ['icon' => 'bi-tsunami', 'title' => 'Uji Air Danau & Sejenisnya', 'desc' => 'Pengujian kualitas air pada danau, waduk, dan sumber air permukaan lainnya.'],
          ['icon' => 'bi-flask', 'title' => 'Uji Kualitas Lindi', 'desc' => 'Pengujian air lindi dari TPA untuk memantau kandungan pencemar dan potensi dampak lingkungan.']
        ];
      @endphp

      @foreach($services as $srv)
        <div class="col-md-3">
          <div class="card h-100 shadow-sm border-0 hover-shadow">
            <div class="card-body text-center">
              <div class="mb-3"><i class="bi {{ $srv['icon'] }} fs-1" style="color:#189e1e"></i></div>
              <h5 class="card-title">{{ $srv['title'] }}</h5>
              <p class="card-text text-muted">{{ $srv['desc'] }}</p>
              <a href="{{ route('uji.create') }}" class="stretched-link"></a>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>

<!-- 🔹 GALERI SECTION (PREVIEW ARTIKEL + GAMBAR, LINK KE ARTIKEL UPLOAD) -->
<section class="py-5" style="background:linear-gradient(135deg,#e6f5e8 0%,#ffffff 100%);">
  <div class="container">

    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 text-center text-md-start">
      <div>
        <h2 class="fw-bold mb-0" style="color:#189e1e">Galeri</h2>
        <p class="text-muted mb-0">Dokumentasi kegiatan, pengujian, dan fasilitas laboratorium</p>
      </div>
      <div class="mt-3 mt-md-0">
        <a href="{{ route('galeri.index') }}" class="btn btn-outline-success fw-semibold">
          <i class="bi bi-journal-text me-2"></i> Lihat Semua Artikel
        </a>
      </div>
    </div>

    <div class="row g-3">
      @forelse($galeris as $gal)
        <div class="col-12 col-md-6 col-lg-3">
          <div class="gallery-preview-card">

            @php
              $imgUrl = null;
            
              if (!empty($gal->gambar)) {
                // bersihkan path (kalau ada storage/)
                $key = ltrim($gal->gambar, '/');
                $key = \Illuminate\Support\Str::replaceFirst('storage/', '', $key);
            
                // pakai URL public Backblaze
                $imgUrl = Storage::disk('s3')->url($key);
              }
            @endphp
            
            @if($imgUrl)
              <img src="{{ $imgUrl }}"
                   class="gallery-thumb"
                   alt="{{ $gal->judul }}">
            @else
              <div class="gallery-thumb d-flex align-items-center justify-content-center text-muted">
                Tidak ada gambar
              </div>
            @endif

            <div class="gallery-body">
              <span class="gallery-badge">
                <i class="bi bi-bookmark-check"></i> Artikel Galeri
              </span>

              <h5 class="gallery-title clamp-2">
                {{ $gal->judul }}
              </h5>

              <p class="gallery-excerpt clamp-3">
                {{ \Illuminate\Support\Str::limit(strip_tags($gal->deskripsi ?? ''), 110) }}
              </p>

              <div class="gallery-meta">
                <i class="bi bi-calendar3"></i>
                {{ optional($gal->created_at)->translatedFormat('d F Y') ?? '-' }}
              </div>

              <div class="gallery-read">
                Baca Selengkapnya <i class="bi bi-arrow-right"></i>
              </div>
            </div>

            {{-- LINK --}}
            <a href="{{ route('galeri.show',$gal->slug) }}" class="stretched-link"></a>
          </div>
        </div>
      @empty
        <div class="col-12">
          <div class="text-center text-muted py-4">
            Belum ada artikel galeri.
          </div>
        </div>
      @endforelse
    </div>

  </div>
</section>

<!-- 🔹 CTA SECTION -->
<section class="text-white mb-0" style="background:linear-gradient(135deg,#189e1e 0%,#1fbf24 100%);">
  <div class="container text-center py-5">
    <div class="d-md-flex justify-content-between align-items-center text-center text-md-start">
      <div class="mb-3 mb-md-0">
        <h4 class="fw-bold mb-1">Butuh layanan pengujian cepat?</h4>
        <p class="mb-0">Hubungi melalui kontak kami untuk konsultasi dan layanan.</p>
      </div>

      <!-- Dropdown WhatsApp -->
      <div class="dropdown">
        <button class="btn btn-light text-success btn-lg fw-semibold shadow-sm border-0 dropdown-toggle"
                type="button" data-bs-toggle="dropdown" aria-expanded="false">
          <i class="bi bi-whatsapp me-2"></i> Hubungi via WhatsApp
        </button>

        <ul class="dropdown-menu dropdown-menu-end shadow-sm"
            style="border-radius:12px;">
          <li>
            <a class="dropdown-item d-flex align-items-center gap-2 py-2"
               href="https://wa.me/6281393395905" target="_blank">
              <i class="bi bi-person-circle text-success"></i>
              WhatsApp Admin 1
            </a>
          </li>
          <li>
            <a class="dropdown-item d-flex align-items-center gap-2 py-2"
               href="https://wa.me/6281325685066" target="_blank">
              <i class="bi bi-person-circle text-success"></i>
              WhatsApp Admin 2
            </a>
          </li>
        </ul>
      </div>
      <!-- End Dropdown -->
    </div>
  </div>
</section>

</body>
</html>
@endsection
