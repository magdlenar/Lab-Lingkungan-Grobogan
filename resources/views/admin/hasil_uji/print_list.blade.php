<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print List Hasil Uji</title>
    <link rel="icon" type="image/jpg" href="{{ asset('images/logo.jpg') }}">

    <style>
        @page {
            size: A4;
            margin: 14mm 12mm;
        }

        body {
            font-family: Arial, sans-serif;
            color: #111;
            font-size: 11.5px;
        }

        /* ===== HEADER DINAS KECIL (senada permintaan uji) ===== */
        .header {
            display: flex;
            align-items: center;
            gap: 10px;
            padding-bottom: 8px;
            border-bottom: 1px solid #ccc;
            margin-bottom: 10px;
        }
        .logo-wrap {
            width: 46px;
            height: 46px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .logo-wrap img {
            width: 46px;
            height: 46px;
            object-fit: contain;
        }

        .header-text { line-height: 1.25; }
        .header-text .dinas {
            font-weight: 700;
            font-size: 12.5px;
            text-transform: uppercase;
        }
        .header-text .meta {
            font-size: 10.5px;
            color: #555;
        }

        .title {
            font-size: 14px;
            font-weight: 700;
            margin: 6px 0 6px;
            text-align: center;
        }

        /* ===== META INFO ===== */
        .meta-info{
            font-size: 11px;
            margin: 2px 0 8px;
            line-height: 1.5;
        }
        .meta-info b{ font-weight:700; }

        /* ===== TABLE COMPACT (senada permintaan uji) ===== */
        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        th, td {
            border: 1px solid #444;
            padding: 6px 7px;
            vertical-align: top;
            word-wrap: break-word;
            white-space: normal;
        }

        thead th {
            background: #f3f8ff;
            font-weight: 700;
            font-size: 11.5px;
            text-align: left;
        }

        tbody tr:nth-child(even) {
            background: #fafafa;
        }

        .nowrap { white-space: nowrap; }

        .badge {
            display: inline-block;
            padding: 2px 8px;
            border-radius: 999px;
            font-size: 10.5px;
            font-weight: 700;
            border: 1px solid #ddd;
        }
        .badge-no {
            background: #f3f4f6;
            color: #6b7280;
        }

        /* ===== CHECKLIST (samakan dengan permintaan uji) ===== */
        .check {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-weight: 700;
        }
        .box {
            width: 12px;
            height: 12px;
            border: 1px solid #111;
            display: inline-block;
            position: relative;
        }
        .box.checked::after {
            content: "✓";
            position: absolute;
            left: 1.5px;
            top: -2px;
            font-size: 14px;
            font-weight: 700;
        }

        .footer {
            margin-top: 12px;
            display: flex;
            justify-content: space-between;
            font-size: 10.5px;
            color: #6b7280;
        }

        @media print {
            body { font-size: 11px; }
            th, td { padding: 5px 6px; }
        }
    </style>
</head>

<body onload="window.print()">

@php
    $dateType = request('date_type');
    $reqDate  = request('date');
    $reqMonth = request('month');
    $reqYear  = request('year');

    $m = $reqMonth ? (int) $reqMonth : null;
    $y = $reqYear ? (int) $reqYear : now()->year;
@endphp

    {{-- ===== IDENTITAS DINAS (KECIL) ===== --}}
    <div class="header">
        <div class="logo-wrap">
            <img src="{{ asset('images/logo.jpg') }}" alt="Logo Dinas">
        </div>
        <div class="header-text">
            <div class="dinas">Dinas Lingkungan Hidup Kabupaten Grobogan</div>
            <div class="meta">
                Simpang Utara, Kec. Purwodadi, Kabupaten Grobogan, Jawa Tengah 58111, Kota •
                Telp: 0813 9339 5905 • Email: laboratoriumdlh@gmail.com
            </div>
        </div>
    </div>

    <div class="title">Daftar Hasil Uji (List)</div>

    <div class="meta-info">
        <div><b>Dicetak:</b> {{ now()->translatedFormat('d F Y, H:i') }}</div>

        @if(request('search'))
            <div><b>Pencarian:</b> "{{ request('search') }}"</div>
        @endif

        @if($dateType === 'date' && $reqDate)
            <div>
                <b>Filter Tanggal:</b>
                {{ \Carbon\Carbon::parse($reqDate)->translatedFormat('d F Y') }}
            </div>
        @elseif($dateType === 'month' && $m)
            <div>
                <b>Filter Bulan:</b>
                {{ \Carbon\Carbon::createFromDate($y, $m, 1)->translatedFormat('F Y') }}
            </div>
        @elseif($dateType === 'year' && $reqYear)
            <div><b>Filter Tahun:</b> {{ $y }}</div>
        @endif

        <div><b>Total Data:</b> {{ $data->count() }}</div>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width:5%;">No</th>
                <th style="width:16%;">Nama PIC</th>
                <th style="width:12%;">No. HP</th>
                <th style="width:20%;">Instansi</th>
                <th style="width:12%;">Tgl Permintaan</th>
                <th style="width:15%;">Tgl Hasil Diisi</th>
                <th style="width:10%; text-align:center;">Upload File</th>
            </tr>
        </thead>

        <tbody>
        @forelse($data as $i => $item)
            @php
                $hasil = $item->result;
                $tglHasil = $hasil?->updated_at ?? $hasil?->created_at;
                $uploaded = $hasil && $hasil->result_file;
            @endphp
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $item->pic_name }}</td>
                <td class="nowrap">{{ $item->pic_phone }}</td>
                <td>{{ $item->user->instansi ?? '-' }}</td>
                <td class="nowrap">{{ $item->created_at->format('d-m-Y') }}</td>

                <td class="nowrap">
                    @if($tglHasil)
                        {{ \Carbon\Carbon::parse($tglHasil)->format('d-m-Y') }}
                    @else
                        <span class="badge badge-no">Belum diisi</span>
                    @endif
                </td>

                <td style="text-align:center;">
                    <span class="check">
                        <span class="box {{ $uploaded ? 'checked' : '' }}"></span>
                    </span>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7" style="text-align:center; padding:14px; color:#6b7280;">
                    Tidak ada data untuk dicetak.
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>

    <div class="footer">
        <div>Admin Laboratorium Lingkungan</div>
        <div>Halaman print list hasil uji</div>
    </div>

</body>
</html>
