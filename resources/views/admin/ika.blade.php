@extends('layouts.admin')
@section('title','Input IKA')

@section('content')

<style>
/* ===================== SENADA DENGAN GALERI / AKUN ===================== */
:root{
    --g-green:#189e1e;
    --g-border:#eef1f5;
    --g-muted:#64748b;
    --g-text:#0f172a;
    --g-soft:#f0fdf4;
}

/* ===== FILTER CARD COMPACT & FIT CONTENT ===== */
.filter-card{
    background:#fff;
    padding:14px 16px;
    border-radius:18px;
    box-shadow:0 8px 20px rgba(0,0,0,.05);
    margin-bottom:18px;
    width: fit-content;
    max-width: 100%;
}

/* ===== HORIZONTAL FORM ===== */
.filter-form{
    display:flex;
    align-items:center;
    gap:10px;
    flex-wrap:nowrap;
}
.filter-form select,
.filter-form input{
    height:34px;
    font-size:13px;
    padding:4px 8px;
    border-radius:10px;
    white-space:nowrap;
}
.filter-form input[name="search"]{
    width:260px;
    min-width:220px;
}

/* tombol mini senada */
.btn-mini{
    height:34px;
    font-size:13px;
    padding:4px 10px;
    border-radius:10px;
    display:inline-flex;
    align-items:center;
    gap:6px;
    white-space:nowrap;
}

/* tombol tambah hijau senada */
.btn-add{
    background:#189e1e;
    color:#fff;
    border:1.5px solid #189e1e;
    transition:.2s;
}
.btn-add:hover{
    background:#1fb726;
    border-color:#1fb726;
    color:#fff;
    transform:translateY(-1px);
}

/* ===================== TABLE WRAPPER ===================== */
.modern-table-wrapper{
    background:#fff;
    border-radius:22px;
    box-shadow:0 8px 25px rgba(0,0,0,.05);
    overflow-x:auto;                 /* biarin tabel melebar, wrapper yg scroll */
    -webkit-overflow-scrolling:touch;
    width:100%;
}

/* tabel kembali normal (auto, ga dipaksa fixed) */
.modern-table{
    width:100%;
    table-layout:auto;
}

