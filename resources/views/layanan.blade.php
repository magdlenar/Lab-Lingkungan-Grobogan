@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

</head>
<body></body>
<!-- 🔹 SECTION 1: Penjelasan Layanan -->
<section class="py-5" style="background: #daffdaff">
  <div class="container">
    <!-- Judul -->
    <div class="text-center mb-5">
      <h2 class="fw-bold" style="color: #189e1e">Layanan Laboratorium Lingkungan</h2>
      <p class="text-muted" style="max-width: 850px; margin: 0 auto; text-align: justify;">
        Laboratorium Lingkungan Dinas Lingkungan Hidup Kabupaten Grobogan memberikan layanan pengujian dan analisis kualitas air secara profesional, 
        akurat, dan transparan. Pengujian dilakukan terhadap berbagai sumber air untuk mendukung kebijakan pengendalian pencemaran dan pelestarian lingkungan.
      </p>
    </div>

    <!-- 🔹 Layanan dengan modal interaktif -->
    <div class="row text-center align-items-center justify-content-center g-5">
      <!-- Air Sungai -->
      <div class="col-md-6 col-lg-3">
        <div class="p-4 rounded-4 h-100 bg-white shadow-sm position-relative overflow-hidden service-card"
             data-bs-toggle="modal" data-bs-target="#modalSungai" style="cursor: pointer;">
          <div class="icon-circle mb-3 mx-auto">
            <i class="bi bi-water fs-1" style="color: #189e1e"></i>
          </div>
          <h5 class="fw-bold mb-2" style="color: #189e1e">Uji Kualitas Air Sungai</h5>
          <p class="text-muted small transition-text">Klik untuk penjelasan lebih lanjut</p>
        </div>
      </div>

      <!-- Air Limbah -->
      <div class="col-md-6 col-lg-3">
        <div class="p-4 rounded-4 h-100 bg-white shadow-sm position-relative overflow-hidden service-card"
             data-bs-toggle="modal" data-bs-target="#modalLimbah" style="cursor: pointer;">
          <div class="icon-circle mb-3 mx-auto">
            <i class="bi bi-droplet-half fs-1" style="color: #189e1e"></i>
          </div>
          <h5 class="fw-bold mb-2" style="color: #189e1e">Uji Kualitas Air Limbah</h5>
          <p class="text-muted small transition-text">Klik untuk penjelasan lebih lanjut</p>
        </div>
      </div>

      <!-- Air Danau -->
      <div class="col-md-6 col-lg-3">
        <div class="p-4 rounded-4 h-100 bg-white shadow-sm position-relative overflow-hidden service-card"
             data-bs-toggle="modal" data-bs-target="#modalDanau" style="cursor: pointer;">
          <div class="icon-circle mb-3 mx-auto">
            <i class="bi bi-tsunami fs-1" style="color: #189e1e"></i>
          </div>
          <h5 class="fw-bold mb-2" style="color: #189e1e">Uji Kualitas Air Danau</h5>
          <p class="text-muted small transition-text">Klik untuk penjelasan lebih lanjut</p>
        </div>
      </div>

      <!-- Air Lindi -->
      <div class="col-md-6 col-lg-3">
        <div class="p-4 rounded-4 h-100 bg-white shadow-sm position-relative overflow-hidden service-card"
             data-bs-toggle="modal" data-bs-target="#modalLindi" style="cursor: pointer;">
          <div class="icon-circle mb-3 mx-auto">
            <i class="bi bi-flask fs-1" style="color: #189e1e"></i>
          </div>
          <h5 class="fw-bold mb-2" style="color: #189e1e">Uji Kualitas Air Lindi</h5>
          <p class="text-muted small transition-text">Klik untuk penjelasan lebih lanjut</p>
        </div>
      </div>
    </div>

    <!-- 🔹 Ajakan (Call to Action) -->
    <div class="text-center mt-5">
      <p class="text-muted mb-3" style="font-size: 0.95rem;">
        Berminat untuk melakukan pengujian kualitas air di laboratorium kami?
      </p>
      <a href="{{ route('uji.create') }}" class="btn btn-success px-4 py-2 rounded-pill shadow-sm">
        <i class="bi bi-clipboard-check me-2"></i>Ajukan Uji Kualitas Air
      </a>
    </div>
  </div>
