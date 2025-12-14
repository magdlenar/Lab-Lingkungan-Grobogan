@extends('layouts.admin') 
@section('title', 'Akun Terdaftar')

@section('content')

<style>
/* ===== FILTER CARD COMPACT & FIT CONTENT (senada hasil uji) ===== */
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

/* ===== DATE GROUP (SAMA DENGAN PERMINTAAN) ===== */
.date-group{
    display:flex;
    align-items:center;
    gap:8px;
    padding:6px;
    background:#f8fafc;
    border:1px solid #e5e7eb;
    border-radius:12px;
}

/* ukuran kompak input/select */
.filter-form select,
.filter-form input{
    height:34px;
    font-size:13px;
    padding:4px 8px;
    border-radius:10px;
    white-space:nowrap;
}

/* date type kecil */
.date-type{
    width:140px;
    min-width:140px;
}

/* DATE VALUE WRAP FLEX (bisa 1 atau 2 input) */
.date-value-wrap{
    display:flex;
    align-items:center;
    gap:6px;
    min-width:150px;
}
.date-value-wrap .date-input{ width:160px; }
.date-value-wrap .month-input{ width:130px; }
.date-value-wrap .year-input{ width:95px; }
.date-value-wrap.year-mode .year-input{ width:160px; }

/* search kecil */
.filter-form input[name="search"]{
    width:190px;
    min-width:190px;
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
    min-width:auto;
}