/* header */
.modern-table thead{ background:#f3f8ff; }
.modern-table thead th{
    padding:14px 12px;
    font-weight:700;
    color:#40566e;
    font-size:13.5px;
    border-bottom:1px solid #e8eef5;
    white-space:nowrap;
    vertical-align:middle;
}
.modern-table thead tr.group th{
    font-size:12.5px;
    text-transform:uppercase;
    letter-spacing:.3px;
    background:#eef6ff;
}

/* body */
.modern-table tbody tr:nth-child(even){ background:#f9fbfd; }
.modern-table tbody tr:hover{ background:#eef6ff;transition:.2s; }
.modern-table tbody td{
    padding:12px 12px;
    font-size:14px;
    color:#333;
    white-space:nowrap;
    vertical-align:middle;
}

/* BADGE NUMBER */
.num-badge{
    width:32px;height:32px;border-radius:50%;
    background:#eef4ff;color:#189e1e;font-weight:700;
    display:flex;align-items:center;justify-content:center;
    border:2px solid #dfe8ff;font-size:13px;
}

/* CHIP / BADGE SOFT */
.badge-soft{
    display:inline-flex;align-items:center;gap:6px;
    background:#f0fdf4;color:#166534;border:1px solid #bbf7d0;
    font-weight:800;font-size:12px;border-radius:999px;padding:4px 9px;
}

/* ACTION BUTTONS */
.action-btn{
    padding:7px 10px;
    border-radius:10px;
    font-size:13px;
    display:inline-flex;
    align-items:center;
    gap:6px;
    white-space:nowrap;
    transition:.2s;
}
.edit-btn{
    background:#eef6ff;
    border:1.5px solid #cfe2ff;
    color:#0d6efd;
}
.edit-btn:hover{
    background:#0d6efd;border-color:#0d6efd;color:#fff;transform:translateY(-1px);
}
.delete-btn{
    background:#fff1f2;border:1.5px solid #fecdd3;color:#e11d48;
}
.delete-btn:hover{
    background:#e11d48;border-color:#e11d48;color:#fff;transform:translateY(-1px);
}

/* hide on mobile helper */
.hide-mobile{ display: table-cell; }

/* detail button (mobile only) */
.mobile-detail-btn{
    display:none;
    padding:6px 10px;
    border-radius:10px;
    font-size:12.5px;
    font-weight:800;
    background:#0f172a;
    color:#fff;
    border:none;
}
.mobile-detail-btn i{ font-size:14px; }

/* ===================== PAGINATION MODERN ===================== */
.pagination-modern-wrap nav{ display:flex; justify-content:center; }
.pagination-modern-wrap .pagination{
    gap:6px;padding:6px 10px;background:#fff;border-radius:999px;
    box-shadow:0 6px 18px rgba(0,0,0,.06);border:1px solid #eef1f5;
}
.pagination-modern-wrap .page-link{
    width:32px;height:32px;display:flex;align-items:center;justify-content:center;
    font-size:13px;background:#f1f5f9;border:none;color:#475569;font-weight:700;
    border-radius:10px !important;transition:.18s;
}
.pagination-modern-wrap .page-link:hover{ background:#e2e8f0;transform:translateY(-1px); }
.pagination-modern-wrap .page-item.active .page-link{
    background:#189e1e !important;color:#fff !important;
    box-shadow:0 4px 10px rgba(24,158,30,.25);
}
.pagination-modern-wrap .page-item:first-child .page-link,
.pagination-modern-wrap .page-item:last-child .page-link{
    width:auto;height:32px;padding:0 12px;border-radius:999px !important;font-weight:800;
}
.pagination-modern-wrap .page-item.disabled .page-link{ opacity:.5;background:#f8fafc; }

/* ===== modal look clean ===== */
.modal-content{
    border-radius:16px;border:1px solid #eef1f5;
    box-shadow:0 18px 50px rgba(0,0,0,.18);
}
.modal-header{
    border-bottom:1px dashed #e5e7eb;
    background:#fff;border-top-left-radius:16px;border-top-right-radius:16px;
}

/* ===== MOBILE ===== */
@media(max-width:576px){
    .filter-card{ width:100%; max-width:100%; }
    .filter-form{
        flex-wrap:wrap;align-items:stretch;gap:8px;width:100%;
    }
    .filter-form input[name="search"]{
        width:100%;min-width:0;flex:1 1 100%;
    }
    .filter-form button{
        flex:1 1 calc(50% - 4px);justify-content:center;
    }

    /* TABLE CARD MODE */
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
        content:attr(data-label);font-weight:600;color:#475569;
        flex:0 0 45%;max-width:45%;overflow-wrap:anywhere;
    }

    /* SEMBUNYIKAN kolom-kolom selain kode, alamat, sungai, aksi */
    .modern-table tbody td.hide-mobile{
        display:none !important;
    }

    .modern-table tbody td[data-label="Aksi"]{
        flex-direction:column;align-items:flex-end;gap:6px;
    }

    /* show detail btn only in HP */
    .mobile-detail-btn{
        display:inline-flex; align-items:center; gap:6px;
        width:100%; justify-content:center;
    }

    .mobile-detail-wrap{
        background:#f8fafc;border:1px dashed #e2e8f0;border-radius:10px;
        padding:10px;margin-top:8px;font-size:13px;color:#0f172a;
    }
    .mobile-detail-wrap .label{
        font-size:11.5px;color:#64748b;font-weight:800;text-transform:uppercase;
        letter-spacing:.2px;margin-bottom:4px;
    }
    .mobile-detail-grid{
        display:grid;grid-template-columns:1fr 1fr;gap:6px 10px;
    }
    .mobile-detail-item{
        background:#fff;border:1px solid #eef1f5;border-radius:8px;padding:6px 8px;
    }
    .mobile-detail-item .k{ font-size:11.5px;color:#94a3b8;font-weight:700; }
    .mobile-detail-item .v{ font-weight:800;color:#0f172a;font-size:13px; }

    .pagination-modern-wrap .pagination{
        flex-wrap:wrap;border-radius:16px;padding:8px;gap:5px;
    }
}
.modal-dialog.modal-dialog-scrollable{
    height: calc(100% - 1rem);
}
.modal-dialog-scrollable .modal-content{
    max-height: 100%;
}

/* body jadi area scroll */
.modal-dialog-scrollable .modal-body{
    overflow-y: auto;
    max-height: calc(100vh - 180px); /* ruang utk header+footer */
    -webkit-overflow-scrolling: touch;
}

/* footer sticky biar tombol tidak ketutup */
.modal-dialog-scrollable .modal-footer{
    position: sticky;
    bottom: 0;
    background: #fff;
    z-index: 2;
    border-top: 1px dashed #e5e7eb;
}

/* khusus HP: modal full height biar lega */
@media (max-width: 576px){
    .modal-dialog{
        margin: .5rem;
    }
    .modal-dialog.modal-lg{
        max-width: 100%;
    }
    .modal-dialog-scrollable .modal-body{
        max-height: calc(100vh - 160px);
    }
}
</style>

<div class="container-fluid py-3">

    {{-- FILTER / TOOLBAR --}}
    <div class="filter-card">
        <form method="GET" class="filter-form">
            <input type="text" name="search"
                   class="form-control form-control-sm"
                   placeholder="Cari kode/alamat/sungai..."
                   value="{{ request('search') }}">

            <button class="btn btn-success btn-mini">
                <i class="bi bi-search"></i> Cari
            </button>

            <button type="button" class="btn btn-add btn-mini"
                    data-bs-toggle="modal"
                    data-bs-target="#addIkaModal">
                <i class="bi bi-plus-circle"></i> Tambah Data
            </button>
        </form>

        @if(session('success'))
            <div class="alert alert-success mt-3 mb-0">{{ session('success') }}</div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger mt-3 mb-0">
                {{ $errors->first() }}
            </div>
        @endif
    </div>

    {{-- TABLE LIST --}}
    <div class="modern-table-wrapper">
        <table class="table modern-table align-middle mb-0">
            <thead>
                {{-- GROUP HEADER --}}
                <tr class="group">
                    <th rowspan="2">No</th>
                    <th rowspan="2">Kode Lokasi</th>
                    <th rowspan="2">Alamat</th>
                    <th rowspan="2">Sungai</th>

                    <th rowspan="2" class="hide-mobile">Tanggal</th>
                    <th rowspan="2" class="hide-mobile">Kategori</th>
                    <th colspan="2" class="text-center hide-mobile">Koordinat</th>
                    <th colspan="4" class="text-center hide-mobile">Status Mutu</th>

                    <th rowspan="2" style="width:220px;">Aksi</th>
                </tr>
                {{-- SUB HEADER --}}
                <tr>
                    <th class="text-center hide-mobile">Latitude</th>
                    <th class="text-center hide-mobile">Longitude</th>

                    <th class="text-center hide-mobile">Kelas 1</th>
                    <th class="text-center hide-mobile">Kelas 2</th>
                    <th class="text-center hide-mobile">Kelas 3</th>
                    <th class="text-center hide-mobile">Kelas 4</th>
                </tr>
            </thead>

            <tbody>
            @forelse($ikas as $i)
                @php $collapseId = 'detailIka'.$i->id; @endphp
                <tr>
                    <td data-label="No">
                        <div class="num-badge">
                            {{ $loop->iteration + ($ikas->currentPage()-1)*$ikas->perPage() }}
                        </div>
                    </td>

                    <td data-label="Kode Lokasi" class="fw-semibold">
                        {{ $i->kode_lokasi }}
                    </td>

                    <td data-label="Alamat" style="white-space:normal;min-width:240px;">
                        {{ $i->alamat }}
                    </td>

                    <td data-label="Sungai">
                        {{ $i->sungai ?? '-' }}
                    </td>

                    <td data-label="Tanggal" class="hide-mobile">
                        {{ optional($i->tanggal)->format('d M Y') }}
                    </td>

                    <td data-label="Kategori" class="hide-mobile">
                        {{ $i->kategori ?? '-' }}
                    </td>

                    <td data-label="Latitude" class="hide-mobile">
                        {{ $i->latitude ?? '-' }}
                    </td>
                    <td data-label="Longitude" class="hide-mobile">
                        {{ $i->longitude ?? '-' }}
                    </td>

                    <td data-label="Status Mutu Kelas 1" class="hide-mobile">
                        <span class="badge-soft">{{ $i->kelas1 ?? '-' }}</span>
                    </td>
                    <td data-label="Status Mutu Kelas 2" class="hide-mobile">
                        <span class="badge-soft">{{ $i->kelas2 ?? '-' }}</span>
                    </td>
                    <td data-label="Status Mutu Kelas 3" class="hide-mobile">
                        <span class="badge-soft">{{ $i->kelas3 ?? '-' }}</span>
                    </td>
                    <td data-label="Status Mutu Kelas 4" class="hide-mobile">
                        <span class="badge-soft">{{ $i->kelas4 ?? '-' }}</span>
                    </td>

                    <td data-label="Aksi">
                        <div class="d-flex gap-2 flex-wrap justify-content-end w-100">

                            {{-- Detail button (mobile only) --}}
                            <button class="mobile-detail-btn"
                                    type="button"
                                    data-bs-toggle="collapse"
                                    data-bs-target="#{{ $collapseId }}"
                                    aria-expanded="false"
                                    aria-controls="{{ $collapseId }}">
                                <i class="bi bi-eye"></i> Detail
                            </button>

                            <button class="btn action-btn edit-btn"
                                    data-bs-toggle="modal"
                                    data-bs-target="#edit{{ $i->id }}">
                                <i class="bi bi-pencil-square"></i> Edit
                            </button>

                            <button class="btn action-btn delete-btn"
                                    data-bs-toggle="modal"
                                    data-bs-target="#delete{{ $i->id }}">
                                <i class="bi bi-trash"></i> Hapus
                            </button>
                        </div>

                        {{-- Collapse detail untuk MOBILE --}}
                        <div class="collapse mt-2" id="{{ $collapseId }}">
                            <div class="mobile-detail-wrap">
                                <div class="label">Tanggal & Kategori</div>
                                <div class="mobile-detail-grid mb-2">
                                    <div class="mobile-detail-item">
                                        <div class="k">Tanggal</div>
                                        <div class="v">{{ optional($i->tanggal)->format('d M Y') ?? '-' }}</div>
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

                                {{-- MODAL EDIT --}}
                <div class="modal fade" id="edit{{ $i->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-scrollable">
                        <div class="modal-content">
                            <form method="POST" action="{{ route('admin.ika.update', $i->id) }}">
                                @csrf
                                @method('PUT')

                                <div class="modal-header">
                                    <h5 class="modal-title fw-bold">
                                        <i class="bi bi-pencil-square text-primary me-1"></i>
                                        Edit Data Indeks Kualitas Air (IKA)
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>

                                <div class="modal-body">
                                    <div class="row g-3">
                                        <div class="col-md-3">
                                            <label class="form-label fw-semibold">Kode Lokasi</label>
                                            <input name="kode_lokasi"
                                                   class="form-control"
                                                   value="{{ old('kode_lokasi', $i->kode_lokasi) }}"
                                                   required>
                                        </div>

                                        <div class="col-md-9">
                                            <label class="form-label fw-semibold">Alamat</label>
                                            <input name="alamat"
                                                   class="form-control"
                                                   value="{{ old('alamat', $i->alamat) }}"
                                                   required>
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label fw-semibold">Sungai</label>
                                            <input name="sungai"
                                                   class="form-control"
                                                   value="{{ old('sungai', $i->sungai) }}"
                                                   placeholder="Sungai Lusi / dll">
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label fw-semibold">Tanggal</label>
                                            <input type="date"
                                                   name="tanggal"
                                                   class="form-control"
                                                   value="{{ old('tanggal', optional($i->tanggal)->format('Y-m-d')) }}"
                                                   required>
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label fw-semibold">Kategori</label>
                                            <input name="kategori"
                                                   class="form-control"
                                                   value="{{ old('kategori', $i->kategori) }}"
                                                   placeholder="AIR SUNGAI / dll">
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Latitude</label>
                                            <input name="latitude"
                                                   class="form-control"
                                                   value="{{ old('latitude', $i->latitude) }}"
                                                   placeholder="-7.0655">
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Longitude</label>
                                            <input name="longitude"
                                                   class="form-control"
                                                   value="{{ old('longitude', $i->longitude) }}"
                                                   placeholder="110.8863">
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label fw-semibold">Status Mutu Kelas 1</label>
                                            <input name="kelas1"
                                                   class="form-control"
                                                   value="{{ old('kelas1', $i->kelas1) }}">
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label fw-semibold">Status Mutu Kelas 2</label>
                                            <input name="kelas2"
                                                   class="form-control"
                                                   value="{{ old('kelas2', $i->kelas2) }}">
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label fw-semibold">Status Mutu Kelas 3</label>
                                            <input name="kelas3"
                                                   class="form-control"
                                                   value="{{ old('kelas3', $i->kelas3) }}">
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label fw-semibold">Status Mutu Kelas 4</label>
                                            <input name="kelas4"
                                                   class="form-control"
                                                   value="{{ old('kelas4', $i->kelas4) }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button class="btn btn-success w-100"
                                            style="border-radius:12px;font-weight:800;">
                                        <i class="bi bi-save me-1"></i> Simpan Perubahan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                {{-- MODAL DELETE --}}
                <div class="modal fade" id="delete{{ $i->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form method="POST" action="{{ route('admin.ika.destroy', $i->id) }}">
                                @csrf
                                @method('DELETE')

                                <div class="modal-header bg-danger text-white">
                                    <h5 class="modal-title">Hapus Data IKA</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>

                                <div class="modal-body">
                                    <p class="mb-2">
                                        Apakah Anda yakin ingin menghapus data IKA ini?
                                    </p>
                                    <div class="alert alert-warning small" style="border-radius:10px;">
                                        Tindakan ini <strong>tidak dapat dibatalkan</strong>.
                                    </div>
                                    <div class="small text-muted">
                                        <b>Kode Lokasi:</b> {{ $i->kode_lokasi }}<br>
                                        <b>Alamat:</b> {{ $i->alamat }}
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                        Batal
                                    </button>
                                    <button type="submit" class="btn btn-danger">
                                        Hapus
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            @empty
                <tr>
                    <td colspan="12" class="text-center text-muted py-4">
                        Belum ada data IKA.
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    {{-- PAGINATION --}}
    @if($ikas->hasPages())
        <div class="mt-3 pagination-modern-wrap">
            {{ $ikas->appends(request()->query())->links('pagination::bootstrap-5') }}
        </div>
    @endif

</div>

<div class="modal fade" id="addIkaModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <form method="POST" action="{{ route('admin.ika.store') }}">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title fw-bold">
                        <i class="bi bi-droplet-half text-success me-1"></i>
                        Tambah Data Indeks Kualitas Air (IKA)
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Kode Lokasi</label>
                            <input name="kode_lokasi" class="form-control" required>
                        </div>
                        <div class="col-md-9">
                            <label class="form-label fw-semibold">Alamat</label>
                            <input name="alamat" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Sungai</label>
                            <input name="sungai" class="form-control" placeholder="Sungai Lusi / dll">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Tanggal</label>
                            <input type="date" name="tanggal" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Kategori</label>
                            <input name="kategori" class="form-control" placeholder="AIR SUNGAI / dll">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Latitude</label>
                            <input name="latitude" class="form-control" placeholder="-7.0655">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Longitude</label>
                            <input name="longitude" class="form-control" placeholder="110.8863">
                        </div>

                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Status Mutu Kelas 1</label>
                            <input name="kelas1" class="form-control" placeholder="3.37 / Cemar Ringan">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Status Mutu Kelas 2</label>
                            <input name="kelas2" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Status Mutu Kelas 3</label>
                            <input name="kelas3" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Status Mutu Kelas 4</label>
                            <input name="kelas4" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-success w-100"
                            style="border-radius:12px;font-weight:800;">
                        <i class="bi bi-plus-circle me-1"></i> Simpan Data
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

@endsection