</section>

<!-- ✨ Modal Penjelasan Detail -->
<!-- Modal Sungai -->
<div class="modal fade" id="modalSungai" tabindex="-1" aria-labelledby="modalSungaiLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content border-0 shadow-lg">
      <div class="modal-header bg-success text-white">
        <h5 class="modal-title fw-semibold" id="modalSungaiLabel">Uji Kualitas Air Sungai</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body text-muted" style="text-align: justify;">
        Pengujian ini dilakukan untuk menilai kondisi fisik, kimia, dan biologi air sungai guna mengetahui tingkat pencemaran. 
        Parameter yang diuji meliputi suhu, pH, DO, BOD, COD, TSS, TDS, nitrat, total fosfat, dan parameter lainnya.  
        <br><br>
        Hasil uji digunakan sebagai acuan dalam penentuan status mutu air sesuai peraturan yang berlaku.
      </div>
    </div>
  </div>
</div>

<!-- Modal Limbah -->
<div class="modal fade" id="modalLimbah" tabindex="-1" aria-labelledby="modalLimbahLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content border-0 shadow-lg">
      <div class="modal-header bg-success text-white">
        <h5 class="modal-title fw-semibold" id="modalLimbahLabel">Uji Kualitas Air Limbah</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body text-muted" style="text-align: justify;">
        Layanan ini berfokus pada pengujian air limbah domestik dan industri untuk memastikan parameter seperti COD, BOD, pH, dan TSS sesuai baku mutu.  
        <br><br>
        Pengujian dilakukan untuk memastikan efektivitas Instalasi Pengolahan Air Limbah (IPAL) dan kepatuhan terhadap ketentuan lingkungan.
      </div>
    </div>
  </div>
</div>

<!-- Modal Danau -->
<div class="modal fade" id="modalDanau" tabindex="-1" aria-labelledby="modalDanauLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content border-0 shadow-lg">
      <div class="modal-header bg-success text-white">
        <h5 class="modal-title fw-semibold" id="modalDanauLabel">Uji Kualitas Air Danau</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body text-muted" style="text-align: justify;">
        Pengujian air danau dilakukan untuk mengetahui keseimbangan ekosistem serta keberadaan bahan pencemar yang mengganggu biota air.  
      </div>
    </div>
  </div>
</div>

<!-- Modal Lindi -->
<div class="modal fade" id="modalLindi" tabindex="-1" aria-labelledby="modalLindiLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content border-0 shadow-lg">
      <div class="modal-header bg-success text-white">
        <h5 class="modal-title fw-semibold" id="modalLindiLabel">Uji Kualitas Air Lindi</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body text-muted" style="text-align: justify;">
        Air lindi dari Tempat Pembuangan Akhir (TPA) diuji untuk mengetahui kandungan amonia serta bahan organik lainnya.  
        <br><br>
        Pengujian ini penting untuk mencegah perembesan zat berbahaya ke air tanah dan lingkungan sekitarnya.
      </div>
    </div>
  </div>
</div>