/* print mini */
.print-btn{
    background:transparent;
    border:1.5px solid #28a745;
    color:#28a745;
    transition:.2s;
}
.print-btn:hover{ background:#28a745; color:#fff; }
.print-btn i{ font-size:16px; }

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
.modern-table tbody tr:hover { background: #eef6ff; transition: 0.2s; }
.modern-table tbody td {
    padding: 14px 16px;
    font-size: 14px;
    color: #333;
    white-space: nowrap;
    vertical-align: middle;
}

/* BADGE NUMBER */
.num-badge {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background: #eef4ff;
    color: #189e1e;
    font-weight: 600;
    display: flex;
    align-items: center;
    justify-content: center;
    border: 2px solid #dfe8ff;
    font-size: 13px;
}

/* ===================== PAGINATION MODERN (SAMAKAN DENGAN GALERI) ===================== */
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

/* Prev/Next jadi pill kecil */
.pagination-modern-wrap .page-item:first-child .page-link,
.pagination-modern-wrap .page-item:last-child .page-link{
    width:auto;height:32px;
    padding:0 12px;
    border-radius:999px !important;
    font-weight:800;
}

/* disable look lebih soft */
.pagination-modern-wrap .page-item.disabled .page-link{
    opacity:.5;
    background:#f8fafc;
}

/* ===================== ACTION BUTTONS (SAMAKAN PERMINTAAN UJI) ===================== */
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

/* Delete: soft red icon (sama persis) */
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

/* ===== MOBILE (filter + table card) ===== */
@media (max-width:576px){
    .filter-card{ width:100%; max-width:100%; }
    .filter-form{
        flex-wrap:wrap;
        align-items:stretch;
        gap:8px;
        width:100%;
    }

    .date-group{
        width:100%;
        max-width:100%;
        flex-wrap:wrap;
        justify-content:flex-start;
        gap:6px;
        padding:8px;
        box-sizing:border-box;
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

    /* ===== TABLE CARD MODE ===== */
    .modern-table thead{ display:none; }

    .modern-table tbody tr{
        display:block;
        width:100%;
        max-width:100%;
        box-sizing:border-box;
        margin-bottom:12px;
        background:#fff;
        border-radius:12px;
        padding:10px 12px;
        box-shadow:0 3px 8px rgba(0,0,0,0.05);
        overflow:hidden;
    }

    .modern-table tbody td{
        display:flex;
        justify-content:space-between;
        align-items:flex-start;
        gap:10px;
        width:100%;
        max-width:100%;
        box-sizing:border-box;

        white-space:normal;
        overflow-wrap:anywhere;
        word-break:break-word;
        padding:8px 6px;
        font-size:13.5px;
        border-bottom:1px solid #f0f0f0;
    }

    .modern-table tbody td:last-child{ border-bottom:none; }

    .modern-table tbody td::before{
        content:attr(data-label);
        font-weight:600;
        color:#475569;
        flex:0 0 42%;
        max-width:42%;
        overflow-wrap:anywhere;
    }

    .modern-table tbody td[data-label="Aksi"]{
        flex-direction:column;
        align-items:flex-end;
        gap:6px;
    }

    /* pagination tidak kebesaran di HP */
    .pagination-modern-wrap .pagination{
        flex-wrap:wrap;
        border-radius:16px;
        padding:8px;
        gap:5px;
    }
}
</style>

<div class="container-fluid">

    <div class="filter-card">
        <form method="GET" action="" class="filter-form">

            {{-- DATE GROUP (SAMA DENGAN PERMINTAAN) --}}
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
                        @for($y = date('Y'); $y >= 2020; $y--)
                            <option value="{{ $y }}" {{ request('year')==$y ? 'selected':'' }}>
                                {{ $y }}
                            </option>
                        @endfor
                    </select>
                </div>
            </div>

            {{-- SEARCH --}}
            <input type="text" name="search"
                   class="form-control form-control-sm"
                   placeholder="Cari akun..."
                   value="{{ request('search') }}">

            {{-- BUTTON FILTER --}}
            <button class="btn btn-success btn-mini">
                <i class="bi bi-filter"></i> Filter
            </button>

            {{-- PRINT --}}
            <a href="{{ route('admin.akun.print', request()->query()) }}"
               class="btn print-btn btn-mini">
                <i class="bi bi-printer"></i> Print
            </a>

        </form>
    </div>

    <!-- TABLE -->
    <div class="modern-table-wrapper">
        <table class="table modern-table align-middle">
            <thead> 
                <tr> 
                    <th>No</th> 
                    <th>Nama</th> 
                    <th>Email</th> 
                    <th>No. HP</th> 
                    <th>Instansi</th> 
                    <th>Terdaftar</th>
                    <th>Aksi</th> 
                </tr>
             </thead>
            <tbody>
            @forelse ($users as $u)
                <tr>
                    <td data-label="No">
                        <div class="num-badge">
                            {{ $loop->iteration + ($users->currentPage()-1)*$users->perPage() }}
                        </div>
                    </td>

                    <td data-label="Nama">{{ $u->nama }}</td>
                    <td data-label="Email">{{ $u->email }}</td>
                    <td data-label="Nomor HP">{{ $u->nomor_hp ?? '-' }}</td>
                    <td data-label="Instansi">{{ $u->instansi ?? '-' }}</td>
                    <td data-label="Terdaftar">{{ $u->created_at->format('d M Y') }}</td>

                    <td data-label="Aksi">
                        <div class="d-flex justify-content-end">
                            <button class="btn action-btn delete-btn"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modalDelete{{ $u->id }}">
                                <i class="bi bi-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>

                {{-- MODAL DELETE --}}
                <div class="modal fade" id="modalDelete{{ $u->id }}" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="{{ route('admin.akun.destroy', $u->id) }}" method="POST">
                                @csrf
                                @method('DELETE')

                                <div class="modal-header bg-danger text-white">
                                    <h5 class="modal-title">Hapus Akun</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>

                                <div class="modal-body">
                                    <p class="mb-1">
                                        Apakah Anda yakin ingin menghapus akun ini?
                                    </p>
                                    <div class="alert alert-warning small mt-2" style="border-radius: 10px;">
                                        Tindakan ini <strong>tidak dapat dibatalkan</strong>.
                                    </div>

                                    <div class="small text-muted">
                                        <b>Nama:</b> {{ $u->nama }} <br>
                                        <b>Email:</b> {{ $u->email }}
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
                    <td colspan="7" class="text-center text-muted py-4">
                        Tidak ada akun ditemukan.
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <!-- PAGINATION (SAMAKAN GALERI) -->
    @if($users->hasPages())
        <div class="mt-3 pagination-modern-wrap">
            {{ $users->appends(request()->query())->links('pagination::bootstrap-5') }}
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
