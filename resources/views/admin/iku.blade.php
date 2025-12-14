@extends('layouts.admin')
@section('title','Input IKU')

@section('content')

<style>
/* ===================== SENADA DENGAN GALERI / AKUN / IKA ===================== */
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
    overflow-x:auto;
    -webkit-overflow-scrolling:touch;
    width:100%;
}
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
.modern-table thead tr.sub th{
    font-size:12.5px;
    background:#f6f9ff;
}
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
    padding:7px 10px;border-radius:10px;font-size:13px;
    display:inline-flex;align-items:center;gap:6px;
    white-space:nowrap;transition:.2s;
}
.edit-btn{
    background:#eef6ff;border:1.5px solid #cfe2ff;color:#0d6efd;
}
.edit-btn:hover{ background:#0d6efd;border-color:#0d6efd;color:#fff;transform:translateY(-1px); }
.delete-btn{
    background:#fff1f2;border:1.5px solid #fecdd3;color:#e11d48;
}
.delete-btn:hover{ background:#e11d48;border-color:#e11d48;color:#fff;transform:translateY(-1px); }

/* helper hide mobile (default desktop tampil) */
.hide-mobile{ display:table-cell; }

/* detail button (mobile only) */
.mobile-detail-btn{
    display:none;
    padding:6px 10px;border-radius:10px;font-size:12.5px;font-weight:800;
    background:#0f172a;color:#fff;border:none;
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

    /* SEMBUNYIKAN semua kolom selain Kab/Kota dan Aksi */
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
                   placeholder="Cari kabupaten/kota..."
                   value="{{ request('search') }}">

            <button class="btn btn-success btn-mini">
                <i class="bi bi-search"></i> Cari
            </button>

            <button type="button" class="btn btn-add btn-mini"
                    data-bs-toggle="modal"
                    data-bs-target="#addIkuModal">
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
                    <th rowspan="3" style="width:60px;" class="hide-mobile">No</th>
                    <th rowspan="3">Kabupaten / Kota</th>

                    <th colspan="5" class="text-center hide-mobile">Perhitungan Indeks</th>

                    <th rowspan="3" class="text-center hide-mobile">Nilai IKU</th>
                    <th rowspan="3" class="text-center hide-mobile">Target IKU</th>
                    <th rowspan="3" style="width:220px;">Aksi</th>
                </tr>

                {{-- SUB-GROUP HEADER --}}
                <tr class="sub">
                    <th colspan="2" class="text-center hide-mobile">Rataan Per Parameter</th>
                    <th colspan="2" class="text-center hide-mobile">Indeks Dibagi Bakumutu</th>
                    <th class="text-center hide-mobile">Rataan</th>
                </tr>

                {{-- SUB HEADER --}}
                <tr>
                    <th class="text-center hide-mobile">NO<sub>2</sub></th>
                    <th class="text-center hide-mobile">SO<sub>2</sub></th>
                    <th class="text-center hide-mobile">NO<sub>2</sub></th>
                    <th class="text-center hide-mobile">SO<sub>2</sub></th>
                    <th class="text-center hide-mobile">Indeks</th>
                </tr>
            </thead>

            <tbody>
            @forelse($ikus as $i)
                @php $collapseId = 'detailIku'.$i->id; @endphp
                <tr>
                    <td data-label="No" class="hide-mobile">
                        <div class="num-badge">
                            {{ $loop->iteration + ($ikus->currentPage()-1)*$ikus->perPage() }}
                        </div>
                    </td>

                    <td data-label="Kab/Kota" class="fw-semibold">
                        {{ $i->kabupaten_kota }}
                    </td>

                    {{-- Rataan per parameter --}}
                    <td data-label="Rataan NO2" class="hide-mobile">
                        {{ $i->rataan_no2 ?? '-' }}
                    </td>
                    <td data-label="Rataan SO2" class="hide-mobile">
                        {{ $i->rataan_so2 ?? '-' }}
                    </td>

                    {{-- Indeks dibagi bakumutu --}}
                    <td data-label="Indeks NO2" class="hide-mobile">
                        {{ $i->indeks_no2 ?? '-' }}
                    </td>
                    <td data-label="Indeks SO2" class="hide-mobile">
                        {{ $i->indeks_so2 ?? '-' }}
                    </td>

                    {{-- Rataan indeks --}}
                    <td data-label="Rataan Indeks" class="hide-mobile">
                        <span class="badge-soft">{{ $i->rataan_indeks ?? '-' }}</span>
                    </td>

                    <td data-label="Nilai IKU" class="fw-bold text-success hide-mobile">
                        {{ $i->nilai_iku ?? '-' }}
                    </td>

                    <td data-label="Target IKU" class="hide-mobile">
                        {{ $i->target_iku ?? '-' }}
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

                        {{-- Collapse detail (mobile) --}}
                        <div class="collapse mt-2" id="{{ $collapseId }}">
                            <div class="mobile-detail-wrap">

                                <div class="label">Rataan Per Parameter</div>
                                <div class="mobile-detail-grid mb-2">
                                    <div class="mobile-detail-item">
                                        <div class="k">NO<sub>2</sub></div>
                                        <div class="v">{{ $i->rataan_no2 ?? '-' }}</div>
                                    </div>
                                    <div class="mobile-detail-item">
                                        <div class="k">SO<sub>2</sub></div>
                                        <div class="v">{{ $i->rataan_so2 ?? '-' }}</div>
                                    </div>
                                </div>

                                <div class="label">Indeks Dibagi Bakumutu</div>
                                <div class="mobile-detail-grid mb-2">
                                    <div class="mobile-detail-item">
                                        <div class="k">NO<sub>2</sub></div>
                                        <div class="v">{{ $i->indeks_no2 ?? '-' }}</div>
                                    </div>
                                    <div class="mobile-detail-item">
                                        <div class="k">SO<sub>2</sub></div>
                                        <div class="v">{{ $i->indeks_so2 ?? '-' }}</div>
                                    </div>
                                </div>

                                <div class="label">Rataan</div>
                                <div class="mobile-detail-grid mb-2">
                                    <div class="mobile-detail-item">
                                        <div class="k">Indeks</div>
                                        <div class="v">{{ $i->rataan_indeks ?? '-' }}</div>
                                    </div>
                                </div>

                                <div class="label">Ringkasan IKU</div>
                                <div class="mobile-detail-grid">
                                    <div class="mobile-detail-item">
                                        <div class="k">Nilai IKU</div>
                                        <div class="v">{{ $i->nilai_iku ?? '-' }}</div>
                                    </div>
                                    <div class="mobile-detail-item">
                                        <div class="k">Target IKU</div>
                                        <div class="v">{{ $i->target_iku ?? '-' }}</div>
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
                            <form method="POST" action="{{ route('admin.iku.update',$i->id) }}">
                                @csrf
                                @method('PUT')

                                <div class="modal-header">
                                    <h5 class="modal-title fw-bold">Edit Data IKU</h5>
                                    <button class="btn-close" data-bs-dismiss="modal"></button>
                                </div>

                                <div class="modal-body">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Kabupaten/Kota</label>
                                            <input name="kabupaten_kota" class="form-control"
                                                   value="{{ $i->kabupaten_kota }}" required>
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label fw-semibold">Rataan NO<sub>2</sub></label>
                                            <input name="rataan_no2" class="form-control" value="{{ $i->rataan_no2 }}">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label fw-semibold">Rataan SO<sub>2</sub></label>
                                            <input name="rataan_so2" class="form-control" value="{{ $i->rataan_so2 }}">
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label fw-semibold">Indeks / Bakumutu NO<sub>2</sub></label>
                                            <input name="indeks_no2" class="form-control" value="{{ $i->indeks_no2 }}">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label fw-semibold">Indeks / Bakumutu SO<sub>2</sub></label>
                                            <input name="indeks_so2" class="form-control" value="{{ $i->indeks_so2 }}">
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label fw-semibold">Rataan Indeks</label>
                                            <input name="rataan_indeks" class="form-control" value="{{ $i->rataan_indeks }}">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label fw-semibold">Nilai IKU</label>
                                            <input name="nilai_iku" class="form-control" value="{{ $i->nilai_iku }}">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label fw-semibold">Target IKU</label>
                                            <input name="target_iku" class="form-control" value="{{ $i->target_iku }}">
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
                        <form method="POST" action="{{ route('admin.iku.destroy',$i->id) }}">
                          @csrf
                          @method('DELETE')

                          <div class="modal-header bg-danger text-white">
                            <h5 class="modal-title fw-bold">Hapus Data IKU</h5>
                            <button type="button" class="btn-close btn-close-white"
                                    data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>

                          <div class="modal-body">
                            Yakin hapus data <b>{{ $i->kabupaten_kota }}</b>?
                            <div class="alert alert-warning small mt-2" style="border-radius:10px;">
                              Tindakan ini tidak dapat dibatalkan.
                            </div>
                          </div>

                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal"
                                    style="border-radius:10px;font-weight:700;">
                              Batal
                            </button>
                            <button type="submit" class="btn btn-danger"
                                    style="border-radius:10px;font-weight:800;">
                              Hapus
                            </button>
                          </div>
                        </form>
                      </div>
                    </div>
                </div>

            @empty
                <tr>
                    <td colspan="10" class="text-center text-muted py-4">
                        Belum ada data IKU.
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    {{-- PAGINATION --}}
    @if($ikus->hasPages())
        <div class="mt-3 pagination-modern-wrap">
            {{ $ikus->appends(request()->query())->links('pagination::bootstrap-5') }}
        </div>
    @endif

</div>

{{-- MODAL TAMBAH IKU --}}
<div class="modal fade" id="addIkuModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <form method="POST" action="{{ route('admin.iku.store') }}">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title fw-bold">
                        <i class="bi bi-wind text-success me-1"></i>
                        Tambah Data Indeks Kualitas Udara (IKU)
                    </h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Kabupaten/Kota</label>
                            <input name="kabupaten_kota" class="form-control" required>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Rataan NO<sub>2</sub></label>
                            <input name="rataan_no2" class="form-control" placeholder="mis. 0.021">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Rataan SO<sub>2</sub></label>
                            <input name="rataan_so2" class="form-control" placeholder="mis. 0.013">
                        </div>

                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Indeks / Bakumutu NO<sub>2</sub></label>
                            <input name="indeks_no2" class="form-control" placeholder="mis. 0.70">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Indeks / Bakumutu SO<sub>2</sub></label>
                            <input name="indeks_so2" class="form-control" placeholder="mis. 0.55">
                        </div>

                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Rataan Indeks</label>
                            <input name="rataan_indeks" class="form-control" placeholder="mis. 0.63">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Nilai IKU</label>
                            <input name="nilai_iku" class="form-control" placeholder="mis. 91.2">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Target IKU</label>
                            <input name="target_iku" class="form-control" placeholder="mis. 90">
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