{{-- ================== SECTION SOP LAB ================== --}}
<section class="py-5" style="background:#ffffff;">
  <div class="container">

    <div class="d-flex flex-column flex-md-row align-items-md-end justify-content-between gap-2 mb-3">
      <div>
        <h3 class="fw-bold mb-1" style="color:#189e1e">Dokumen SOP Laboratorium</h3>
        <div class="text-muted" style="max-width:780px;">
         Dokumen <i>Standard Operating Procedure</i>
        </div>
      </div>

      <span class="badge rounded-pill"
            style="background:#eaffea; color:#14891c; border:1px solid #d9e8d9; padding:8px 12px;">
        <i class="bi bi-shield-check me-1"></i> Dokumen Resmi
      </span>
    </div>

    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
      <div class="card-body p-3 p-md-4">

        {{-- ITEM: SOP --}}
        <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-2 py-2">
          <div class="d-flex align-items-start gap-3">
            <div class="rounded-3 d-flex align-items-center justify-content-center"
                 style="width:44px;height:44px;background:#eaffea;border:1px solid #d9e8d9;">
              <i class="bi bi-file-earmark-text fs-4" style="color:#14891c;"></i>
            </div>
            <div>
              <div class="fw-bold" style="color:#0f172a;">SOP Laboratorium</div>
              <div class="small text-muted">
                @if(!empty($labDoc?->sop_file))
                  <i class="bi bi-check-circle-fill text-success me-1"></i> Tersedia
                @else
                  <i class="bi bi-x-circle-fill text-danger me-1"></i> Belum tersedia
                @endif
              </div>
            </div>
          </div>

          @if(!empty($labDoc?->sop_file))
            <div class="d-flex gap-2">
              <button class="btn btn-success btn-sm rounded-pill px-3"
                      data-bs-toggle="modal" data-bs-target="#modalSop">
                <i class="bi bi-eye me-1"></i> Lihat
              </button>
              <a class="btn btn-outline-success btn-sm rounded-pill px-3"
                 href="{{ route('dokumenlab.download','sop') }}">
                <i class="bi bi-download me-1"></i> Unduh
              </a>
            </div>
          @else
            <span class="small text-muted">—</span>
          @endif
        </div>

        <hr class="my-2" style="border-color:#eef2f7;">

        {{-- ITEM: SK SOP --}}
        <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-2 py-2">
          <div class="d-flex align-items-start gap-3">
            <div class="rounded-3 d-flex align-items-center justify-content-center"
                 style="width:44px;height:44px;background:#eaffea;border:1px solid #d9e8d9;">
              <i class="bi bi-file-earmark-check fs-4" style="color:#14891c;"></i>
            </div>
            <div>
              <div class="fw-bold" style="color:#0f172a;">
                SK SOP Pengambilan & Pengujian Contoh Uji
              </div>
              <div class="small text-muted">
                @if(!empty($labDoc?->sk_sop_file))
                  <i class="bi bi-check-circle-fill text-success me-1"></i> Tersedia
                @else
                  <i class="bi bi-x-circle-fill text-danger me-1"></i> Belum tersedia
                @endif
              </div>
            </div>
          </div>

          @if(!empty($labDoc?->sk_sop_file))
            <div class="d-flex gap-2">
              <button class="btn btn-success btn-sm rounded-pill px-3"
                      data-bs-toggle="modal" data-bs-target="#modalSkSop">
                <i class="bi bi-eye me-1"></i> Lihat
              </button>
              <a class="btn btn-outline-success btn-sm rounded-pill px-3"
                 href="{{ route('dokumenlab.download','sk') }}">
                <i class="bi bi-download me-1"></i> Unduh
              </a>
            </div>
          @else
            <span class="small text-muted">—</span>
          @endif
        </div>

      </div>
    </div>

  </div>
</section>
{{-- ===== MODAL SOP ===== --}}
<div class="modal fade" id="modalSop" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content border-0 shadow-lg">
      <div class="modal-header bg-success text-white">
        <h5 class="modal-title fw-semibold">SOP Laboratorium</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        @php $sopUrl = !empty($labDoc?->sop_file) ? asset('storage/'.$labDoc->sop_file) : null; @endphp

        @if($sopUrl)
          <iframe src="{{ $sopUrl }}" style="width:100%; height:75vh; border:0;"></iframe>
        @else
          <div class="text-muted">Dokumen belum tersedia.</div>
        @endif
      </div>
      <div class="modal-footer">
        @if(!empty($labDoc?->sop_file))
          <a class="btn btn-success" href="{{ route('dokumenlab.download','sop') }}">
            <i class="bi bi-download me-1"></i> Download
          </a>
        @endif
        <button class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>

