<!DOCTYPE html>
<html>
<head>
    <title>Laporan Permintaan Uji</title>
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
          /* ===== HEADER DINAS KECIL ===== */
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
            object-fit: contain; /* biar gak gepeng */
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
            margin: 6px 0 10px;
            text-align: center;
        }

        /* ===== TABLE STYLE COMPACT ===== */
        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed; /* biar stabil & ga melebar */
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

        .small { font-size: 10px; color: #555; }
        .status {
            font-weight: 700;
            font-size: 11px;
        }

        /* checklist surat */
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

        @media print {
            body { font-size: 11px; }
            th, td { padding: 5px 6px; }
        }
    </style>
</head>
<body onload="window.print()">

    {{-- ===== IDENTITAS DINAS (KECIL) ===== --}}
    <div class="header">
        <div class="logo-wrap">
            <img src="{{ asset('images/logo.jpg') }}" alt="Logo Dinas">
        </div>
        <div class="header-text">
            <div class="dinas">Dinas Lingkungan Hidup Kabupaten Grobogan</div>
            <div class="meta">
                Simpang Utara, Kec. Purwodadi, Kabupaten Grobogan, Jawa Tengah 58111, Kota • Telp: 0813 9339 5905 • Email: laboratoriumdlh@gmail.com
            </div>
        </div>
    </div>

    <div class="title">Laporan Permintaan Uji</div>

    <table>
        <thead>
            <tr>
                <th style="width:4%;">No</th>
                <th style="width:13%;">Instansi</th>
                <th style="width:10%;">Nama PIC</th>
                <th style="width:14%;">Kontak PIC</th>
                <th style="width:12%;">Layanan</th>
                <th style="width:16%;">Alamat Pengambilan Sampel</th>
                <th style="width:11%;">Catatan Pemohon</th>
                <th style="width:8%;">Tgl Permintaan</th>
                <th style="width:8%;">Tgl Pengambilan</th>
                <th style="width:4%;">Surat</th>
            </tr>
        </thead>

        <tbody>
            @foreach($data as $item)
                @php
                    $pickup = $item->sample_pickup_date
                                ? \Carbon\Carbon::parse($item->sample_pickup_date)->format('d-m-Y')
                                : '-';
                @endphp
                <tr>
                    <td>{{ $loop->iteration }}</td>

                    <td>
                        {{ $item->user->instansi ?? '-' }}
                        <div class="small status">
                            {{ ucwords($item->status ?? '-') }}
                        </div>
                    </td>

                    <td>{{ $item->pic_name ?? '-' }}</td>

                    <td>
                        {{ $item->pic_phone ?? '-' }} <br>
                        <span class="small">{{ $item->pic_email ?? '-' }}</span>
                    </td>

                    <td class="text-capitalize">
                        {{ $item->service_type ?? '-' }}
                    </td>

                    <td>{{ $item->sample_address ?? '-' }}</td>

                    <td>{{ $item->notes ?? '-' }}</td>

                    <td>
                        {{ $item->created_at ? $item->created_at->format('d-m-Y') : '-' }}
                    </td>

                    <td>{{ $pickup }}</td>

                    <td style="text-align:center;">
                        <span class="check">
                            <span class="box {{ $item->letter_file ? 'checked' : '' }}"></span>
                        </span>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
