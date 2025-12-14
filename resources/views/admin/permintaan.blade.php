@extends('layouts.admin')
@section('title', 'Permintaan Uji')

@section('content')

<style>
/* ===== FILTER CARD COMPACT & FIT CONTENT (SENADA HASIL UJI) ===== */
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

/* ===== DATE GROUP (box sendiri) ===== */
.date-group{
    display:flex;
    align-items:center;
    gap:8px;
    padding:6px;
    background:#f8fafc;
    border:1px solid #e5e7eb;
    border-radius:12px;
}

/* ukuran kompak */
.filter-form select,
.filter-form input{
    height:34px;
    font-size:13px;
    padding:4px 8px;
    border-radius:10px;
}

/* service type agak lebar dikit */
.service-type{
    width:190px;
    min-width:190px;
}

/* date type kecil */
.date-type{
    width:140px;
    min-width:140px;
}

/* ✅ DATE VALUE WRAP FLEX (bisa 1 atau 2 input) */
.date-value-wrap{
    display:flex;
    align-items:center;
    gap:6px;
    min-width:150px;
}

/* mode default */
.date-value-wrap .date-input{ width:160px; }
.date-value-wrap .month-input{ width:130px; }
.date-value-wrap .year-input{ width:95px; }

/* kalau mode year saja, year full */
.date-value-wrap.year-mode .year-input{ width:160px; }

/* search kecil */
.filter-form input[name="search"]{
    width:180px;
    min-width:180px;
}

/* tombol mini */
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

/* print mini senada */
.print-btn{
    background:transparent;
    border:1.5px solid #28a745;
    color:#28a745;
    transition:.2s;
}
.print-btn:hover{ background:#28a745; color:#fff; }
.print-btn i{ font-size:16px; }

/* ===== MOBILE FILTER ===== */
@media(max-width:576px){
    .filter-card{ width:100%; }
    .filter-form{
        flex-wrap:wrap;
        align-items:stretch;
        gap:8px;
    }

    .service-type{
        width:100%;
        min-width:0;
        flex:1 1 100%;
    }

    .date-group{
        width:100%;
        flex-wrap:wrap;
        justify-content:flex-start;
        gap:6px;
        padding:8px;
    }

    .date-type{
        width:100%;
        min-width:0;
        flex:1 1 100%;
    }

    .date-value-wrap{
        width:100%;
        min-width:0;
        flex:1 1 100%;
        gap:6px;
        flex-wrap:wrap;
    }

    .date-value-wrap .date-input,
    .date-value-wrap .month-input,
    .date-value-wrap .year-input{
        width:100% !important;
        min-width:0;
    }

    .filter-form input[name="search"]{
        width:100%;
        min-width:0;
        flex:1 1 100%;
    }

    .filter-form button,
    .filter-form a{
        flex:1 1 calc(50% - 4px);
        justify-content:center;
    }
}

/* ===================== TABLE WRAPPER ===================== */
.modern-table-wrapper {
    background: #ffffff;
    border-radius: 22px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.05);
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
    width: 100%;
}

