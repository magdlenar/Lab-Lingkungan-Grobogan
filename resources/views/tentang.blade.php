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


<style>
/* ===================== ORG CHART (RAPI + NYAMBUNG) ===================== */
/* ===== ORG CHART (match sketsa) ===== */
:root{
  --line:#1fb726;
  --bg:#e9f7ef;
  --card:#fff;
  --border:rgba(24,158,30,.18);
  --shadow:0 10px 22px rgba(0,0,0,.06);

  --w-lg:240px;
  --w-sm:220px;

  --gap-x:48px;   /* jarak antar kolom */
  --gap-y:26px;   /* jarak vertikal antar level */
  --split-y:20px; /* jarak ke garis split */
  --stroke:2px;
}

.org-wrap{
  width:100%;
  overflow: visible;        /* jangan scroll */
  padding-bottom:0;
}

.org{
  width:100%;               /* ikut container */
  max-width:1100px;         /* batas desktop */
  margin:0 auto;
  position:relative;
  padding: 40px 0 30px;     /* ✅ ruang atas buat avatar agar gak kepotong */
}

/* ✅ kalau layar kecil, skala chart biar tetap muat */
@media (max-width: 1100px){
  .org{
    transform: scale(calc(100vw / 1100));
    transform-origin: top center;
    width:1100px;           /* basis ukuran */
    max-width:none;
    margin:0 auto;
  }
  /* supaya tinggi container mengikuti scaling (biar gak kepotong bawah) */
  .org-wrap{
    padding-bottom: 40px;
  }
}

/* NODE */
.node{
  position:relative;
  background:var(--card);
  border:1px solid var(--border);
  border-radius:14px;
  box-shadow:var(--shadow);
  text-align:center;
  overflow:visible;
}
.node.lg{ width:var(--w-lg); padding:52px 16px 16px; }
.node.sm{ width:var(--w-sm); padding:44px 14px 14px; }

.ava{
  width:60px;height:60px;
  border-radius:999px;
  object-fit:cover;
  border:4px solid var(--bg);
  background:#fff;
  position:absolute;
  top:-30px; left:50%;
  transform:translateX(-50%);
  z-index:5;
  display:block;
}

.role{
  display:inline-block;
  padding:4px 10px;
  border-radius:999px;
  border:1px solid rgba(24,158,30,.25);
  color:#0b6b10;
  font-weight:800;
  font-size:13px;
  line-height:1.2;
}
.name{
  margin-top:10px;
  font-weight:800;
  font-size:14px;
  color:#0f172a;
}
.namelist .name{ margin-top:6px; }

/* ===== LEVEL 1 (TOP) ===== */
.lvl1{
  display:flex;
  justify-content:center;
  position:relative;
  padding-bottom: var(--gap-y);
}
.lvl1::after{
  content:"";
  position:absolute;
  left:50%;
  transform:translateX(-50%);
  bottom:0;
  width:var(--stroke);
  height:var(--gap-y);
  background:var(--line);
}

/* ===== LEVEL 2 (3 kolom) ===== */
.lvl2{
  position:relative;
  display:flex;
  justify-content:center;
  gap:var(--gap-x);
  padding-top: var(--gap-y);  /* ruang untuk garis utama */
}

/* garis utama horizontal yang menghubungkan 3 manajer */
  .lvl2::before{
  content:"";
    position:absolute;
    top:0;

    /* ✅ garis menyentuh manajer kiri & kanan */
    left: calc(50% - (var(--w-lg) + var(--gap-x)) - 400px);
    right: calc(50% - (var(--w-lg) + var(--gap-x)) - 300px);

    height:var(--stroke);
    background:var(--line);
  }

.col{
  position:relative;
  display:flex;
  flex-direction:column;
  align-items:center;
  gap:var(--gap-y);
  padding-top:0;
}

/* konektor dari garis utama ke setiap manajer level 2 */
.col > .node.lg::before{
  content:"";
  position:absolute;
  left:50%;
  transform:translateX(-50%);
  top: calc(-1 * var(--gap-y));
  width:var(--stroke);
  height:var(--gap-y);
  background:var(--line);
}

