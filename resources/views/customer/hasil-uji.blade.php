@extends('layouts.app')
@section('title','Detail Hasil Uji')

@section('content')
<style>
    :root{
        --green:#189e1e;
        --green-soft:#f0fdf4;
        --ink:#0f172a;
        --muted:#64748b;
        --line:#e7edf3;
        --card:#ffffff;
    }

    .page-bg{
        min-height:100vh;
        width:100%;
        padding: clamp(22px, 5vh, 56px) 0 40px;
        background:
            radial-gradient(700px circle at 10% -10%, #e8f7ec 0, transparent 55%),
            radial-gradient(700px circle at 110% 0%, #e9f6ff 0, transparent 55%),
            linear-gradient(180deg, #f6faf7 0%, #ffffff 65%);
    }

    .wrap{ padding: 0; }

    .card-soft{
        background:var(--card);
        border-radius:18px;
        padding:18px;
        box-shadow:0 10px 28px rgba(2,6,23,.07);
        border:1px solid var(--line);
    }

    .header-title{
        font-weight:900;
        color:var(--ink);
        display:flex;
        align-items:center;
        gap:10px;
        margin:0;
        letter-spacing:.2px;
    }
    .title-icon{
        width:42px;height:42px;border-radius:14px;
        display:grid;place-items:center;
        background:var(--green-soft);
        color:#166534;
        border:1px solid #bbf7d0;
        font-size:18px;
        flex-shrink:0;
        box-shadow:0 6px 14px rgba(22,163,74,.12);
    }

    .btn-modern{
        background:var(--green);
        color:#fff;
        border-radius:12px;
        font-weight:800;
        padding:9px 12px;
        transition:.25s;
        border:none;
        box-shadow:0 8px 18px rgba(24,158,30,.22);
        display:inline-flex;
        align-items:center;
        gap:7px;
        justify-content:center;
    }
    .btn-modern:hover{
        background:#1fb726;
        transform:translateY(-1px);
        color:#fff;
    }

    /* ===== TABLE PARAMETER (DESKTOP) ===== */
    .param-table{
        width:100%;
        border-collapse:separate;
        border-spacing:0 6px;
    }
    .param-table thead th{
        font-size:13px;
        text-transform:uppercase;
        letter-spacing:.3px;
        color:#64748b;
        border:none;
        padding:8px 10px 4px;
    }
    .param-table tbody tr{
        background:#f8fafc;
        border-radius:12px;
        overflow:hidden;
        box-shadow:0 1px 3px rgba(15,23,42,.05);
    }
    .param-table tbody td{
        border:none !important;
        padding:9px 10px !important;
        font-size:13.5px;
    }
    .param-name{
        font-weight:600;
        color:#0f172a;
        width:45%;
    }
    .param-value{
        font-weight:700;
        text-align:right;
        color:#111827;
        width:25%;
    }
    .param-unit{
        font-weight:500;
        text-align:right;
        color:#64748b;
        width:20%;
        white-space:nowrap;
    }

    /* ===== MOBILE MODE (lebih minimalis & efisien) ===== */
    @media(max-width:768px){
        .page-bg{
            padding:18px 0 30px;
            background:#f5f7fa;
        }

        .card-soft{
            padding:14px;
            border-radius:14px;
            box-shadow:0 6px 16px rgba(15,23,42,.06);
        }

        .header-title{
            font-size:16px;
        }
        .title-icon{
            width:36px;height:36px;border-radius:12px;font-size:16px;
        }

        .param-table{
            border-spacing:0 4px;
        }
        .param-table thead{
            display:none; /* hide header, jadi list kartu */
        }
        .param-table tbody tr{
            display:block;
            padding:0; /* padding dipegang td */
        }
        .param-table tbody td{
            display:block;
            width:100%;
            padding:6px 9px !important;
            font-size:13px;
        }

        .param-name{
            margin-bottom:2px;
        }

        .param-value{
            text-align:left;
            font-weight:700;
            margin-bottom:1px;
        }

        .param-unit{
            text-align:left;
            font-size:12px;
            color:#94a3b8;
            font-weight:500;
        }
        .param-unit::before{
            content:"Satuan: ";
            font-weight:500;
            color:#94a3b8;
        }

        .btn-modern{
            width:100%;
            justify-content:center;
        }
    }
</style>

@php
    $hasil = $req->result;

    // definisi parameter + key + default satuan
    $rows = [
        ['Temperatur','suhu','°C'],
        ['Padatan Terlarut Total (TDS)','tds','mg/l'],
        ['Padatan Tersuspensi Total (TSS)','tss','mg/l'],
        ['Tingkat Keasaman (pH)','ph','-'],
        ['Kebutuhan Oksigen Biokimiawi (BOD)','bod','mg/l'],
        ['Kebutuhan Oksigen Kimiawi (COD)','cod','mg/l'],
        ['Oksigen Terlarut (DO)','do','mg/l'],
        ['Nitrat (sebagai N)','nitrat','mg/l'],
        ['Amonia (sebagai N)','amonia','mg/l'],
        ['Total Fosfat (sebagai P)','total_fosfat','mg/l'],
        ['Fecal Coliform','fecal_coliform','MPN/100ml'],
        ['Daya Hantar Listrik (DHL)','daya_hantar_listrik','µS/cm'],
        ['Kekeruhan','kekeruhan','NTU'],
    ];
@endphp

<div class="page-bg">
    <div class="wrap" style="max-width:820px;margin:auto;">

        {{-- HEADER CARD --}}
        <div class="card-soft mb-3">
            <div class="d-flex justify-content-between align-items-start flex-wrap gap-3">

                <div>
                    <h5 class="header-title mb-1">
                        <span class="title-icon">
                            <i class="bi bi-clipboard-data"></i>
                        </span>
                        Detail Hasil Uji
                    </h5>

                    <div class="small text-muted mt-1">
                        <div>
                            <i class="bi bi-flask me-1"></i>
                            Layanan:
                            <span class="fw-semibold text-capitalize text-dark">
                                {{ $req->service_type }}
                            </span>
                        </div>
                        <div class="mt-1">
                            <i class="bi bi-calendar2-week me-1"></i>
                            Tanggal Permintaan:
                            {{ $req->created_at->translatedFormat('d F Y') }}
                        </div>
                    </div>
                </div>

                <div class="text-end" style="min-width:160px;">
                    @if($hasil && $hasil->result_file)
                        <a href="{{ route('uji.hasil.download',$req->id) }}"
                           class="btn-modern btn-sm">
                            <i class="bi bi-download"></i> Unduh Dokumen
                        </a>
                    @else
                        <span class="badge bg-secondary" style="border-radius:999px;">
                            <i class="bi bi-hourglass-split"></i> File belum tersedia
                        </span>
                    @endif
                </div>

            </div>
        </div>

        {{-- CARD PARAMETER --}}
        <div class="card-soft" style="max-width:820px;margin:auto;">
            <h6 class="fw-bold mb-3 d-flex align-items-center gap-2">
                <i class="bi bi-list-check text-success"></i>
                Parameter Uji
            </h6>

            @if(!$hasil)
                <div class="alert alert-warning mb-0" style="border-radius:12px;">
                    Hasil uji belum diisi oleh admin.
                </div>
            @else
                <table class="param-table">
                    <thead>
                        <tr>
                            <th class="text-start">Parameter</th>
                            <th class="text-end">Hasil</th>
                            <th class="text-end">Satuan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($rows as [$label, $key, $defaultUnit])
                            @php
                                $value  = $hasil->$key ?? '-';
                                $unit   = $hasil->{$key.'_satuan'} ?? $defaultUnit;
                            @endphp
                            <tr>
                                <td class="param-name">{{ $label }}</td>
                                <td class="param-value">{{ $value }}</td>
                                <td class="param-unit">{{ $unit }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>

        <div class="mt-3" style="max-width:820px;margin:auto;">
            <a href="{{ route('uji.hasil.list') }}"
               class="btn btn-outline-secondary btn-sm"
               style="border-radius:10px;font-weight:800;">
                <i class="bi bi-arrow-left me-1"></i> Kembali ke List
            </a>
        </div>

    </div>
</div>
@endsection
