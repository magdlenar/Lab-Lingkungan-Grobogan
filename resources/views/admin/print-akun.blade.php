<!DOCTYPE html>
<html>
<head>
    <title>Print Akun Customer</title>
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

        /* ===== FILTER INFO ===== */
        .filter-info{
            font-size: 11px;
            margin: 2px 0 8px;
        }
        .filter-info strong{ font-weight:700; }

        /* ===== TABLE STYLE COMPACT (senada permintaan uji) ===== */
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
                Simpang Utara, Kec. Purwodadi, Kabupaten Grobogan, Jawa Tengah 58111, Kota •
                Telp: 0813 9339 5905 • Email: laboratoriumdlh@gmail.com
            </div>
        </div>
    </div>

    <div class="title">Daftar Akun Customer</div>

    {{-- info filter (kalau ada) --}}
    <div class="filter-info">
        @if($bulan) Bulan: <strong>{{ $bulan }}</strong> @endif
        @if($tahun) Tahun: <strong>{{ $tahun }}</strong> @endif
    </div>

    <table>
        <thead>
            <tr>
                <th style="width:4%;">No</th>
                <th style="width:18%;">Nama</th>
                <th style="width:22%;">Email</th>
                <th style="width:12%;">No HP</th>
                <th style="width:26%;">Instansi</th>
                <th style="width:18%;">Tanggal Daftar</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($users as $u)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $u->nama }}</td>
                <td>{{ $u->email }}</td>
                <td>{{ $u->nomor_hp ?? '-' }}</td>
                <td>{{ $u->instansi ?? '-' }}</td>
                <td>{{ $u->created_at->format('d M Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