/* ===== MUTU: Manajer Mutu -> Staf Mutu (garis lurus) ===== */
.col-mutu .node.lg::after{
  content:"";
  position:absolute;
  left:50%;
  transform:translateX(-50%);
  bottom: calc(-1 * var(--gap-y));
  width:var(--stroke);
  height:var(--gap-y);
  background:var(--line);
}
.col-mutu .node.sm::before{
  content:"";
  position:absolute;
  left:50%;
  transform:translateX(-50%);
  top: calc(-1 * var(--gap-y));
  width:var(--stroke);
  height:var(--gap-y);
  background:var(--line);
}

/* ===== ROW SPLIT (percabangan 2 box) ===== */
.row-split{
  position:relative;
  display:flex;
  justify-content:center;
  gap:22px;
  padding-top: var(--split-y); /* ruang garis split */
}
.row-split::before{
  content:"";
  position:absolute;
  top:0;
  left:8%;
  right:8%;
  height:var(--stroke);
  background:var(--line);
}
.row-split > .child{
  position:relative;
}
.row-split > .child::before{
  content:"";
  position:absolute;
  top:0;
  left:50%;
  transform:translateX(-50%);
  width:var(--stroke);
  height:var(--split-y);
  background:var(--line);
}

/* konektor dari parent (manajer teknis/admin) ke garis split */
.has-split > .node.lg::after{
  content:"";
  position:absolute;
  left:50%;
  transform:translateX(-50%);
  bottom: calc(-1 * var(--split-y));
  width:var(--stroke);
  height:var(--split-y);
  background:var(--line);
}

/* ===== penyelia punya sub-split (analis + sampling) ===== */
.branch{
  display:flex;
  flex-direction:column;
  align-items:center;
}

.branch.has-sub > .node.sm::after{
  content:"";
  position:absolute;
  left:50%;
  transform:translateX(-50%);
  bottom: calc(-1 * var(--split-y));
  width:var(--stroke);
  height:var(--split-y);
  background:var(--line);
}

.sub-split{
  position:relative;
  margin-top: 14px;
  padding-top: var(--split-y);
  display:flex;
  justify-content:center;
  gap:18px;
  width: calc(var(--w-sm) * 2 + 18px);
}
.sub-split::before{
  content:"";
  position:absolute;
  top:0;
  left:0;
  right:0;
  height:var(--stroke);
  background:var(--line);
}
.sub-split > .node.sm::before{
  content:"";
  position:absolute;
  top:0;
  left:50%;
  transform:translateX(-50%);
  width:var(--stroke);
  height:var(--split-y);
  background:var(--line);
}

/* responsive: cukup scroll horizontal */
@media (max-width: 992px){
  .org-wrap{ overflow-x:auto; }
}

</style>
</head>

<body>

<!-- 🔹 SECTION 1: Profil Dinas -->
<section class="py-5" style="background: linear-gradient(to bottom, #f0fff4, #ffffff);">
  <div class="container text-center mb-5">
    <h1 class="fw-bold display-5">
      <span class="" style="color: #189e1e">Profil Laboratorium Lingkungan</span>
    </h1>
    <p class="text-muted mt-3 fs-5">
      Solusi untuk Kualitas Lingkungan Hidup
    </p>
  </div>

<div class="container">
  <div class="row align-items-center g-5">
    <!-- Kolom gambar (sekarang di kiri) -->
    <div class="col-md-6 text-center order-1 order-md-1">
      <div id="profilCarousel" class="carousel slide shadow-lg rounded-4" data-bs-ride="carousel" data-bs-interval="3000" style="max-width: 80%; margin: 0 auto;">
        <div class="carousel-inner rounded-4">
          <div class="carousel-item active">
            <img src="{{ asset('images/hero-4.jpg') }}" class="d-block w-100 rounded-4" alt="Profil DLH 1">
          </div>
          <div class="carousel-item">
            <img src="{{ asset('images/hero-5.jpg') }}" class="d-block w-100 rounded-4" alt="Profil DLH 2">
          </div>
          <div class="carousel-item">
            <img src="{{ asset('images/hero-6.jpg') }}" class="d-block w-100 rounded-4" alt="Profil DLH 3">
          </div>
        </div>

        <!-- Tombol navigasi -->
        <button class="carousel-control-prev" type="button" data-bs-target="#profilCarousel" data-bs-slide="prev">
          <span class="carousel-control-prev-icon bg-dark rounded-circle p-2" aria-hidden="true"></span>
          <span class="visually-hidden">Sebelumnya</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#profilCarousel" data-bs-slide="next">
          <span class="carousel-control-next-icon bg-dark rounded-circle p-2" aria-hidden="true"></span>
          <span class="visually-hidden">Selanjutnya</span>
        </button>
      </div>
    </div>

    <!-- Kolom teks (sekarang di kanan) -->
    <div class="col-md-6 text-start order-2 order-md-2">
      <h2 class="fw-bold mb-4" style="font-size: 2rem;">Apa itu Laboratorium Lingkungan?</h2>
      <p class="text-muted mb-3" style="font-size: 1.15rem; line-height: 1.8; text-align: justify;">
        Laboratorium lingkungan di bawah naungan Dinas Lingkungan Hidup (DLH) yang berfungsi melakukan kegiatan pengujian dan analisis terhadap kualitas lingkungan hidup, meliputi air, udara, limbah, serta parameter lingkungan lainnya. Laboratorium ini berperan sebagai sarana pendukung DLH dalam pelaksanaan pengawasan, pengendalian pencemaran, dan pengelolaan lingkungan hidup berdasarkan ketentuan peraturan perundang-undangan.
      </p>
  
    </div>
  </div>
