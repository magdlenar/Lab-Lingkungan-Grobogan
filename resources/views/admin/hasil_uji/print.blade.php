<!DOCTYPE html>
<html>
<head>
    <title>Print Hasil Uji</title>
    <link rel="icon" type="image/jpg" href="{{ asset('images/logo.jpg') }}">

    <style>
        @page {
            size: A4;
            margin: 12mm 10mm;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            color: #000;
            font-size: 11.5px;
        }

        /* ========== KOTAK KOP SURAT ========== */
        .kop-container {
            border: 1px solid #000;
            padding: 6px 6px 2px 6px;
            margin-bottom: 4px;
        }

        .kop-table {
            width: 100%;
            border-collapse: collapse;
        }

        .kop-table td {
            border: none;
        }

        .kop-logo img {
            width: 70px;
            height: 70px;
            object-fit: contain;
        }

        .kop-title {
            text-align: center;
            line-height: 1.25;
            text-transform: uppercase;
            font-weight: bold;
            font-size: 13px;
        }

        /* ========== KOTAK HEADER KODE DOKUMEN ========== */
        .doc-box {
            width: 100%;
            border-collapse: collapse;
            margin-top: 2px;
            font-size: 10.5px;
        }

        .doc-box td {
            border: 1px solid #000;
            padding: 4px 6px;
        }

        .doc-title {
            background: #e5edf7;
            font-weight: bold;
            text-align: center;
            text-transform: uppercase;
        }

        /* ========== INFO TABEL (tanpa garis) ========== */
        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 6px;
        }

        .info-table td {
            padding: 2px 2px;
            border: none;
        }

        .info-label {
            width: 170px;
        }

        /* ========== PARAMETER TABEL ========== */
        table.param {
            width: 100%;
            border-collapse: collapse;
            margin-top: 6px;
        }

        table.param th,
        table.param td {
            border: 1px solid #000;
            padding: 5px 6px;
            vertical-align: top;
        }

        table.param th {
            background: #e5edf7;
        }

        /* ========== TTD ========== */
        .ttd-table {
            width: 100%;
            margin-top: 18px;
            border-collapse: collapse;
        }

        .ttd-table td {
            border: none;
            padding: 2px;
        }
    </style>
</head>

<body onload="window.print()">

@php $r = $req->result; @endphp

{{-- ========== KOP SESUAI GAMBAR ========== --}}
<table style="width:100%; border-collapse:collapse; border:1px solid #000; font-size:11px;">

   <tr>
    {{-- KOLOM LOGO --}}
    <td style="width:110px; border:1px solid #000; text-align:center; padding:5px;">
        <img src="{{ asset('images/logo.png') }}" style="width:75px; height:75px; object-fit:contain;">
    </td>

    {{-- KOLOM JUDUL (MERGED, TANPA SEKAT APAPUN) --}}
    <td colspan="4"
        style="border:1px solid #000; text-align:center; padding:6px; font-weight:bold;">

        Laboratorium Lingkungan<br>
        Dinas Lingkungan Hidup<br>
        Kabupaten Grobogan
    </td>
</tr>
    {{-- BARIS 2: KODE DOKUMEN, REV, HAL --}}
    <tr>

        {{-- Kode Dokumen --}}
        <td style="border:1px solid #000; padding:3px 5px; width:110px;">
            Kode Dokumen :
        </td>

        <td style="border:1px solid #000; padding:3px 5px; width:120px;">
            FQP7.8.1
        </td>

        {{-- Rev/Tanggal --}}
        <td style="border:1px solid #000; padding:3px 5px; width:110px;">
            Rev/Tanggal :
        </td>

        <td style="border:1px solid #000; padding:3px 5px; width:120px;">
            {{ $r->rev_tanggal ?? '-/…' }}
        </td>

        {{-- Halaman --}}
        <td style="border:1px solid #000; padding:3px 5px; width:80px;">
            Hal.: {{ $r->hal ?? '1/1' }}
        </td>

    </tr>

    {{-- BARIS 3: JUDUL TENGAH --}}
    <tr>
        <td colspan="5"
            style="border:1px solid #000; font-weight:bold; text-align:center; padding:4px; text-transform:uppercase;">
            LEMBAR HASIL ANALISIS
        </td>
    </tr>

</table>

{{-- ========== DATA IDENTITAS ========== --}}
<table class="info-table">
    <tr>
        <td class="info-label">Nama Pelanggan</td>
        <td>: {{ $r->nama_pelanggan ?? ($req->user->instansi ?? $req->pic_name) }}</td>
    </tr>

    <tr>
        <td>Tanggal Pengambilan Contoh</td>
        <td>:
            @if($r->tanggal_pengambilan_contoh)
                {{ \Carbon\Carbon::parse($r->tanggal_pengambilan_contoh)->translatedFormat('l, d F Y') }}
            @else
                -
            @endif
        </td>
    </tr>

    <tr>
        <td>Jenis Kegiatan</td>
        <td>: {{ $r->jenis_kegiatan ?? '-' }}</td>
    </tr>

    <tr>
        <td>Lokasi Pengambilan Contoh</td>
        <td>: {{ $r->lokasi_pengambilan_contoh ?? '-' }}</td>
    </tr>

    <tr>
        <td>Waktu Pengambilan Contoh</td>
        <td>: {{ $r->waktu_pengambilan_contoh ?? '-' }}</td>
    </tr>

    <tr>
        <td>Kode Contoh</td>
        <td>: {{ $r->kode_contoh ?? '-' }}</td>
    </tr>

    <tr>
        <td>Acuan Baku Mutu</td>
        <td>: {!! nl2br(e($r->acuan_baku_mutu ?? '-')) !!}</td>
    </tr>
</table>

{{-- ========== PARAMETER ANALISIS ========== --}}
<table class="param">
    <thead>
        <tr>
            <th style="width:30px; text-align:center;">No</th>
            <th style="width:190px;">Parameter</th>
            <th style="width:90px; text-align:center;">Hasil Analisis</th>
            <th style="width:70px; text-align:center;">Satuan</th>
            <th style="width:70px; text-align:center;">Baku Mutu</th>
            <th>Keterangan</th>
        </tr>
    </thead>

    <tbody>

        {{-- baris diisi otomatis --}}
        @php
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

        @foreach($rows as $i => $row)
        @php
            $key = $row[1];
            $satuan = $r[$key.'_satuan'] ?? $row[2];
            $baku   = $r[$key.'_baku_mutu'] ?? '-';
            $ket    = $r[$key.'_keterangan'] ?? '';
        @endphp

        <tr>
            <td style="text-align:center;">{{ $i+1 }}</td>
            <td>{{ $row[0] }}</td>
            <td style="text-align:center;">{{ $r->$key ?? '-' }}</td>
            <td style="text-align:center;">{{ $satuan }}</td>
            <td style="text-align:center;">{{ $baku }}</td>
            <td>{{ $ket }}</td>
        </tr>
        @endforeach

    </tbody>
</table>

{{-- ========== TANDA TANGAN ========== --}}
<table class="ttd-table">
    <tr>
        <td style="width:55%;"></td>
        <td style="text-align:center;">
            Grobogan, {{ now()->translatedFormat('d F Y') }}<br>
            Penyelia<br><br><br><br>
            (M. Ajib Ubaidillah)
        </td>
    </tr>
</table>

</body>
</html>