/* TABLE HEADER */
.modern-table thead { background: #f3f8ff; }
.modern-table thead th {
    padding: 16px;
    font-weight: 600;
    color: #40566e;
    font-size: 14px;
    border-bottom: 1px solid #e8eef5;
    white-space: nowrap;
}

/* TABLE BODY */
.modern-table tbody tr:nth-child(odd) { background: #ffffff; }
.modern-table tbody tr:nth-child(even) { background: #f9fbfd; }
.modern-table tbody tr:hover {
    background: #eef6ff;
    transition: 0.2s;
}
.modern-table tbody td {
    padding: 14px 16px;
    font-size: 14px;
    color: #333;
    white-space: nowrap;
    vertical-align: middle;
}

/* BOX COUNT */
.count-card {
    background: #ffffff;
    border-radius: 18px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.05);
    padding: 16px;
    text-align: center;
}

/* ===================== PAGINATION MODERN (SAMAKAN GALERI) ===================== */
.pagination-modern-wrap nav{
    display:flex;
    justify-content:center;
}
.pagination-modern-wrap .pagination{
    gap:6px;
    padding:6px 10px;
    background:#fff;
    border-radius:999px;
    box-shadow:0 6px 18px rgba(0,0,0,.06);
    border:1px solid #eef1f5;
}
.pagination-modern-wrap .page-link{
    width:32px;height:32px;
    display:flex;align-items:center;justify-content:center;
    font-size:13px;
    background:#f1f5f9;
    border:none;
    color:#475569;
    font-weight:700;
    border-radius:10px !important;
    transition:.18s;
}
.pagination-modern-wrap .page-link:hover{
    background:#e2e8f0;
    transform:translateY(-1px);
}
.pagination-modern-wrap .page-item.active .page-link{
    background:#189e1e !important;
    color:#fff !important;
    box-shadow:0 4px 10px rgba(24,158,30,.25);
}
.pagination-modern-wrap .page-item:first-child .page-link,
.pagination-modern-wrap .page-item:last-child .page-link{
    width:auto;height:32px;
    padding:0 12px;
    border-radius:999px !important;
    font-weight:800;
}
.pagination-modern-wrap .page-item.disabled .page-link{
    opacity:.5;
    background:#f8fafc;
}
@media(max-width:576px){
    .pagination-modern-wrap .pagination{
        flex-wrap:wrap;
        border-radius:16px;
        padding:8px;
        gap:5px;
    }
}

/* ===================== ACTION BUTTONS (BARU) ===================== */
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

/* Detail: clean outline info */
.detail-btn{
    background:#ffffff;
    border:1.5px solid #0ea5e9;
    color:#0ea5e9;
}
.detail-btn:hover{
    background:#0ea5e9;
    color:#fff;
    transform:translateY(-1px);
}

/* Delete: soft red icon */
.delete-btn{
    background:#fff1f2;
    border:1.5px solid #fecdd3;
    color:#e11d48;
}
.delete-btn:hover{
    background:#e11d48;
    border-color:#e11d48;
    color:#fff;
    transform:translateY(-1px);
}

/* badge nomor */
.num-badge{
    width:32px;height:32px;border-radius:50%;
    background:#eef4ff;color:#189e1e;font-weight:600;
    display:flex;align-items:center;justify-content:center;
    border:2px solid #dfe8ff;font-size:13px;
}

/* ===================== STATUS + BUTTON PROSES (BARU) ===================== */
.status-col{
    display:flex;
    flex-direction:column;
    gap:6px;
    align-items:flex-start;
}

.status-btn{
    font-size:12px;
    padding:4px 10px;
    border-radius:999px;
    border:1.2px dashed transparent;
    display:inline-flex;
    align-items:center;
    gap:6px;
    line-height:1;
}

/* warna tombol proses mengikuti status */
.status-btn-primary{ background:#e7f1ff; color:#0d6efd; border-color:#b6d4fe; }
.status-btn-danger{  background:#ffecec; color:#dc3545; border-color:#f5c2c7; }
.status-btn-success{ background:#e8fff1; color:#198754; border-color:#b7f0cf; }
.status-btn-info{    background:#e7fbff; color:#0dcaf0; border-color:#b6effb; }
.status-btn-secondary{ background:#f1f1f1; color:#6c757d; border-color:#d3d3d3; }
.status-btn-warning{ background:#fff8e6; color:#ffc107; border-color:#ffe69c; }
.status-btn-dark{    background:#ededed; color:#212529; border-color:#cfcfcf; }

.status-btn:hover{
    filter:brightness(.97);
    transform:translateY(-1px);
}

/* ===================== MOBILE TABLE CARD ===================== */
@media (max-width: 576px) {
    .modern-table thead{ display:none; }

    .modern-table tbody tr{
        display:block;
        margin-bottom:12px;
        background:#fff;
        border-radius:12px;
        padding:10px;
        box-shadow:0 3px 8px rgba(0,0,0,0.05);
    }

    .modern-table tbody td{
        display:flex;
        justify-content:space-between;
        white-space:normal;
        padding:8px 10px;
        font-size:13.5px;
        border-bottom:1px solid #f0f0f0;
        gap:10px;
    }

    .modern-table tbody td:last-child{ border-bottom:none; }

    .modern-table tbody td::before{
        content:attr(data-label);
        font-weight:600;
        color:#475569;
        padding-right:12px;
        flex:0 0 45%;
    }

    /* status-col biar tetap rapi di mobile */
    .status-col{
        align-items:flex-end;  /* kanan biar sejajar */
        text-align:right;
    }

    /* action lebih rapet */
    .action-btn{
        font-size:12.5px;
        padding:6px 9px;
    }
}
</style>

<div class="container-fluid py-3">

    {{-- BOX JUMLAH LAYANAN --}}
    <div class="row g-3 mb-2">
        @foreach ($counts as $type => $count)
        <div class="col-md-3 col-6">
            <div class="count-card">
                <h6 class="text-capitalize text-muted mb-1">{{ $type }}</h6>
                <h3 class="fw-bold mb-0">{{ $count }}</h3>
            </div>
        </div>
        @endforeach
    </div>

    {{-- FILTER CARD --}}
    <div class="filter-card mt-4">
        <form method="GET" action="" class="filter-form">

            {{-- SERVICE TYPE --}}
            <select name="service_type" class="form-select form-select-sm service-type">
                <option value="">Semua Layanan</option>
                <option value="uji kualitas sungai" {{ request('service_type')=='uji kualitas sungai'?'selected':'' }}>Uji Kualitas Sungai</option>
                <option value="uji kualitas limbah" {{ request('service_type')=='uji kualitas limbah'?'selected':'' }}>Uji Kualitas Limbah</option>
                <option value="uji kualitas danau" {{ request('service_type')=='uji kualitas danau'?'selected':'' }}>Uji Kualitas Danau</option>
                <option value="uji kualitas lindi" {{ request('service_type')=='uji kualitas lindi'?'selected':'' }}>Uji Kualitas Lindi</option>
            </select>

            {{-- DATE GROUP --}}
            <div class="date-group">
                <select name="date_type" id="dateTypeSelect"
                        class="form-select form-select-sm date-type">
                    <option value="date"  {{ request('date_type')=='date'?'selected':'' }}>Tanggal</option>
                    <option value="month" {{ request('date_type')=='month'?'selected':'' }}>Bulan</option>
                    <option value="year"  {{ request('date_type')=='year'?'selected':'' }}>Tahun</option>
                </select>

                <div class="date-value-wrap" id="dateValueWrap">
                    <input type="date" name="date"
                           class="form-control form-control-sm date-input {{ request('date_type')=='date'?'':'d-none' }}"
                           value="{{ request('date') }}">

                    <select name="month"
                            class="form-select form-select-sm month-input {{ request('date_type')=='month'?'':'d-none' }}">
                        <option value="">Bulan</option>
                        @for($m=1;$m<=12;$m++)
                            <option value="{{ $m }}" {{ request('month')==$m?'selected':'' }}>
                                {{ DateTime::createFromFormat('!m',$m)->format('F') }}
                            </option>
                        @endfor
                    </select>

                    <select name="year"
                            class="form-select form-select-sm year-input {{ (request('date_type')=='year' || request('date_type')=='month')?'':'d-none' }}">
                        <option value="">Tahun</option>
                        @for($y=date('Y');$y>=2020;$y--)
                            <option value="{{ $y }}" {{ request('year')==$y?'selected':'' }}>
                                {{ $y }}
                            </option>
                        @endfor
                    </select>
                </div>
            </div>

            {{-- SEARCH --}}
            <input type="text" name="search" class="form-control form-control-sm"
                   placeholder="Cari..." value="{{ request('search') }}">

            {{-- FILTER BTN --}}
            <button class="btn btn-success btn-mini">
                <i class="bi bi-filter"></i> Filter
            </button>

            {{-- PRINT --}}
            <a href="{{ route('admin.uji.print', request()->query()) }}"
               class="btn print-btn btn-mini">
                <i class="bi bi-printer"></i> Print
            </a>

        </form>
    </div>

    {{-- TABLE --}}
    <div class="modern-table-wrapper mt-3">
        <table class="table modern-table align-middle mb-0">
            <thead>
                <tr>
                    <th style="width:60px;">No</th>
                    <th>Akun / Instansi</th>
                    <th>Layanan</th>
                    <th>Status</th>
                    <th style="width:120px;">Tanggal</th>
                    <th style="width:200px;">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($requests as $item)
                @php
                    $color = [
                        'pemeriksaan kelengkapan' => 'primary',
                        'persyaratan tidak lengkap' => 'danger',
                        'persyaratan lengkap' => 'success',
                        'jadwal pengambilan sampel' => 'info',
                        'pengambilan sampel' => 'info',
                        'uji selesai' => 'secondary',
                        'verifikasi hasil uji' => 'warning',
                        'penerbitan lhu' => 'dark',
                    ][$item->status] ?? 'primary';

                    // tombol proses ditaruh di status kolom
                    $nextAction = match($item->status) {
                        'pemeriksaan kelengkapan' => ['label'=>'Periksa', 'class'=>'primary'],
                        'persyaratan tidak lengkap' => ['label'=>'Perlu Perbaikan', 'class'=>'danger'],
                        'persyaratan lengkap' => ['label'=>'Atur Jadwal', 'class'=>'success'],
                        'jadwal pengambilan sampel' => ['label'=>'Proses Pengambilan', 'class'=>'info'],
                        'pengambilan sampel' => ['label'=>'Selesai Uji', 'class'=>'secondary'],
                        'uji selesai' => ['label'=>'Verifikasi', 'class'=>'warning'],
                        'verifikasi hasil uji' => ['label'=>'Terbitkan LHU', 'class'=>'dark'],
                        default => null
                    };
                @endphp

                <tr>
                    <td data-label="No">
                        <div class="num-badge">
                            {{ $loop->iteration + ($requests->currentPage()-1)*$requests->perPage() }}
                        </div>
                    </td>

                    <td data-label="Akun / Instansi">
                        <div class="fw-semibold">{{ $item->user->nama ?? '-' }}</div>
                        <div class="text-muted small">{{ $item->user->instansi ?? '-' }}</div>
                    </td>

                    <td data-label="Layanan" class="text-capitalize">
                        {{ $item->service_type }}
                    </td>

                    {{-- STATUS + BUTTON PROSES DI SINI --}}
                    <td data-label="Status">
                        <div class="status-col">
                            <span class="badge bg-{{ $color }} text-capitalize px-3 py-2">
                                {{ $item->status }}
                            </span>

                            @if($nextAction)
                                <button class="btn status-btn status-btn-{{ $nextAction['class'] }}"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalStatus{{ $item->id }}">
                                    <i class="bi bi-arrow-right-circle"></i>
                                    {{ $nextAction['label'] }}
                                </button>
                            @elseif($item->status == 'penerbitan lhu')
                                <a href="{{ route('admin.hasiluji', $item->id) }}"
                                   class="btn status-btn status-btn-success">
                                    <i class="bi bi-clipboard-check"></i> Hasil Uji
                                </a>
                            @endif
                        </div>
                    </td>

                    <td data-label="Tanggal">
                        {{ $item->created_at->format('d-m-Y') }}
                    </td>

                    {{-- AKSI CUMA DETAIL + HAPUS --}}
                    <td data-label="Aksi">
                        <div class="d-flex flex-wrap gap-2">

                            <button class="btn action-btn detail-btn"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modalDetail{{ $item->id }}">
                                <i class="bi bi-info-circle"></i> Detail
                            </button>

                            <button class="btn action-btn delete-btn"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modalDelete{{ $item->id }}">
                                <i class="bi bi-trash"></i> Hapus
                            </button>
                        </div>
                    </td>
                </tr>

                {{-- MODAL DETAIL --}}
                <div class="modal fade" id="modalDetail{{ $item->id }}" tabindex="-1">
                    <div class="modal-dialog modal-lg modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Detail Permintaan Uji</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <div class="modal-body">
                                <div class="row g-3">

                                    <div class="col-md-6">
                                        <div class="small text-muted">Akun</div>
                                        <div class="fw-semibold">{{ $item->user->nama ?? '-' }}</div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="small text-muted">Instansi</div>
                                        <div class="fw-semibold">{{ $item->user->instansi ?? '-' }}</div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="small text-muted">Nama PIC</div>
                                        <div class="fw-semibold">{{ $item->pic_name }}</div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="small text-muted">Kontak PIC</div>
                                        <div class="fw-semibold">
                                            {{ $item->pic_phone }} <br>
                                            {{ $item->pic_email }}
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="small text-muted">Layanan</div>
                                        <div class="fw-semibold text-capitalize">{{ $item->service_type }}</div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="small text-muted">Status</div>
                                        <span class="badge bg-{{ $color }} text-capitalize px-3 py-2">
                                            {{ $item->status }}
                                        </span>
                                    </div>

                                    <div class="col-12">
                                        <div class="small text-muted">Alamat Pengambilan Sampel</div>
                                        <div class="fw-semibold">{{ $item->sample_address }}</div>
                                    </div>

                                    <div class="col-12">
                                        <div class="small text-muted">Catatan Pemohon</div>
                                        <div class="fw-semibold">{{ $item->notes ?? '-' }}</div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="small text-muted">Tanggal Permintaan</div>
                                        <div class="fw-semibold">{{ $item->created_at->format('d M Y') }}</div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="small text-muted">Tanggal Pengambilan Sampel</div>
                                        <div class="fw-semibold">
                                            {{ $item->sample_pickup_date ? \Carbon\Carbon::parse($item->sample_pickup_date)->format('d M Y') : '-' }}
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="small text-muted mb-1">Surat Permohonan</div>
                                        @if ($item->letter_file)
                                            <a href="{{ route('admin.file', $item->id) }}"
                                               class="btn btn-sm btn-outline-primary">
                                                <i class="bi bi-download"></i> Download Surat
                                            </a>
                                        @else
                                            <span class="text-muted">Tidak ada surat terlampir</span>
                                        @endif
                                    </div>

                                </div>
                            </div>

                            <div class="modal-footer">
                                <button class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- MODAL STATUS (ASLI) --}}
                <div class="modal fade" id="modalStatus{{ $item->id }}" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="{{ route('admin.uji.status', $item->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                @php
                                    // ✅ baca fix_fields lama biar kalau edit ulang tetap ke-check
                                    $oldFix = json_decode($item->fix_fields ?? '[]', true);
                                @endphp

                                <div class="modal-header">
                                    <h5 class="modal-title">Update Status Permintaan</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>

                                <div class="modal-body">
                                    <label class="form-label fw-bold">Pilih Status Baru</label>

                                    {{-- ✅ default status sesuai status sekarang --}}
                                    <select name="status"
                                            class="form-select"
                                            required
                                            id="statusSelect{{ $item->id }}">
                                        @foreach([
                                            'pemeriksaan kelengkapan' => 'Pemeriksaan Kelengkapan',
                                            'persyaratan tidak lengkap' => 'Persyaratan Tidak Lengkap',
                                            'persyaratan lengkap' => 'Persyaratan Lengkap',
                                            'jadwal pengambilan sampel' => 'Jadwal Pengambilan Sampel',
                                            'pengambilan sampel' => 'Pengambilan Sampel',
                                            'uji selesai' => 'Uji Selesai',
                                            'verifikasi hasil uji' => 'Verifikasi Hasil Uji',
                                            'penerbitan lhu' => 'Penerbitan dan Penandatanganan LHU'
                                        ] as $val => $label)
                                            <option value="{{ $val }}" {{ $item->status == $val ? 'selected' : '' }}>
                                                {{ $label }}
                                            </option>
                                        @endforeach
                                    </select>

                                    {{-- ✅ FIELD PERBAIKAN --}}
                                    <div id="perbaikanFields{{ $item->id }}"
                                        class="mt-3 d-none">
                                        <label class="form-label fw-bold">Bagian yang harus diperbaiki</label>

                                        @foreach([
                                            'pic_name'       => 'Nama PIC',
                                            'pic_phone'      => 'Nomor PIC',
                                            'pic_email'      => 'Email PIC',
                                            'sample_address' => 'Alamat Pengambilan Sampel',
                                            'letter_file'    => 'Surat Permohonan',
                                        ] as $val => $label)

                                            <div class="form-check">
                                                <input class="form-check-input"
                                                    type="checkbox"
                                                    name="fix_fields[]"
                                                    value="{{ $val }}"
                                                    id="fix{{ $val }}{{ $item->id }}"
                                                    {{ in_array($val, $oldFix) ? 'checked' : '' }}>
                                                <label class="form-check-label"
                                                    for="fix{{ $val }}{{ $item->id }}">
                                                    {{ $label }}
                                                </label>
                                            </div>

                                        @endforeach
                                    </div>

                                    {{-- ✅ FIELD TANGGAL PENGAMBILAN --}}
                                    <div id="tanggalPengambilan{{ $item->id }}"
                                        class="mt-3 d-none">
                                        <label class="form-label fw-bold">Tanggal Pengambilan Sampel</label>
                                        <input type="date"
                                            name="sample_pickup_date"
                                            class="form-control"
                                            value="{{ $item->sample_pickup_date }}">
                                    </div>

                                    <div class="mt-3">
                                        <label class="form-label fw-bold">Catatan (opsional)</label>
                                        <textarea name="notes"
                                                class="form-control"
                                                rows="3">{{ $item->notes }}</textarea>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button class="btn btn-success w-100">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>


                {{-- MODAL DELETE (ASLI) --}}
                <div class="modal fade" id="modalDelete{{ $item->id }}">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="{{ route('uji.destroy', $item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')

                                <div class="modal-header bg-danger text-white">
                                    <h5 class="modal-title">Hapus Permintaan Uji</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>

                                <div class="modal-body">
                                    <p class="mb-1">Apakah Anda yakin ingin menghapus permintaan ini?</p>
                                    <div class="alert alert-warning small mt-2" style="border-radius: 10px;">
                                        Tindakan ini <strong>tidak dapat dibatalkan</strong>.
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                @empty
                <tr>
                    <td colspan="6" class="text-center py-4 text-muted">
                        Belum ada permintaan uji.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

   {{-- PAGINATION (SAMAKAN GALERI) --}}
@if($requests->hasPages())
    <div class="mt-3 pagination-modern-wrap">
        {{ $requests->appends(request()->query())->links('pagination::bootstrap-5') }}
    </div>
@endif
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {

    // ===== SCRIPT FILTER TANGGAL (punya kamu) =====
    const typeSelect = document.getElementById('dateTypeSelect');
    const dateWrap   = document.getElementById('dateValueWrap');
    const dateInput  = document.querySelector('.date-input');
    const monthInput = document.querySelector('.month-input');
    const yearInput  = document.querySelector('.year-input');

    function syncDateFilter() {
        const v = typeSelect.value;
        dateInput.classList.toggle('d-none',  v !== 'date');
        monthInput.classList.toggle('d-none', v !== 'month');
        yearInput.classList.toggle('d-none', !(v === 'year' || v === 'month'));
        dateWrap.classList.toggle('year-mode', v === 'year');
    }
    syncDateFilter();
    typeSelect.addEventListener('change', syncDateFilter);

    // ===== ✅ SCRIPT TOGGLE FIELD MODAL STATUS (BARU) =====
    function toggleExtraFields(reqId){
        const select = document.getElementById('statusSelect' + reqId);
        const fixBox = document.getElementById('perbaikanFields' + reqId);
        const dateBox = document.getElementById('tanggalPengambilan' + reqId);

        if(!select) return;

        const val = (select.value || '').toLowerCase().trim();

        // tampilkan checklist jika status "persyaratan tidak lengkap"
        if(fixBox){
            fixBox.classList.toggle('d-none', val !== 'persyaratan tidak lengkap');
        }

        // tampilkan tanggal jika status jadwal/pengambilan sampel
        if(dateBox){
            const showDate = (val === 'jadwal pengambilan sampel' || val === 'pengambilan sampel');
            dateBox.classList.toggle('d-none', !showDate);
        }
    }

    // binding semua modal status
    document.querySelectorAll('[id^="modalStatus"]').forEach(modal => {
        const reqId = modal.id.replace('modalStatus','');

        modal.addEventListener('shown.bs.modal', function(){
            toggleExtraFields(reqId); // sync saat modal muncul
        });

        const select = document.getElementById('statusSelect' + reqId);
        if(select){
            select.addEventListener('change', () => toggleExtraFields(reqId));
        }
    });

});
</script>


@endsection