</div>
</section>

<!-- 🔹 SECTION 1.5: VISI & MISI -->
<section class="py-5" style="background-color: #e9f7ef;">
  <div class="container">
    <div class="text-center mb-5">
      <h2 class="fw-bold" style="color: #189e1e">Visi dan Misi</h2>
      <p class="text-muted mx-auto" style="max-width: 700px;">
        Visi dan misi Laboratorum Lingkungan Dinas Lingkungan Hidup Kabupaten Grobogan menjadi arah dan pedoman dalam mewujudkan tata kelola lingkungan yang berkelanjutan.
      </p>
    </div>

    <div class="row justify-content-center">
      <div class="col-lg-10">
        <div class="bg-white rounded shadow-sm p-4">
          <h5 class="fw-bold text-success mb-3"><i class="bi bi-eye-fill me-2"></i>Visi</h5>
          <p class="text-muted mb-4">Menjadikan Laboratorium Lingkungan yang mendukung pengelolaan lingkungan hidup dalam rangka terwujudnya peningkatan kualitas dan fungsi lingkungan yang berkelanjutan.
          </p>

          <h5 class="fw-bold text-success mb-3">
            <i class="bi bi-bullseye me-2"></i>Misi
          </h5>
          <ul class="list-group list-group-flush">
            <li class="list-group-item py-3">
              <i class="bi bi-check-circle-fill text-success me-2"></i>
              Meningkatkan kompetensi personil laboratorium dalam pengujian kualitas lingkungan.
            </li>
            <li class="list-group-item py-3">
              <i class="bi bi-check-circle-fill text-success me-2"></i>
              Menerapkan pengujian sampel kualitas lingkungan sesuai metode SNI dan metode standar lainnya.
            </li>
            <li class="list-group-item py-3">
              <i class="bi bi-check-circle-fill text-success me-2"></i>
              Mengutamakan pelayanan prima melalui penyajian data dan informasi yang cepat, tepat, akurat, dan terpercaya.
            </li>
            <li class="list-group-item py-3">
              <i class="bi bi-check-circle-fill text-success me-2"></i>
              Meningkatkan mutu laboratorium lingkungan dengan pengelolaan secara profesional mengacu pada Sistem Manajemen Mutu Laboratorium Pengujian SNI ISO/IEC 17025:2017 agar tercapai efisiensi dan efektivitas.
            </li>
            <li class="list-group-item py-3">
              <i class="bi bi-check-circle-fill text-success me-2"></i>
              Melakukan koordinasi dengan Pemerintahan Pusat, Dinas/Instansi Pemerintahan Provinsi, dan Pemerintahan Kabupaten/Kota.
            </li>
            <li class="list-group-item py-3">
              <i class="bi bi-check-circle-fill text-success me-2"></i>
              Menjalin kerja sama dengan Perguruan Tinggi, Laboratorium Lingkungan lainnya, serta swasta dan industri.
            </li>
            <li class="list-group-item py-3">
              <i class="bi bi-check-circle-fill text-success me-2"></i>
              Melakukan upaya berkelanjutan untuk meningkatkan kualitas mutu layanan kepada pelanggan.
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- 🔹 SECTION 2: Kebijakan Mutu -->
<section class="py-5 bg-white">
  <div class="container">
    <div class="text-center mb-5">
      <h2 class="fw-bold" style="color: #189e1e">Kebijakan Mutu</h2>
      <p class="text-muted mx-auto" style="max-width: 750px;">
        Laboratorium Lingkungan Dinas Lingkungan Hidup Kabupaten Grobogan Laboratorium Lingkungan Kabupaten Grobogan berupaya untuk terus menerus:
      </p>
    </div>

    <div class="row justify-content-center">
      <div class="col-lg-10">
        <ul class="list-group list-group-flush shadow-sm rounded">
          <li class="list-group-item py-3">
          <i class="bi bi-check-circle-fill text-success me-2"></i>
          Manajemen laboratorium berkomitmen untuk menjalankan operasional laboratorium lingkungan secara profesional.
        </li>

        <li class="list-group-item py-3">
          <i class="bi bi-check-circle-fill text-success me-2"></i>
          Manajemen laboratorium berkomitmen untuk selalu meningkatkan mutu pengujian demi kepuasan pelanggan.
        </li>

        <li class="list-group-item py-3">
          <i class="bi bi-check-circle-fill text-success me-2"></i>
          Manajemen laboratorium berkomitmen untuk menetapkan dan menerapkan sistem manajemen mutu dalam pelaksanaan pekerjaan secara rutin.
        </li>

        <li class="list-group-item py-3">
          <i class="bi bi-check-circle-fill text-success me-2"></i>
          Semua personel laboratorium dipastikan memahami dokumentasi sistem manajemen mutu sesuai dengan ISO/IEC 17025:2017.
        </li>

        <li class="list-group-item py-3">
          <i class="bi bi-check-circle-fill text-success me-2"></i>
          Semua personel laboratorium dipastikan bebas dari berbagai tekanan.
        </li>

        <li class="list-group-item py-3">
          <i class="bi bi-check-circle-fill text-success me-2"></i>
          Manajemen laboratorium berkomitmen menerapkan keselamatan dan kesehatan kerja serta melakukan pengelolaan limbah laboratorium.
        </li>

        <li class="list-group-item py-3">
          <i class="bi bi-check-circle-fill text-success me-2"></i>
          Manajemen laboratorium berkomitmen menjalankan program <em>continuous improvement</em> untuk meningkatkan efektivitas sistem manajemen laboratorium.
        </li>

        </ul>
      </div>
    </div>
  </div>
