@extends('layouts.app')
@section('title','Hasil Uji')

@section('content')

@php
    $currentReq = $requests->last();
@endphp

<style>
    :root{
        --green:#189e1e;
        --green-soft:#f0fdf4;
        --ink:#0f172a;
        --muted:#64748b;
        --line:#e7edf3;
        --card:#ffffff;
    }

    /* ✅ background senada & aman dari navbar */
    .profile-bg{
        min-height: 100vh;
        padding: clamp(22px, 5vh, 56px) 0 40px;
        background:
            radial-gradient(700px circle at 10% -10%, #e8f7ec 0, transparent 55%),
            radial-gradient(700px circle at 110% 0%, #e9f6ff 0, transparent 55%),
            linear-gradient(180deg, #f6faf7 0%, #ffffff 65%);
    }

    /* ===== CARD HEADER + TABLE ===== */
    .profile-card, .table-card{
        background:var(--card);
        border-radius:18px;
        padding:22px;
        box-shadow:0 10px 28px rgba(2,6,23,.07);
        border:1px solid var(--line);
        width:100%;
        max-width:100%;
        margin-left:auto;
        margin-right:auto;
        box-sizing:border-box;
    }

    .profile-title{
        font-weight:900;
        color:var(--ink);
        display:flex;
        justify-content:center;
        align-items:center;
        gap:10px;
        margin:0;
        letter-spacing:.2px;
    }
    .title-icon{
        width:40px;height:40px;border-radius:12px;
        display:grid;place-items:center;
        background:var(--green-soft);
        color:#166534;
        border:1px solid #bbf7d0;
        font-size:16px;
        flex-shrink:0;
        box-shadow:0 6px 14px rgba(22,163,74,.12);
    }

    .subtitle{
        color:var(--muted);
        font-size:13.5px;
        text-align:center;
        margin-top:6px;
    }

    /* table wrapper */
    .table-card{
        padding:0;
        overflow:hidden;
    }
    .table-responsive{ margin:0; }

    /* table style modern */
    .table thead{
        background:#f8fafc;
        border-bottom:1px solid var(--line);
    }
    .table th{
        font-size:12.5px;
        text-transform:uppercase;
        letter-spacing:.6px;
        font-weight:800;
        color:#334155;
        white-space:nowrap;
        padding:14px 16px;
        text-align:left;
    }
    .table td{
        font-size:14px;
        white-space:nowrap;
        vertical-align:middle;
        padding:12px 16px;
        border-bottom:1px solid #f1f5f9;
    }
    .table tbody tr:nth-child(even){
        background:#fbfdff;
    }
    .table tbody tr:hover{
        background:#f0fdf4;
        transition:.15s;
    }

    .num-badge{
        width:32px;height:32px;border-radius:50%;
        background:#eef4ff;color:var(--green);font-weight:800;
        display:flex;align-items:center;justify-content:center;
        border:2px solid #dfe8ff;font-size:13px;
    }

    .btn-modern{
        background:var(--green);
        color:#fff;
        border-radius:10px;
        transition:.25s;
        font-weight:800;
        border:none;
    }
    .btn-modern:hover{
        background:#1fb726;
        transform: translateY(-1px);
        color:#fff;
    }

    /* tombol toggle detail mobile */
    .btn-toggle-detail{
        border-radius:10px;
        font-weight:700;
        font-size:12.5px;
        padding:6px 10px;
        display:inline-flex;
        align-items:center;
        gap:6px;
        border:1px solid #cfe8d0;
        color:var(--green);
        background:var(--green-soft);
    }
    .btn-toggle-detail:hover{
        background:var(--green);
        color:#fff;
        border-color:var(--green);
    }

    /* ===================== PAGINATION MODERN (SAMA GALERI) ===================== */
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

    /* ===== MOBILE CARD MODE + COLLAPSE DETAIL ===== */
    @media(max-width:576px){
        .profile-card{ padding:16px; }
        .table thead{ display:none; }

        .table tbody tr.main-row{
            display:block;
            margin:12px;
            padding:12px 12px;
            border-radius:12px;
            background:#fff;
            box-shadow:0 3px 8px rgba(0,0,0,.05);
        }

        .table tbody tr.detail-row{
            display:block;
            margin:-6px 12px 12px;
            padding:0;
            background:transparent;
            box-shadow:none;
        }

        .table tbody tr.main-row td{
            display:flex;
            justify-content:space-between;
            white-space:normal;
            border-bottom:1px solid #f1f5f9;
            padding:8px 0;
            gap:10px;
        }
        .table tbody tr.main-row td:last-child{ border-bottom:none; }

        .table tbody tr.main-row td::before{
            content:attr(data-label);
            font-weight:800;
            color:#475569;
            flex:0 0 45%;
        }

        .mobile-hide{ display:none !important; }

        .detail-box{
            background:#fff;
            border-radius:12px;
            padding:12px 12px;
            box-shadow:0 3px 8px rgba(0,0,0,.04);
            border:1px solid #eef1f5;
        }
        .detail-item{
            display:flex;
            justify-content:space-between;
            gap:12px;
            padding:6px 0;
            border-bottom:1px dashed #e5e7eb;
            font-size:13.5px;
        }
        .detail-item:last-child{ border-bottom:none; }

        .detail-label{
            font-weight:800;
            color:#475569;
        }

        .action-wrap{
            width:100%;
            display:flex;
            flex-direction:column;
            gap:8px;
            margin-top:8px;
        }
        .action-wrap a{
            width:100%;
            justify-content:center;
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

<div class="profile-bg">
    <div class="container py-3">

        {{-- HEADER CARD --}}
        <div class="profile-card mb-3">
            <h3 class="profile-title mb-1">
                <span class="title-icon">
                    <i class="bi bi-bar-chart-line"></i>
                </span>
                <span>Hasil Uji</span>
            </h3>
            <div class="subtitle">
                Data hasil uji yang sudah diterbitkan admin bisa kamu lihat dan unduh di sini.
            </div>
        </div>

        {{-- TABLE CARD --}}
        <div class="table-card">
            <div class="table-responsive">
                <table class="table mb-0 align-middle">
                    <thead class="table-light">
                    <tr>
                        <th style="width:70px;">No</th>
                        <th>Layanan</th>
                        <th class="nowrap">Tgl Permintaan</th>
                        <th class="nowrap">Tgl Hasil Diisi</th>
                        <th style="width:220px;">Aksi</th>
                    </tr>
                    </thead>

                    <tbody>
                    @forelse($requests as $item)
                        @php
                            $hasil = $item->result;
                            $tglHasil = $hasil?->updated_at ?? $hasil?->created_at;
                        @endphp

                        {{-- MAIN ROW --}}
                        <tr class="main-row">
                            <td data-label="No">
                                <div class="num-badge">
                                    {{ $loop->iteration + ($requests->currentPage()-1)*$requests->perPage() }}
                                </div>
                            </td>

                            <td data-label="Layanan" class="text-capitalize fw-semibold">
                                {{ $item->service_type }}

                                {{-- toggle mobile --}}
                                <div class="mt-2 d-sm-none">
                                    <button class="btn-toggle-detail"
                                            data-bs-toggle="collapse"
                                            data-bs-target="#detail{{ $item->id }}"
                                            aria-expanded="false">
                                        <i class="bi bi-chevron-down"></i>
                                        <span class="toggle-text">Lihat Detail</span>
                                    </button>
                                </div>
                            </td>

                            <td data-label="Tgl Permintaan" class="mobile-hide">
                                {{ $item->created_at->format('d-m-Y') }}
                            </td>

                            <td data-label="Tgl Hasil Diisi" class="mobile-hide">
                                {{ $tglHasil ? \Carbon\Carbon::parse($tglHasil)->format('d-m-Y') : '-' }}
                            </td>

                            <td data-label="Aksi" class="mobile-hide">
                                <div class="d-flex flex-wrap gap-2">
                                    <a href="{{ route('uji.hasil',$item->id) }}"
                                       class="btn btn-modern btn-sm">
                                        <i class="bi bi-eye me-1"></i> Lihat Hasil
                                    </a>

                                    @if($hasil && $hasil->result_file)
                                        <a href="{{ route('uji.hasil.download',$item->id) }}"
                                           class="btn btn-outline-success btn-sm"
                                           style="border-radius:10px;font-weight:700;">
                                            <i class="bi bi-download me-1"></i> Unduh File
                                        </a>
                                    @endif
                                </div>
                            </td>
                        </tr>

                        {{-- DETAIL ROW (MOBILE COLLAPSE) --}}
                        <tr class="detail-row d-sm-none">
                            <td colspan="5" class="p-0 border-0">
                                <div class="collapse" id="detail{{ $item->id }}">
                                    <div class="detail-box">
                                        <div class="detail-item">
                                            <div class="detail-label">Tgl Permintaan</div>
                                            <div>{{ $item->created_at->format('d-m-Y') }}</div>
                                        </div>
                                        <div class="detail-item">
                                            <div class="detail-label">Tgl Hasil Diisi</div>
                                            <div>{{ $tglHasil ? \Carbon\Carbon::parse($tglHasil)->format('d-m-Y') : '-' }}</div>
                                        </div>

                                        <div class="action-wrap">
                                            <a href="{{ route('uji.hasil',$item->id) }}"
                                               class="btn btn-modern btn-sm">
                                                <i class="bi bi-eye me-1"></i> Lihat Hasil
                                            </a>

                                            @if($hasil && $hasil->result_file)
                                                <a href="{{ route('uji.hasil.download',$item->id) }}"
                                                   class="btn btn-outline-success btn-sm"
                                                   style="border-radius:10px;font-weight:700;">
                                                    <i class="bi bi-download me-1"></i> Unduh File
                                                </a>
                                            @else
                                                <div class="text-muted small text-center">File belum tersedia</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">
                                Belum ada hasil uji yang tersedia.
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- ✅ PAGINATION MODERN (SAMA GALERI) --}}
        @if($requests->hasPages())
            <div class="mt-3 pagination-modern-wrap">
                {{ $requests->appends(request()->query())->links('pagination::bootstrap-5') }}
            </div>
        @endif

    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('[data-bs-toggle="collapse"]').forEach(btn => {
        const target = document.querySelector(btn.getAttribute('data-bs-target'));
        if(!target) return;

        target.addEventListener('show.bs.collapse', () => {
            btn.querySelector('.toggle-text').textContent = 'Sembunyikan Detail';
            btn.querySelector('i').classList.replace('bi-chevron-down','bi-chevron-up');
        });

        target.addEventListener('hide.bs.collapse', () => {
            btn.querySelector('.toggle-text').textContent = 'Lihat Detail';
            btn.querySelector('i').classList.replace('bi-chevron-up','bi-chevron-down');
        });
    });
});
</script>

@endsection
