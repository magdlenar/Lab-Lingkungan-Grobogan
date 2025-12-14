@extends('layouts.app')
@section('title','Indeks Kualitas Air (IKA)')

@section('content')
<style>
/* ===================== PUBLIC IKA TABLE — MODERN, RAPI, NO H-SCROLL DESKTOP ===================== */
:root{
  --g-green:#189e1e;
  --g-border:#eef1f5;
  --g-muted:#64748b;
  --g-text:#0f172a;
  --g-soft:#f0fdf4;
  --g-soft-blue:#eef6ff;
  --g-page:#f6f8fb;          /* NEW: background halaman */
  --g-page-grad:#eef2f7;     /* NEW: biar ada depth */
}

/* ===== PAGE BACKGROUND (biar beda sama footer) ===== */
.page-bg{
  background:
    radial-gradient(1200px circle at 50% -10%, #ffffff 0%, transparent 55%),
    linear-gradient(180deg, var(--g-page) 0%, var(--g-page-grad) 100%);
  padding: 10px 0 34px; /* jarak atas-bawah biar lega */
  min-height: calc(100vh - 120px); /* optional, biar area konten keliatan penuh */
}

/* wrapper */
.wrap{padding:24px 0 32px;}

/* ===== HERO ===== */
.hero{
  position:relative;
  background:
    radial-gradient(800px circle at 0% 0%, #dcfce7 0%, transparent 55%),
    radial-gradient(700px circle at 100% 0%, #e0f2fe 0%, transparent 55%),
    #ffffff;
  border:1px solid var(--g-border);
  border-radius:20px;
  padding:18px;
  box-shadow:0 10px 28px rgba(0,0,0,.06);
  margin-bottom:14px;
}
.hero .badge-hero{
  display:inline-flex;align-items:center;gap:6px;
  background:#0f172a;color:#fff;font-weight:800;
  font-size:12px;border-radius:999px;padding:4px 10px;
}
.hero h3{font-weight:900;color:var(--g-text);margin:8px 0 2px;}
.hero p{color:var(--g-muted);margin:0;font-size:14px;}
.hero .hero-row{
  display:flex;align-items:center;justify-content:space-between;gap:10px;flex-wrap:wrap;
}

/* ===== SEARCH BOX ===== */
.search-box{
  background:#fff;border:1px solid var(--g-border);border-radius:14px;padding:6px 8px;
  display:flex;gap:8px;align-items:center;
  box-shadow:0 6px 18px rgba(0,0,0,.05);
}
.search-box input{border:none;outline:none;width:100%;font-size:14px;}
.search-box button{
  background:var(--g-green);color:#fff;border:none;border-radius:10px;
  padding:7px 12px;font-weight:800;white-space:nowrap;
}
.search-box button:hover{filter:brightness(1.05);}

/* ===== TABLE WRAPPER ===== */
.modern-table-wrapper{
  background:#fff;border-radius:22px;
  box-shadow:0 8px 25px rgba(0,0,0,.05);
  width:100%;
  border:1px solid var(--g-border);
  overflow-x:visible; /* DESKTOP: no horizontal scroll */
}

/* ===== TABLE ===== */
.modern-table{
  width:100%;
  border-collapse:separate;
  border-spacing:0;
}
.modern-table thead{ background:#f3f8ff; }
.modern-table thead th{
  padding:12px 10px;font-weight:800;color:#40566e;
  font-size:13px;border-bottom:1px solid #e8eef5;
  white-space:normal;
  vertical-align:middle;
  line-height:1.25;
}
.modern-table thead tr.group th{
  font-size:12px;text-transform:uppercase;letter-spacing:.3px;background:#eef6ff;
}
.modern-table tbody tr:nth-child(even){ background:#f9fbfd; }
.modern-table tbody tr:hover{ background:#eef6ff;transition:.2s; }
.modern-table tbody td{
  padding:10px 10px;font-size:13.5px;color:#0f172a;
  white-space:normal;
  vertical-align:top;
  line-height:1.35;
  border-bottom:1px dashed #f1f5f9;
}
.modern-table tbody tr:last-child td{ border-bottom:none; }

/* make key columns slightly emphasized */
td.col-kode{font-weight:800;}
td.col-alamat{min-width:220px;}
td.col-sungai{font-weight:700;color:#166534;}
td.col-meta{color:#334155;}

/* BADGE NUMBER */
.num-badge{
  width:30px;height:30px;border-radius:50%;
  background:#eef4ff;color:#189e1e;font-weight:800;
  display:flex;align-items:center;justify-content:center;
  border:2px solid #dfe8ff;font-size:12.5px;
  margin:auto;
}

/* CHIP / BADGE SOFT */
.badge-soft{
  display:inline-flex;align-items:center;gap:6px;
  background:#f0fdf4;color:#166534;border:1px solid #bbf7d0;
  font-weight:900;font-size:12px;border-radius:999px;padding:3px 8px;
}

/* small pill for coords */
.coord-pill{
  display:inline-flex;gap:6px;align-items:center;flex-wrap:wrap;
  font-size:12px;color:#0f172a;font-weight:700;
}
.coord-pill .sub{
  font-size:10.5px;font-weight:900;color:#0f172a;
  background:#f8fafc;border:1px dashed #e2e8f0;padding:1px 5px;border-radius:7px;
}

/* ===== MOBILE ONLY helpers ===== */
.hide-mobile{ display: table-cell; }
.mobile-only{ display:none; }

/* detail button (mobile only) */
.mobile-detail-btn{
  display:none;
  padding:7px 10px;border-radius:10px;font-size:12.5px;font-weight:900;
  background:#0f172a;color:#fff;border:none;width:100%;
}

/* detail collapse mobile */
.mobile-detail-wrap{
  background:#f8fafc;border:1px dashed #e2e8f0;border-radius:10px;
  padding:10px;margin-top:8px;font-size:13px;color:#0f172a;
}
.mobile-detail-wrap .label{
  font-size:11px;color:#64748b;font-weight:900;text-transform:uppercase;
  letter-spacing:.2px;margin-bottom:4px;
}
.mobile-detail-grid{
  display:grid;grid-template-columns:1fr 1fr;gap:6px 10px;
}
.mobile-detail-item{
  background:#fff;border:1px solid #eef1f5;border-radius:8px;padding:6px 8px;
}
.mobile-detail-item .k{ font-size:11px;color:#94a3b8;font-weight:800; }
.mobile-detail-item .v{ font-weight:900;color:#0f172a;font-size:13px; }

/* ===== PAGINATION ===== */
.pagination-modern-wrap nav{display:flex;justify-content:center;}
.pagination-modern-wrap .pagination{
  gap:6px;padding:6px 10px;background:#fff;border-radius:999px;
  box-shadow:0 6px 18px rgba(0,0,0,.06);border:1px solid #eef1f5;
}
.pagination-modern-wrap .page-link{
  width:32px;height:32px;display:flex;align-items:center;justify-content:center;
  font-size:13px;background:#f1f5f9;border:none;color:#475569;font-weight:800;
  border-radius:10px!important;transition:.18s;
}
.pagination-modern-wrap .page-item.active .page-link{
  background:var(--g-green)!important;color:#fff!important;
  box-shadow:0 4px 10px rgba(24,158,30,.25);
}

/* ===== TABLET ===== */
@media(max-width:992px){
  .modern-table thead th{font-size:12.5px;padding:10px 8px;}
  .modern-table tbody td{font-size:13px;padding:9px 8px;}
}

/* ===== MOBILE MODE ===== */
@media(max-width:576px){
  .modern-table-wrapper{ overflow-x:auto; }
  .modern-table thead{ display:none; }

  .modern-table tbody tr{
    display:block;margin-bottom:12px;background:#fff;border-radius:12px;
    padding:10px 12px;box-shadow:0 3px 8px rgba(0,0,0,.05);overflow:hidden;
  }
  .modern-table tbody td{
    display:flex;justify-content:space-between;align-items:flex-start;gap:10px;width:100%;
    white-space:normal;overflow-wrap:anywhere;word-break:break-word;
    padding:8px 6px;font-size:13.5px;border-bottom:1px solid #f0f0f0;
  }
  .modern-table tbody td:last-child{ border-bottom:none; }
  .modern-table tbody td::before{
    content:attr(data-label);font-weight:700;color:#475569;
    flex:0 0 45%;max-width:45%;overflow-wrap:anywhere;
  }

  .modern-table tbody td.hide-mobile{ display:none !important; }
  .mobile-only{ display:block; }

  .modern-table tbody td[data-label="Aksi"]{
    flex-direction:column;align-items:stretch;gap:6px;
  }
  .mobile-detail-btn{ display:inline-block; }
}
</style>

{{-- NEW: pembungkus background halaman --}}
<div class="page-bg">
  <div class="container wrap">
    <div class="hero">
      <div class="hero-row">
        <span class="badge-hero">
          <i class="bi bi-droplet-half"></i> Data Resmi Laboratorium
        </span>
        <div class="text-muted small">
          <i class="bi bi-arrow-repeat me-1"></i> Diperbarui berkala
        </div>
      </div>
      <h3>Indeks Kualitas Air (IKA)</h3>
      <p>Publikasi mutu air sungai kabupaten/kota. Data bersumber dari hasil uji laboratorium.</p>
    </div>

    <form method="GET" class="mb-3">
      <div class="search-box">
        <i class="bi bi-search text-muted"></i>
        <input type="text" name="search" value="{{ request('search') }}"
               placeholder="Cari kode lokasi / alamat / sungai...">
        <button type="submit"><i class="bi bi-search me-1"></i>Cari</button>
      </div>
    </form>

    <div class="modern-table-wrapper">
      <table class="table modern-table align-middle mb-0">
        <thead>
          <tr class="group">
            <th rowspan="2" style="width:60px;">No</th>
            <th rowspan="2">Kode Lokasi</th>
            <th rowspan="2">Alamat</th>
            <th rowspan="2">Sungai</th>
            <th rowspan="2">Tanggal</th>
            <th rowspan="2">Kategori</th>

            <th colspan="2" class="text-center">Koordinat</th>
            <th colspan="4" class="text-center">Status Mutu</th>

            <th rowspan="2" class="mobile-only text-center" style="width:140px;">Aksi</th>
          </tr>
          <tr>
            <th class="text-center">Latitude</th>
            <th class="text-center">Longitude</th>
            <th class="text-center">Kelas 1</th>
            <th class="text-center">Kelas 2</th>
            <th class="text-center">Kelas 3</th>
            <th class="text-center">Kelas 4</th>
          </tr>
        </thead>

        <tbody>
        @forelse($ikas as $i)
          @php $collapseId = 'detailIkaPublic'.$i->id; @endphp
          <tr>
            <td data-label="No">
              <div class="num-badge">
                {{ $loop->iteration + ($ikas->currentPage()-1)*$ikas->perPage() }}
              </div>
            </td>

            <td data-label="Kode Lokasi" class="col-kode">
              {{ $i->kode_lokasi }}
            </td>

            <td data-label="Alamat" class="col-alamat">
              {{ $i->alamat }}
            </td>

            <td data-label="Sungai" class="col-sungai">
              {{ $i->sungai ?? '-' }}
            </td>

            <td data-label="Tanggal" class="hide-mobile col-meta">
              {{ optional($i->tanggal)->translatedFormat('d F Y') ?? '-' }}
            </td>
            <td data-label="Kategori" class="hide-mobile col-meta">
              {{ $i->kategori ?? '-' }}
            </td>

            <td data-label="Latitude" class="hide-mobile">
              <div class="coord-pill"><span class="sub">Lat</span>{{ $i->latitude ?? '-' }}</div>
            </td>
            <td data-label="Longitude" class="hide-mobile">
              <div class="coord-pill"><span class="sub">Long</span>{{ $i->longitude ?? '-' }}</div>
            </td>

            <td data-label="Kelas 1" class="hide-mobile">
              <span class="badge-soft">{{ $i->kelas1 ?? '-' }}</span>
            </td>
            <td data-label="Kelas 2" class="hide-mobile">
              <span class="badge-soft">{{ $i->kelas2 ?? '-' }}</span>
            </td>
            <td data-label="Kelas 3" class="hide-mobile">
              <span class="badge-soft">{{ $i->kelas3 ?? '-' }}</span>
            </td>
            <td data-label="Kelas 4" class="hide-mobile">
              <span class="badge-soft">{{ $i->kelas4 ?? '-' }}</span>
            </td>

            <td data-label="Aksi" class="mobile-only">
              <button class="mobile-detail-btn"
                      type="button"
                      data-bs-toggle="collapse"
                      data-bs-target="#{{ $collapseId }}"
                      aria-expanded="false"
                      aria-controls="{{ $collapseId }}">
                <i class="bi bi-eye me-1"></i> Detail
              </button>

              <div class="collapse" id="{{ $collapseId }}">
                <div class="mobile-detail-wrap">
                  <div class="label">Tanggal & Kategori</div>
                  <div class="mobile-detail-grid mb-2">
                    <div class="mobile-detail-item">
                      <div class="k">Tanggal</div>
                      <div class="v">{{ optional($i->tanggal)->translatedFormat('d F Y') ?? '-' }}</div>
                    </div>
                    <div class="mobile-detail-item">
                      <div class="k">Kategori</div>
                      <div class="v">{{ $i->kategori ?? '-' }}</div>
                    </div>
                  </div>

                  <div class="label">Koordinat</div>
                  <div class="mobile-detail-grid mb-2">
                    <div class="mobile-detail-item">
                      <div class="k">Latitude</div>
                      <div class="v">{{ $i->latitude ?? '-' }}</div>
                    </div>
                    <div class="mobile-detail-item">
                      <div class="k">Longitude</div>
                      <div class="v">{{ $i->longitude ?? '-' }}</div>
                    </div>
                  </div>

                  <div class="label">Status Mutu</div>
                  <div class="mobile-detail-grid">
                    <div class="mobile-detail-item">
                      <div class="k">Kelas 1</div>
                      <div class="v">{{ $i->kelas1 ?? '-' }}</div>
                    </div>
                    <div class="mobile-detail-item">
                      <div class="k">Kelas 2</div>
                      <div class="v">{{ $i->kelas2 ?? '-' }}</div>
                    </div>
                    <div class="mobile-detail-item">
                      <div class="k">Kelas 3</div>
                      <div class="v">{{ $i->kelas3 ?? '-' }}</div>
                    </div>
                    <div class="mobile-detail-item">
                      <div class="k">Kelas 4</div>
                      <div class="v">{{ $i->kelas4 ?? '-' }}</div>
                    </div>
                  </div>
                </div>
              </div>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="12" class="text-center text-muted py-5">
              Belum ada data IKA.
            </td>
          </tr>
        @endforelse
        </tbody>
      </table>
    </div>

    @if($ikas->hasPages())
      <div class="mt-3 pagination-modern-wrap">
        {{ $ikas->appends(request()->query())->links('pagination::bootstrap-5') }}
      </div>
    @endif
  </div>
</div>
@endsection