</section>

    {{-- STRUKTUR ORGANISASI --}}
    {{-- @php
      use Illuminate\Support\Facades\Storage;
    @endphp --}}

<section class="py-5" style="background-color:#e9f7ef;">
  <div class="container text-center">
    <h2 class="fw-bold mb-2" style="color:#189e1e">Struktur Organisasi</h2>
    <p class="text-muted mb-4">Bagan struktur organisasi Laboratorium Lingkungan.</p>

    @php
      $top = $items->whereNull('parent_id')->sortBy('urutan')->first();

      $lvl2 = $top?->children?->keyBy('jabatan') ?? collect();
      $mutu   = $lvl2['Manajer Mutu'] ?? null;
      $teknis = $lvl2['Manajer Teknis'] ?? null;
      $admin  = $lvl2['Manajer Administrasi'] ?? null;

      $stafMutuList = $mutu?->children?->where('jabatan','Staf Mutu')->sortBy('urutan')->values() ?? collect();

      $penyelia = $teknis?->children?->firstWhere('jabatan','Penyelia');
      $k3lList  = $teknis?->children?->where('jabatan','Petugas K3L')->sortBy('urutan')->values() ?? collect();

      $stafAdmin  = $admin?->children?->firstWhere('jabatan','Staf Administrasi');
      $penerimaCU = $admin?->children?->where('jabatan','Penerima Contoh Uji')->sortBy('urutan')->values() ?? collect();

      $analisList   = $penyelia?->children?->where('jabatan','Analis')->sortBy('urutan')->values() ?? collect();
      $samplingList = $penyelia?->children?->where('jabatan','Petugas Sampling')->sortBy('urutan')->values() ?? collect();
    @endphp

    @if($top)
      <div class="org-wrap">
        <div class="org">

          {{-- LEVEL 1 --}}
          <div class="lvl1">
            <div class="node lg">
              <img class="ava" src="{{ asset('images/default-user.png') }}" alt="foto">
              <div class="role">{{ $top->jabatan }}</div>
              <div class="name">{{ $top->nama }}</div>
            </div>
          </div>

          {{-- LEVEL 2 --}}
          <div class="lvl2">

            {{-- MUTU --}}
            <div class="col col-mutu">
              @if($mutu)
                <div class="node lg">
                  <img class="ava" src="{{ asset('images/default-user.png') }}" alt="foto">
                  <div class="role">{{ $mutu->jabatan }}</div>
                  <div class="name">{{ $mutu->nama }}</div>
                </div>
              @endif

              @if($stafMutuList->count())
                <div class="node sm">
                  <img class="ava" src="{{ asset('images/default-user.png') }}" alt="foto">
                  <div class="role">Staf Mutu</div>
                  <div class="namelist">
                    @foreach($stafMutuList as $sm)
                      <div class="name">{{ $sm->nama }}</div>
                    @endforeach
                  </div>
                </div>
              @endif
            </div>

            {{-- TEKNIS --}}
            <div class="col has-split">
              @if($teknis)
                <div class="node lg">
                  <img class="ava" src="{{ asset('images/default-user.png') }}" alt="foto">
                  <div class="role">{{ $teknis->jabatan }}</div>
                  <div class="name">{{ $teknis->nama }}</div>
                </div>
              @endif

              <div class="row-split">
                @if($penyelia)
                  <div class="child">
                    <div class="branch {{ ($analisList->count() || $samplingList->count()) ? 'has-sub' : '' }}">
                      <div class="node sm">
                        <img class="ava" src="{{ asset('images/default-user.png') }}" alt="foto">
                        <div class="role">{{ $penyelia->jabatan }}</div>
                        <div class="name">{{ $penyelia->nama }}</div>
                      </div>

                      @if($analisList->count() || $samplingList->count())
                        <div class="sub-split">
                          @if($analisList->count())
                            <div class="node sm">
                              <img class="ava" src="{{ asset('images/default-user.png') }}" alt="foto">
                              <div class="role">Analis</div>
                              <div class="namelist">
                                @foreach($analisList as $a)
                                  <div class="name">{{ $a->nama }}</div>
                                @endforeach
                              </div>
                            </div>
                          @endif

                          @if($samplingList->count())
                            <div class="node sm">
                              <img class="ava" src="{{ asset('images/default-user.png') }}" alt="foto">
                              <div class="role">Petugas Sampling</div>
                              <div class="namelist">
                                @foreach($samplingList as $s)
                                  <div class="name">{{ $s->nama }}</div>
                                @endforeach
                              </div>
                            </div>
                          @endif
                        </div>
                      @endif
                    </div>
                  </div>
                @endif

                @if($k3lList->count())
                  <div class="child">
                    <div class="node sm">
                      <img class="ava" src="{{ asset('images/default-user.png') }}" alt="foto">
                      <div class="role">Petugas K3L</div>
                      <div class="namelist">
                        @foreach($k3lList as $k)
                          <div class="name">{{ $k->nama }}</div>
                        @endforeach
                      </div>
                    </div>
                  </div>
                @endif
              </div>
            </div>

            {{-- ADMINISTRASI --}}
            <div class="col has-split">
              @if($admin)
                <div class="node lg">
                 <img class="ava" src="{{ asset('images/default-user.png') }}" alt="foto">
                  <div class="role">{{ $admin->jabatan }}</div>
                  <div class="name">{{ $admin->nama }}</div>
                </div>
              @endif

              <div class="row-split">
                @if($penerimaCU->count())
                  <div class="child">
                    <div class="node sm">
                      <img class="ava" src="{{ asset('images/default-user.png') }}" alt="foto">
                      <div class="role">Penerima Contoh Uji</div>
                      <div class="namelist">
                        @foreach($penerimaCU as $p)
                          <div class="name">{{ $p->nama }}</div>
                        @endforeach
                      </div>
                    </div>
                  </div>
                @endif

                @if($stafAdmin)
                  <div class="child">
                    <div class="node sm">
                      <img class="ava" src="{{ asset('images/default-user.png') }}" alt="foto">
                      <div class="role">{{ $stafAdmin->jabatan }}</div>
                      <div class="name">{{ $stafAdmin->nama }}</div>
                    </div>
                  </div>
                @endif
              </div>
            </div>

          </div>
        </div>
      </div>
    @endif
  </div>
</section>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
@endsection
