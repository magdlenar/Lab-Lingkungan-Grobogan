@extends('layouts.app')

@section('content')

@php
    // Tahapan standar
    $steps = [
        'pemeriksaan kelengkapan',
        'persyaratan tidak lengkap',
        'persyaratan lengkap',
        'jadwal pengambilan sampel',
        'pengambilan sampel',
        'uji selesai',
        'verifikasi hasil uji',
        'penerbitan lhu'
    ];

    $currentReq = $requests->last();
@endphp

<style>
    :root{
        --green:#189e1e;
        --green-soft:#f0fdf4;
        --ink:#0f172a;
        --muted:#64748b;
        --card:#ffffff;
        --line:#e8eef5;
    }

    /* ✅ spacing aman dari navbar + page feel lebih modern */
    .page-wrap{
        padding-top: clamp(22px, 5vh, 56px);
        padding-bottom: clamp(24px, 4vh, 44px);
        background: linear-gradient(180deg, #f8fafc 0%, #ffffff 60%);
        min-height: calc(100vh - 80px);
    }

    /* ✅ card modern */
    .ui-card{
        background: var(--card);
        border:1px solid var(--line);
        border-radius: 18px;
        box-shadow: 0 10px 30px rgba(2,6,23,.06);
        padding: 20px;
    }
    .ui-card + .ui-card{ margin-top: 14px; }

    .ui-title{
        font-weight: 800;
        color: var(--ink);
        letter-spacing: .2px;
        display:flex;
        align-items:center;
        gap:8px;
        font-size: 18px;
    }
    .ui-title .dot{
        width:10px;height:10px;border-radius:999px;background:var(--green);
        box-shadow:0 0 0 4px rgba(24,158,30,.12);
    }

    /* ✅ table lebih clean */
    .status-table thead th{
        font-size: 12.5px;
        text-transform: uppercase;
        letter-spacing: .6px;
        color:#334155;
        background:#f8fafc !important;
        border-bottom:1px solid var(--line);
    }
    .status-table td{
        vertical-align: middle;
        border-color: var(--line);
        font-size: 14px;
    }

    .badge-soft{
        padding:6px 10px;
        font-weight:800;
        border-radius:999px;
        font-size:12px;
        letter-spacing:.2px;
    }

    .btn-modern{
        background: var(--green);
        color:#fff;
        border-radius:12px;
        font-weight:700;
        transition:.25s ease;
        border:none;
        padding:8px 12px;
        box-shadow: 0 6px 14px rgba(24,158,30,.2);
    }
    .btn-modern:hover{
        background:#1fb726;
        transform: translateY(-1px);
        color:#fff;
    }

    /* ===== RIGHT ACCORDION ===== */
    .step-acc .accordion-item{
        border:1px solid var(--line);
        border-radius:16px !important;
        overflow:hidden;
        box-shadow:0 8px 22px rgba(2,6,23,.06);
        margin-bottom:12px;
        background:#fff;
    }
    .step-acc .accordion-button{
        background:#fff;
        padding:14px 14px;
        font-weight:800;
        font-size:14px;
        color:var(--ink);
        gap:10px;
    }
    .step-acc .accordion-button:not(.collapsed){
        background:var(--green-soft);
        color:#166534;
        box-shadow:none;
    }
    .step-acc .accordion-body{
        background:#fff;
        padding:14px 14px 8px;
    }

    .req-head{display:flex;flex-direction:column;gap:8px;width:100%;}
    .req-top{display:flex;align-items:center;justify-content:space-between;gap:10px;}
    .req-service{
        font-weight:900;font-size:14px;color:var(--ink);text-transform:capitalize;
        display:flex;align-items:center;gap:8px;
    }
    .req-badge{
        font-size:11.5px;font-weight:900;text-transform:capitalize;
        padding:4px 9px;border-radius:999px;
        display:inline-flex;align-items:center;gap:6px;white-space:nowrap;
    }

    .progress-wrap{display:flex;align-items:center;gap:8px;}
    .progress{
        height:8px;border-radius:999px;background:#eef2f7;flex:1;overflow:hidden;
    }
    .progress-bar{
        --progress:0%;
        width:var(--progress);
        height:100%;
        background:linear-gradient(90deg,var(--green),#1fb726);
        transition: width .3s ease;
    }
    .progress-info{
        font-size:11.5px;font-weight:800;color:var(--muted);white-space:nowrap;
    }

    .step-wrapper{display:flex;flex-direction:column;gap:10px;margin-top:6px;}
    .step-item{display:flex;gap:10px;align-items:flex-start;}
    .step-number{
        width:28px;height:28px;border-radius:50%;
        display:flex;align-items:center;justify-content:center;
        font-weight:900;font-size:12px;border:2px solid var(--green);
        color:var(--green);background:#fff;flex-shrink:0;
    }
    .step-number.active{background:var(--green);color:#fff;}
    .step-item.completed .step-number{
        background:#e9f7ef;border-color:#16a34a;color:#16a34a;
    }
    .step-text{
        font-weight:700;font-size:13.5px;color:#334155;text-transform:capitalize;
        line-height:1.4;
    }
    .step-item.completed .step-text{
        color:#16a34a;text-decoration:line-through;
    }

    /* ✅ biar right column enak di desktop */
    @media (min-width: 992px){
        .right-sticky{
            position: sticky;
            top: 90px;
        }
    }

    /* ===================== PAGINATION MODERN (SAMA PERSIS) ===================== */
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

    /* ✅ mobile friendly */
    @media (max-width: 576px){
        .ui-card{ padding:16px; border-radius:14px; }
        .ui-title{ font-size:16px; }
        .status-table td{ font-size:13.5px; }
        .req-service{ font-size:13px; }
        .step-text{ font-size:13px; }

        /* pagination tidak kebesaran di HP */
        .pagination-modern-wrap .pagination{
            flex-wrap:wrap;
            border-radius:16px;
            padding:8px;
            gap:5px;
        }
    }
</style>



<div class="page-wrap">
    <div class="container">
        <div class="row g-3 g-lg-4">

            {{-- LEFT --}}
            <div class="col-lg-7">

                {{-- CARD: TABLE STATUS --}}
                <div class="ui-card">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="ui-title">
                            <span class="dot"></span>
                            Status Permintaan Uji
                        </div>
                        <span class="text-muted small fw-semibold">
                            Total: {{ $requests->total() }}
                        </span>
                    </div>

                    <div class="table-responsive">
                        <table class="table status-table align-middle mb-0">
                            <thead>
                                <tr>
                                    <th style="width: 30%;">Layanan</th>
                                    <th style="width: 30%;">Status</th>
                                    <th style="width: 40%;">Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                            @forelse($requests as $req)
                                <tr>
                                    {{-- LAYANAN --}}
                                    <td class="fw-semibold text-capitalize">
                                        {{ $req->service_type }}
                                    </td>

                                    {{-- STATUS --}}
                                    <td>
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
                                            ][$req->status] ?? 'primary';
                                        @endphp

                                        <span class="badge bg-{{ $color }} badge-soft text-capitalize">
                                            {{ $req->status }}
                                        </span>

                                        @if(in_array($req->status, ['jadwal pengambilan sampel', 'pengambilan sampel']) && $req->sample_pickup_date)
                                            <div class="mt-2">
                                                <span class="badge bg-info text-dark badge-soft">
                                                    <i class="bi bi-calendar2-week me-1"></i>
                                                    {{ \Carbon\Carbon::parse($req->sample_pickup_date)->translatedFormat('d F Y') }}
                                                </span>
                                            </div>
                                        @endif
                                    </td>

                                    {{-- AKSI --}}
                                    <td>
                                        @if($req->status == 'persyaratan tidak lengkap')
                                            <button class="btn btn-modern btn-sm w-100"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#modalUpdate{{ $req->id }}">
                                                <i class="bi bi-pencil-square me-1"></i>
                                                Perbaiki Persyaratan
                                            </button>

                                        @elseif(strtolower(trim($req->status)) == 'penerbitan lhu')
                                            <a href="{{ route('uji.hasil', $req->id) }}"
                                               class="btn btn-primary btn-sm w-100 fw-bold"
                                               style="border-radius:12px;">
                                                <i class="bi bi-file-earmark-text me-1"></i>
                                                Lihat Hasil Uji
                                            </a>

                                        @else
                                            <span class="text-muted small">Tidak ada aksi</span>
                                        @endif
                                    </td>
                                </tr>

                                {{-- MODAL UPDATE UNTUK CUSTOMER --}}
                                <div class="modal fade" id="modalUpdate{{ $req->id }}" tabindex="-1">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content" style="border-radius:16px;">
                                            <form action="{{ route('uji.update', $req->id) }}" method="POST" enctype="multipart/form-data">
                                                @csrf

                                                <div class="modal-header">
                                                    <h5 class="modal-title fw-bold">Perbaiki Persyaratan</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>

                                                <div class="modal-body">
                                                    @php
                                                        $fix_fields = json_decode($req->fix_fields ?? '[]', true);
                                                    @endphp

                                                    @if(in_array('letter_file', $fix_fields))
                                                        <div class="mb-3">
                                                            <label class="form-label fw-semibold">Upload Surat Permohonan Baru</label>
                                                            <input type="file" name="letter_file" class="form-control">
                                                        </div>
                                                    @endif

                                                    @if(in_array('pic_name', $fix_fields))
                                                        <div class="mb-3">
                                                            <label class="form-label fw-semibold">Nama PIC</label>
                                                            <input type="text" name="pic_name" value="{{ $req->pic_name }}" class="form-control" required>
                                                        </div>
                                                    @else
                                                        <input type="hidden" name="pic_name" value="{{ $req->pic_name }}">
                                                    @endif

                                                    @if(in_array('pic_phone', $fix_fields))
                                                        <div class="mb-3">
                                                            <label class="form-label fw-semibold">Nomor PIC</label>
                                                            <input type="text" name="pic_phone" value="{{ $req->pic_phone }}" class="form-control" required>
                                                        </div>
                                                    @else
                                                        <input type="hidden" name="pic_phone" value="{{ $req->pic_phone }}">
                                                    @endif

                                                    @if(in_array('pic_email', $fix_fields))
                                                        <div class="mb-3">
                                                            <label class="form-label fw-semibold">Email PIC</label>
                                                            <input type="email" name="pic_email" value="{{ $req->pic_email }}" class="form-control" required>
                                                        </div>
                                                    @else
                                                        <input type="hidden" name="pic_email" value="{{ $req->pic_email }}">
                                                    @endif

                                                    @if(in_array('sample_address', $fix_fields))
                                                        <div class="mb-3">
                                                            <label class="form-label fw-semibold">Alamat Pengambilan Sampel</label>
                                                            <input type="text" name="sample_address" value="{{ $req->sample_address }}" class="form-control" required>
                                                        </div>
                                                    @else
                                                        <input type="hidden" name="sample_address" value="{{ $req->sample_address }}">
                                                    @endif

                                                    <div class="mb-3">
                                                        <label class="form-label fw-semibold">Catatan Tambahan</label>
                                                        <textarea name="notes" class="form-control" rows="3">{{ $req->notes }}</textarea>
                                                    </div>

                                                    @if ($errors->any())
                                                        <div class="alert alert-danger small">
                                                            <ul class="mb-0 ps-3">
                                                                @foreach ($errors->all() as $error)
                                                                    <li>{{ $error }}</li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    @endif
                                                </div>

                                                <div class="modal-footer">
                                                    <button class="btn btn-modern w-100">Update</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                            @empty
                                <tr>
                                    <td colspan="3" class="text-center text-muted py-4">
                                        Belum ada permintaan uji.
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>

                        {{-- ✅ PAGINATION MODERN SENADA --}}
                        @if($requests->hasPages())
                            <div class="mt-3 pagination-modern-wrap">
                                {{ $requests->appends(request()->query())->links('pagination::bootstrap-5') }}
                            </div>
                        @endif
                    </div>
                </div>


                {{-- CARD: INFORMASI PEMBATALAN --}}
                <div class="ui-card">
                    <div class="alert alert-warning mb-3"
                        style="border-radius: 12px; font-size:14px;">
                        <strong><i class="bi bi-info-circle me-1"></i> Informasi</strong><br>
                        Untuk pembatalan permintaan uji silakan hubungi Admin Laboratorium.
                    </div>

                    <a href="https://wa.me/6281393395905?text=Halo%20Admin,%20saya%20ingin%20membatalkan%20permintaan%20uji."
                        target="_blank"
                        class="btn btn-success w-100 fw-bold"
                        style="border-radius:12px;">
                        <i class="bi bi-whatsapp me-1"></i> Hubungi Admin via WhatsApp
                    </a>
                </div>

            </div>


            {{-- RIGHT --}}
            <div class="col-lg-4">
                <div class="right-sticky">

                    <div class="ui-card mb-2">
                        <div class="ui-title mb-2">
                            <span class="dot"></span>
                            Tahapan Proses Uji
                        </div>
                        <p class="text-muted small mb-0">
                            Ringkasan progres tiap permintaan uji.
                        </p>
                    </div>

                    @php
                        $accId  = "accordionSteps";
                        $lastId = optional($requests->last())->id;
                    @endphp

                    @if($requests->count())
                        <div class="accordion step-acc" id="{{ $accId }}">

                        @foreach($requests as $req)
                            @php
                                $collapseId = 'collapseSteps'.$req->id;
                                $headingId  = 'headingSteps'.$req->id;

                                $current = strtolower(trim($req->status));
                                $currentIndex = array_search($current, $steps);
                                $totalSteps = count($steps);

                                $safeCurrentIndex = ($currentIndex !== false) ? $currentIndex : -1;

                                $progressPercent = $safeCurrentIndex >= 0
                                    ? intval((($safeCurrentIndex+1)/$totalSteps)*100)
                                    : 0;

                                $color = [
                                    'pemeriksaan kelengkapan' => 'primary',
                                    'persyaratan tidak lengkap' => 'danger',
                                    'persyaratan lengkap' => 'success',
                                    'jadwal pengambilan sampel' => 'info',
                                    'pengambilan sampel' => 'info',
                                    'uji selesai' => 'secondary',
                                    'verifikasi hasil uji' => 'warning',
                                    'penerbitan lhu' => 'dark',
                                ][$current] ?? 'primary';

                                $isOpen = ($req->id == $lastId);
                            @endphp

                            <div class="accordion-item">
                                <h2 class="accordion-header" id="{{ $headingId }}">
                                    <button class="accordion-button {{ $isOpen ? '' : 'collapsed' }}"
                                            type="button"
                                            data-bs-toggle="collapse"
                                            data-bs-target="#{{ $collapseId }}"
                                            aria-expanded="{{ $isOpen ? 'true' : 'false' }}"
                                            aria-controls="{{ $collapseId }}">

                                        <div class="req-head">
                                            <div class="req-top">
                                                <div class="req-service">
                                                    <i class="bi bi-flask text-success"></i>
                                                    {{ $req->service_type }}
                                                </div>

                                                <span class="req-badge bg-{{ $color }} text-white">
                                                    {{ $req->status }}
                                                </span>
                                            </div>

                                            <div class="progress-wrap">
                                                <div class="progress">
                                                    <div class="progress-bar" style="--progress: {{ $progressPercent }}%"></div>
                                                </div>
                                                <div class="progress-info">
                                                    {{ $progressPercent }}%
                                                </div>
                                            </div>
                                        </div>
                                    </button>
                                </h2>

                                <div id="{{ $collapseId }}"
                                     class="accordion-collapse collapse {{ $isOpen ? 'show' : '' }}"
                                     aria-labelledby="{{ $headingId }}"
                                     data-bs-parent="#{{ $accId }}">

                                    <div class="accordion-body">
                                        <div class="step-wrapper">
                                            @foreach($steps as $index => $step)
                                                @php
                                                    $isCompleted = ($index < $safeCurrentIndex);
                                                    $isActive    = ($index == $safeCurrentIndex);
                                                @endphp

                                                <div class="step-item {{ $isCompleted ? 'completed' : '' }}">
                                                    <div class="step-number {{ $isActive ? 'active' : '' }}">
                                                        {{ $index + 1 }}
                                                    </div>
                                                    <div class="step-text">
                                                        {{ $step }}
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                </div>
                            </div>
                        @endforeach

                        </div>
                    @else
                        <div class="ui-card">
                            <p class="text-muted text-center mb-0">Belum ada permintaan.</p>
                        </div>
                    @endif

                </div>
            </div>

        </div>
    </div>
</div>

@endsection
