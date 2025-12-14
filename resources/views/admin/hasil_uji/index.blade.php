@extends('layouts.admin')
@section('title','Hasil Uji')

@section('content')

<style>
/* ===== FILTER CARD COMPACT & FIT CONTENT (SENADA PERMINTAAN) ===== */
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
        width:100%; min-width:0; flex:1 1 100%;
    }

    .filter-form button,
    .filter-form a{
        flex:1 1 calc(50% - 4px);
        justify-content:center;
    }
}

/* ===== TABLE WRAPPER (tetap) ===== */
.modern-table-wrapper{
    background:#fff;border-radius:22px;box-shadow:0 8px 25px rgba(0,0,0,.05);
    overflow-x:auto;-webkit-overflow-scrolling:touch;width:100%;
}
.modern-table thead{ background:#f3f8ff; }
.modern-table thead th{
    padding:16px;font-weight:600;color:#40566e;font-size:14px;border-bottom:1px solid #e8eef5;white-space:nowrap;
}
.modern-table tbody tr:nth-child(even){ background:#f9fbfd; }
.modern-table tbody tr:hover{ background:#eef6ff;transition:.2s; }
.modern-table tbody td{
    padding:14px 16px;font-size:14px;color:#333;white-space:nowrap;vertical-align:middle;
}

.action-btn{
    padding:6px 10px;border-radius:8px;font-size:13px;display:inline-flex;align-items:center;gap:6px;white-space:nowrap;
}
.num-badge{
    width:32px;height:32px;border-radius:50%;background:#eef4ff;color:#189e1e;font-weight:600;
    display:flex;align-items:center;justify-content:center;border:2px solid #dfe8ff;font-size:13px;
}

/* ===================== AKSI PAIR (BARU) ===================== */
.action-stack{
    display:flex;
    flex-wrap:wrap;
    gap:10px;
}

.action-pair{
    background:#fff;
    border:1px dashed #e5e7eb;
    border-radius:12px;
    padding:8px 8px;
    display:flex;
    flex-direction:column;
    gap:6px;
    min-width:210px;
}

.action-pair .pair-title{
    font-size:11px;
    font-weight:700;
    color:#6b7280;
    text-transform:uppercase;
    letter-spacing:.4px;
}

.action-row{
    display:flex;
    align-items:center;
    gap:6px;
    flex-wrap:wrap;
}

.action-arrow{
    font-size:14px;
    color:#94a3b8;
    padding:0 2px;
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

    /* Pair action full width biar kelihatan jelas */
    .action-stack{ flex-direction:column; }
    .action-pair{ width:100%; min-width:0; }

    .modern-table thead{ display:none; }
    .modern-table tbody tr{
        display:block;margin-bottom:12px;background:white;border-radius:12px;padding:10px;
        box-shadow:0 3px 8px rgba(0,0,0,.05);
    }
    .modern-table tbody td{
        display:flex;justify-content:space-between;white-space:normal;padding:8px 10px;font-size:13.5px;border-bottom:1px solid #f0f0f0;
    }
    .modern-table tbody td:last-child{ border-bottom:none; }
    .modern-table tbody td::before{
        content:attr(data-label);font-weight:600;color:#475569;padding-right:12px;
    }
}
</style>

<div class="container-fluid py-3">

    {{-- FILTER CARD --}}
    <div class="filter-card">
        <form method="GET" action="{{ route('admin.hasiluji.index') }}" class="filter-form">

            {{-- SERVICE TYPE --}}
            <select name="service_type" class="form-select form-select-sm service-type">
                <option value="">Semua Layanan</option>
                <option value="uji kualitas sungai" {{ request('service_type')=='uji kualitas sungai'?'selected':'' }}>Uji Kualitas Sungai</option>
                <option value="uji kualitas limbah" {{ request('service_type')=='uji kualitas limbah'?'selected':'' }}>Uji Kualitas Limbah</option>
                <option value="uji kualitas danau" {{ request('service_type')=='uji kualitas danau'?'selected':'' }}>Uji Kualitas Danau</option>
                <option value="uji kualitas lindi"  {{ request('service_type')=='uji kualitas lindi'?'selected':'' }}>Uji Kualitas Lindi</option>
            </select>

            {{-- DATE GROUP --}}
            <div class="date-group">
                <select name="date_type" id="dateTypeSelect"
                        class="form-select form-select-sm date-type">
                    <option value="">Semua</option>
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
                                {{ \Carbon\Carbon::create()->month($m)->translatedFormat('F') }}
                            </option>
                        @endfor
                    </select>

                    <select name="year"
                            class="form-select form-select-sm year-input {{ (request('date_type')=='year' || request('date_type')=='month')?'':'d-none' }}">
                        <option value="">Tahun</option>
                        @foreach($tahunList ?? [] as $t)
                            <option value="{{ $t }}" {{ request('year')==$t?'selected':'' }}>
                                {{ $t }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            {{-- SEARCH --}}
            <input type="text" name="search"
                   class="form-control form-control-sm"
                   placeholder="Cari PIC/instansi/layanan"
                   value="{{ request('search') }}">

            {{-- BUTTONS --}}
            <button class="btn btn-success btn-mini">
                <i class="bi bi-filter"></i> Filter
            </button>

            <a href="{{ route('admin.hasiluji.printlist', request()->query()) }}"
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
                <th>PIC / Instansi</th>
                <th>Layanan</th>
                <th style="width:140px;">Tanggal Permintaan</th>
                <th style="width:280px;">Aksi</th>
            </tr>
            </thead>
            <tbody>
            @forelse($requests as $item)
                @php
                    $statusLower = strtolower(trim($item->status));
                    $canAction = in_array($statusLower, [
                        'uji selesai','verifikasi hasil uji','penerbitan lhu'
                    ]);
                    $hasil = $item->result;
                    $uploaded = $hasil && $hasil->result_file;
                @endphp
                <tr>
                    <td data-label="No">
                        <div class="num-badge">
                            {{ $loop->iteration + ($requests->currentPage()-1)*$requests->perPage() }}
                        </div>
                    </td>

                    <td data-label="PIC / Instansi">
                        <div class="fw-semibold">{{ $item->pic_name }}</div>
                        <div class="text-muted small">{{ $item->user->instansi ?? '-' }}</div>
                    </td>

                    <td data-label="Layanan" class="text-capitalize">{{ $item->service_type }}</td>
                    <td data-label="Tanggal Permintaan">{{ $item->created_at->format('d-m-Y') }}</td>

                    <td data-label="Aksi">
                        @if($canAction)

                            <div class="action-stack">

                                {{-- ===== PAIR 1: HASIL (Edit/Isi -> Print) ===== --}}
                                <div class="action-pair">
                                    <div class="pair-title">Hasil Uji</div>
                                    <div class="action-row">
                                        <a href="{{ route('admin.hasiluji.form',$item->id) }}"
                                           class="btn btn-primary action-btn">
                                            <i class="bi bi-pencil-square"></i>
                                            {{ $hasil ? 'Edit Hasil' : 'Isi Hasil' }}
                                        </a>

                                        <span class="action-arrow">
                                            <i class="bi bi-arrow-right"></i>
                                        </span>

                                        <a href="{{ route('admin.hasiluji.print',$item->id) }}"
                                           class="btn btn-outline-dark action-btn {{ !$hasil ? 'disabled' : '' }}"
                                           @if(!$hasil) aria-disabled="true" @endif>
                                            <i class="bi bi-printer"></i> Print Hasil
                                        </a>
                                    </div>
                                    @if(!$hasil)
                                        <div class="small text-muted">
                                            Print aktif setelah hasil diisi.
                                        </div>
                                    @endif
                                </div>

                                {{-- ===== PAIR 2: FILE (Upload -> Unduh) ===== --}}
                                <div class="action-pair">
                                    <div class="pair-title">File Hasil</div>
                                    <div class="action-row">
                                        <button class="btn btn-outline-success action-btn"
                                                data-bs-toggle="modal"
                                                data-bs-target="#uploadModal{{ $item->id }}">
                                            <i class="bi bi-upload"></i> Upload File
                                        </button>

                                        <span class="action-arrow">
                                            <i class="bi bi-arrow-right"></i>
                                        </span>

                                        <a href="{{ route('admin.hasiluji.download',$item->id) }}"
                                           class="btn btn-outline-secondary action-btn {{ !$uploaded ? 'disabled' : '' }}"
                                           @if(!$uploaded) aria-disabled="true" @endif>
                                            <i class="bi bi-download"></i> Unduh
                                        </a>
                                    </div>

                                    @if(!$uploaded)
                                        <div class="small text-muted">
                                            Unduh aktif setelah file di-upload.
                                        </div>
                                    @endif
                                </div>

                            </div>

                        @else
                            <span class="badge bg-light text-muted border">Belum bisa diproses</span>
                            <div class="small text-muted mt-1">
                                Status sekarang: <span class="fw-semibold text-capitalize">{{ $item->status }}</span>
                            </div>
                        @endif
                    </td>
                </tr>

                {{-- MODAL UPLOAD --}}
                @if($canAction)
                <div class="modal fade" id="uploadModal{{ $item->id }}" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form method="POST"
                                  action="{{ route('admin.hasiluji.upload',$item->id) }}"
                                  enctype="multipart/form-data">
                                @csrf
                                <div class="modal-header">
                                    <h5 class="modal-title">Upload Dokumen Hasil Uji</h5>
                                    <button class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <input type="file" name="result_file" class="form-control" required>
                                    <small class="text-muted">PDF/DOCX/XLSX/JPG/PNG max 5MB</small>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-success w-100">Upload</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @endif

            @empty
                <tr>
                    <td colspan="5" class="text-center text-muted py-4">Belum ada data permintaan.</td>
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
});
</script>

@endsection