{{-- ===== MODAL SK SOP ===== --}}
<div class="modal fade" id="modalSkSop" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content border-0 shadow-lg">
      <div class="modal-header bg-success text-white">
        <h5 class="modal-title fw-semibold">SK SOP Pengambilan dan Pengujian Contoh Uji</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        @php $skUrl = !empty($labDoc?->sk_sop_file) ? asset('storage/'.$labDoc->sk_sop_file) : null; @endphp

        @if($skUrl)
          <iframe src="{{ $skUrl }}" style="width:100%; height:75vh; border:0;"></iframe>
        @else
          <div class="text-muted">Dokumen belum tersedia.</div>
        @endif
      </div>
      <div class="modal-footer">
        @if(!empty($labDoc?->sk_sop_file))
          <a class="btn btn-success" href="{{ route('dokumenlab.download','sk') }}">
            <i class="bi bi-download me-1"></i> Download
          </a>
        @endif
        <button class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>

<!-- 🔹 SECTION 2: Parameter Uji Kualitas Air -->
<section class="py-5" style="background: linear-gradient(to bottom, #f8fff8, #e9f7ef);">
  <div class="container">
    <h3 class="text-center mb-4 fw-bold" style="color: #189e1e">Parameter Kualitas Air</h3>

    <div class="row justify-content-center">
      <div class="col-lg-10">
        <ul class="list-group list-group-flush shadow-sm rounded-4 bg-white p-4">

          <!-- 1. Suhu -->
          <li class="list-group-item border-0 border-bottom py-3">
            <div class="row align-items-center">
              <div class="col-md-4 d-flex align-items-center">
                <i class="bi bi-thermometer-half fs-4 me-2" style="color: #189e1e"></i>
                <strong>Suhu (Temperature)</strong>
              </div>
              <div class="col-md-8">
                <span class="text-muted">Mengukur tingkat panas air untuk mengetahui kestabilan ekosistem perairan.</span>
              </div>
            </div>
          </li>

          <!-- 2. pH -->
          <li class="list-group-item border-0 border-bottom py-3">
            <div class="row align-items-center">
              <div class="col-md-4 d-flex align-items-center">
                <i class="bi bi-droplet fs-4 me-2" style="color: #189e1e"></i>
                <strong>pH (Derajat Keasaman)</strong>
              </div>
              <div class="col-md-8">
                <span class="text-muted">Menunjukkan keseimbangan asam dan basa dalam air.</span>
              </div>
            </div>
          </li>

          <!-- 3. DO -->
          <li class="list-group-item border-0 border-bottom py-3">
            <div class="row align-items-center">
              <div class="col-md-4 d-flex align-items-center">
                <i class="bi bi-cloud-fog fs-4 me-2" style="color: #189e1e"></i>
                <strong>DO (Oksigen Terlarut)</strong>
              </div>
              <div class="col-md-8">
                <span class="text-muted">Menilai kemampuan air mendukung kehidupan organisme akuatik.</span>
              </div>
            </div>
          </li>

          <!-- 4. TSS -->
          <li class="list-group-item border-0 border-bottom py-3">
            <div class="row align-items-center">
              <div class="col-md-4 d-flex align-items-center">
                <i class="bi bi-filter-square fs-4 me-2" style="color: #189e1e"></i>
                <strong>TSS (Padatan Tersuspensi Total)</strong>
              </div>
              <div class="col-md-8">
                <span class="text-muted">Mengukur jumlah partikel padat yang mengambang di air.</span>
              </div>
            </div>
          </li>

          <!-- 5. TDS -->
          <li class="list-group-item border-0 border-bottom py-3">
            <div class="row align-items-center">
              <div class="col-md-4 d-flex align-items-center">
                <i class="bi bi-bezier fs-4 me-2" style="color: #189e1e"></i>
                <strong>TDS (Padatan Terlarut Total)</strong>
              </div>
              <div class="col-md-8">
                <span class="text-muted">Menentukan jumlah zat terlarut yang dapat memengaruhi rasa dan kejernihan air.</span>
              </div>
            </div>
          </li>

          <!-- 6. COD -->
          <li class="list-group-item border-0 border-bottom py-3">
            <div class="row align-items-center">
              <div class="col-md-4 d-flex align-items-center">
                <i class="bi bi-lightning fs-4 me-2" style="color: #189e1e"></i>
                <strong>COD (Kebutuhan Oksigen Kimiawi)</strong>
              </div>
              <div class="col-md-8">
                <span class="text-muted">Mengukur jumlah oksigen yang dibutuhkan untuk menguraikan bahan kimia organik dalam air.</span>
              </div>
            </div>
          </li>

          <!-- 7. BOD -->
          <li class="list-group-item border-0 border-bottom py-3">
            <div class="row align-items-center">
              <div class="col-md-4 d-flex align-items-center">
                <i class="bi bi-heart-pulse fs-4 me-2" style="color: #189e1e"></i>
                <strong>BOD (Kebutuhan Oksigen Biologis)</strong>
              </div>
              <div class="col-md-8">
                <span class="text-muted">Menunjukkan jumlah oksigen yang diperlukan mikroorganisme untuk menguraikan bahan organik di air.</span>
              </div>
            </div>
          </li>

          <!-- 8. Nitrit -->
          <li class="list-group-item border-0 border-bottom py-3">
            <div class="row align-items-center">
              <div class="col-md-4 d-flex align-items-center">
                <i class="bi bi-droplet-half fs-4 me-2" style="color: #189e1e"></i>
                <strong>Nitrit (NO₂⁻)</strong>
              </div>
              <div class="col-md-8">
                <span class="text-muted">Indikator awal adanya pencemaran dari limbah organik.</span>
              </div>
            </div>
          </li>

          <!-- 9. Nitrat -->
          <li class="list-group-item border-0 border-bottom py-3">
            <div class="row align-items-center">
              <div class="col-md-4 d-flex align-items-center">
                <i class="bi bi-water fs-4 me-2" style="color: #189e1e"></i>
                <strong>Nitrat (NO₃⁻)</strong>
              </div>
              <div class="col-md-8">
                <span class="text-muted">Parameter penting dalam menilai tingkat kesuburan dan eutrofikasi air.</span>
              </div>
            </div>
          </li>

          <!-- 10. Total Fosfat -->
          <li class="list-group-item border-0 border-bottom py-3">
            <div class="row align-items-center">
              <div class="col-md-4 d-flex align-items-center">
                <i class="bi bi-recycle fs-4 me-2" style="color: #189e1e"></i>
                <strong>Total Fosfat (PO₄³⁻)</strong>
              </div>
              <div class="col-md-8">
                <span class="text-muted">Berhubungan dengan pertumbuhan alga berlebihan di perairan.</span>
              </div>
            </div>
          </li>

          <!-- 11. Amonia -->
          <li class="list-group-item border-0 border-bottom py-3">
            <div class="row align-items-center">
              <div class="col-md-4 d-flex align-items-center">
                <i class="bi bi-exclamation-octagon fs-4 me-2" style="color: #189e1e"></i>
                <strong>Amonia (NH₃)</strong>
              </div>
              <div class="col-md-8">
                <span class="text-muted">Menjadi indikator pencemaran dari limbah domestik atau pupuk pertanian.</span>
              </div>
            </div>
          </li>

         <!-- 12. dan parameter lainnya -->
        <li class="list-group-item border-0 py-3">
          <div class="row align-items-center">
            <div class="col-md-4 d-flex align-items-center">
              <i class="bi bi-list-check fs-4 me-2" style="color: #189e1e"></i>
              <strong>Dan Parameter Lainnya</strong>
            </div>
            <div class="col-md-8">
              <span class="text-muted">
                Parameter tambahan lainnya yang mendukung analisis kualitas air secara komprehensif.
              </span>
            </div>
          </div>
        </li>
        </ul>
      </div>
    </div>
  </div>
</section>
</body>
</html>
@endsection
