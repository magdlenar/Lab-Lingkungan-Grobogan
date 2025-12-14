@extends('layouts.admin')
@section('title','Form Hasil Uji')

@section('content')

<style>
.card-wrap{
    background:#fff; border-radius:18px; padding:18px;
    box-shadow:0 6px 18px rgba(0,0,0,.06);
    max-width:1100px; margin:auto;
}
.head{
    display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:8px;
    margin-bottom:10px;
}
.head h5{ font-weight:700; margin:0; }
.grid-2{
    display:grid; grid-template-columns:1fr 1fr; gap:12px 14px;
}
.grid-3{
    display:grid; grid-template-columns:1.2fr .7fr .7fr; gap:8px;
}
.grid-4{
    display:grid; grid-template-columns:1.2fr .6fr .6fr 1.1fr; gap:8px;
}
.group{ display:flex; flex-direction:column; gap:6px; }
.group label{ font-weight:600; font-size:13.5px; color:#334155; }
.group input, .group textarea, .group select{
    border-radius:12px; border:1px solid #e6edf5; padding:8px 10px; font-size:14px;
}
.group textarea{ min-height:68px; resize:vertical; }
.readonly{
    background:#f9fbfd; color:#475569;
}
.footer{
    margin-top:14px; display:flex; gap:10px; justify-content:flex-end; flex-wrap:wrap;
}
.section-title{
    font-weight:700; font-size:14px; margin-bottom:6px; color:#111827;
}
.param-card{
    margin-top:6px;
    border-radius:14px;
    border:1px solid #e5e7eb;
    padding:10px 12px;
    background:#f9fafb;
}
.param-card + .param-card{ margin-top:8px; }
.param-name{
    font-weight:700; font-size:13.5px; color:#111827; margin-bottom:6px;
}
.param-note{
    font-size:12px; color:#94a3b8;
}
@media(max-width:768px){
    .grid-2{ grid-template-columns:1fr; }
    .grid-3{ grid-template-columns:1fr 1fr; }
    .grid-4{ grid-template-columns:1fr 1fr; }
    .footer button, .footer a{ width:100%; }
}
</style>

<div class="card-wrap">

    <div class="head">
        <h5>Hasil Uji - {{ strtoupper($req->service_type) }}</h5>
        <a href="{{ route('admin.hasiluji.index') }}" class="btn btn-sm btn-secondary">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>

    <form method="POST" action="{{ route('admin.hasiluji.store',$req->id) }}">
        @csrf
        @php $r = $req->result; @endphp

        {{-- DATA PERMINTAAN (Readonly, tidak disimpan ulang) --}}
        <div class="section-title">Data Permintaan</div>
        <div class="grid-2">
            <div class="group">
                <label>Nama PIC</label>
                <input class="readonly" readonly value="{{ $req->pic_name }}">
            </div>
            <div class="group">
                <label>Nomor HP</label>
                <input class="readonly" readonly value="{{ $req->pic_phone }}">
            </div>
            <div class="group">
                <label>Email</label>
                <input class="readonly" readonly value="{{ $req->pic_email }}">
            </div>
            <div class="group">
                <label>Instansi</label>
                <input class="readonly" readonly value="{{ $req->user->instansi ?? '-' }}">
            </div>
            <div class="group">
                <label>Jenis Layanan</label>
                <input class="readonly" readonly value="{{ $req->service_type }}">
            </div>
            <div class="group">
                <label>Tanggal Permintaan</label>
                <input class="readonly" readonly value="{{ $req->created_at->format('d-m-Y') }}">
            </div>
            <div class="group">
                <label>Tanggal Pengambilan Sampel (permintaan)</label>
                <input class="readonly" readonly value="{{ $req->sample_pickup_date ?? '-' }}">
            </div>
        </div>

        <hr class="my-3">

        {{-- INFO DOKUMEN & SAMPEL (disimpan di test_results) --}}
        <div class="section-title">Info Dokumen & Sampel (Lembar Hasil Analisis)</div>
        <div class="grid-2">
            <div class="group">
                <label>Kode Dokumen</label>
                <input name="kode_dokumen" value="{{ old('kode_dokumen', $r->kode_dokumen ?? '') }}">
            </div>
            <div class="group">
                <label>Rev / Tanggal</label>
                <input name="rev_tanggal" value="{{ old('rev_tanggal', $r->rev_tanggal ?? '') }}">
            </div>
            <div class="group">
                <label>Hal</label>
                <input name="hal" value="{{ old('hal', $r->hal ?? '1/1') }}">
            </div>
            <div class="group">
                <label>Nama Pelanggan</label>
                <input name="nama_pelanggan" value="{{ old('nama_pelanggan', $r->nama_pelanggan ?? ($req->user->instansi ?? $req->pic_name)) }}">
            </div>
            <div class="group">
                <label>Tanggal Pengambilan Contoh</label>
                <input type="date" name="tanggal_pengambilan_contoh"
                       value="{{ old('tanggal_pengambilan_contoh',
                            ($r && $r->tanggal_pengambilan_contoh)
                                ? \Carbon\Carbon::parse($r->tanggal_pengambilan_contoh)->format('Y-m-d')
                                : '') }}">
            </div>
            <div class="group">
                <label>Jenis Kegiatan</label>
                <input name="jenis_kegiatan" value="{{ old('jenis_kegiatan', $r->jenis_kegiatan ?? '') }}">
            </div>
            <div class="group">
                <label>Lokasi Pengambilan Contoh</label>
                <textarea name="lokasi_pengambilan_contoh">{{ old('lokasi_pengambilan_contoh', $r->lokasi_pengambilan_contoh ?? ($req->sample_address ?? '')) }}</textarea>
            </div>
            <div class="group">
                <label>Waktu Pengambilan Contoh</label>
                <input name="waktu_pengambilan_contoh" placeholder="contoh: 13.30 WIB"
                       value="{{ old('waktu_pengambilan_contoh', $r->waktu_pengambilan_contoh ?? '') }}">
            </div>
            <div class="group">
                <label>Kode Contoh</label>
                <input name="kode_contoh" value="{{ old('kode_contoh', $r->kode_contoh ?? '') }}">
            </div>
            <div class="group" style="grid-column:1 / -1;">
                <label>Acuan Baku Mutu</label>
                <textarea name="acuan_baku_mutu">{{ old('acuan_baku_mutu', $r->acuan_baku_mutu ?? '') }}</textarea>
            </div>
        </div>

        <hr class="my-3">

        {{-- PARAMETER HASIL UJI --}}
        <div class="section-title">Parameter Hasil Uji</div>

        {{-- Temperatur / Suhu --}}
        <div class="param-card">
            <div class="param-name">1. Temperatur (Suhu)</div>
            <div class="grid-4">
                <div class="group">
                    <label>Hasil Analisis</label>
                    <input name="suhu" value="{{ old('suhu',$r->suhu ?? '') }}">
                </div>
                <div class="group">
                    <label>Satuan</label>
                    <input name="suhu_satuan" value="{{ old('suhu_satuan',$r->suhu_satuan ?? '°C') }}">
                </div>
                <div class="group">
                    <label>Baku Mutu</label>
                    <input name="suhu_baku_mutu" value="{{ old('suhu_baku_mutu',$r->suhu_baku_mutu ?? '-') }}">
                </div>
                <div class="group">
                    <label>Keterangan</label>
                    <input name="suhu_keterangan" value="{{ old('suhu_keterangan',$r->suhu_keterangan ?? '') }}">
                </div>
            </div>
        </div>

        {{-- TDS --}}
        <div class="param-card">
            <div class="param-name">2. Padatan Terlarut Total (TDS)</div>
            <div class="grid-4">
                <div class="group">
                    <label>Hasil Analisis</label>
                    <input name="tds" value="{{ old('tds',$r->tds ?? '') }}">
                </div>
                <div class="group">
                    <label>Satuan</label>
                    <input name="tds_satuan" value="{{ old('tds_satuan',$r->tds_satuan ?? 'mg/l') }}">
                </div>
                <div class="group">
                    <label>Baku Mutu</label>
                    <input name="tds_baku_mutu" value="{{ old('tds_baku_mutu',$r->tds_baku_mutu ?? '-') }}">
                </div>
                <div class="group">
                    <label>Keterangan</label>
                    <input name="tds_keterangan" value="{{ old('tds_keterangan',$r->tds_keterangan ?? '') }}">
                </div>
            </div>
        </div>

        {{-- TSS --}}
        <div class="param-card">
            <div class="param-name">3. Padatan Tersuspensi Total (TSS)</div>
            <div class="grid-4">
                <div class="group">
                    <label>Hasil Analisis</label>
                    <input name="tss" value="{{ old('tss',$r->tss ?? '') }}">
                </div>
                <div class="group">
                    <label>Satuan</label>
                    <input name="tss_satuan" value="{{ old('tss_satuan',$r->tss_satuan ?? 'mg/l') }}">
                </div>
                <div class="group">
                    <label>Baku Mutu</label>
                    <input name="tss_baku_mutu" value="{{ old('tss_baku_mutu',$r->tss_baku_mutu ?? '30') }}">
                </div>
                <div class="group">
                    <label>Keterangan</label>
                    <input name="tss_keterangan" value="{{ old('tss_keterangan',$r->tss_keterangan ?? '') }}">
                </div>
            </div>
        </div>

        {{-- pH --}}
        <div class="param-card">
            <div class="param-name">4. Tingkat Keasaman (pH)</div>
            <div class="grid-4">
                <div class="group">
                    <label>Hasil Analisis</label>
                    <input name="ph" value="{{ old('ph',$r->ph ?? '') }}">
                </div>
                <div class="group">
                    <label>Satuan</label>
                    <input name="ph_satuan" value="{{ old('ph_satuan',$r->ph_satuan ?? '-') }}">
                </div>
                <div class="group">
                    <label>Baku Mutu</label>
                    <input name="ph_baku_mutu" value="{{ old('ph_baku_mutu',$r->ph_baku_mutu ?? '6 - 9') }}">
                </div>
                <div class="group">
                    <label>Keterangan</label>
                    <input name="ph_keterangan" value="{{ old('ph_keterangan',$r->ph_keterangan ?? '') }}">
                </div>
            </div>
        </div>

        {{-- BOD --}}
        <div class="param-card">
            <div class="param-name">5. Kebutuhan Oksigen Biokimiawi (BOD)</div>
            <div class="grid-4">
                <div class="group">
                    <label>Hasil Analisis</label>
                    <input name="bod" value="{{ old('bod',$r->bod ?? '') }}">
                </div>
                <div class="group">
                    <label>Satuan</label>
                    <input name="bod_satuan" value="{{ old('bod_satuan',$r->bod_satuan ?? 'mg/l') }}">
                </div>
                <div class="group">
                    <label>Baku Mutu</label>
                    <input name="bod_baku_mutu" value="{{ old('bod_baku_mutu',$r->bod_baku_mutu ?? '12') }}">
                </div>
                <div class="group">
                    <label>Keterangan</label>
                    <input name="bod_keterangan" value="{{ old('bod_keterangan',$r->bod_keterangan ?? '') }}">
                </div>
            </div>
        </div>

        {{-- COD --}}
        <div class="param-card">
            <div class="param-name">6. Kebutuhan Oksigen Kimiawi (COD)</div>
            <div class="grid-4">
                <div class="group">
                    <label>Hasil Analisis</label>
                    <input name="cod" value="{{ old('cod',$r->cod ?? '') }}">
                </div>
                <div class="group">
                    <label>Satuan</label>
                    <input name="cod_satuan" value="{{ old('cod_satuan',$r->cod_satuan ?? 'mg/l') }}">
                </div>
                <div class="group">
                    <label>Baku Mutu</label>
                    <input name="cod_baku_mutu" value="{{ old('cod_baku_mutu',$r->cod_baku_mutu ?? '80') }}">
                </div>
                <div class="group">
                    <label>Keterangan</label>
                    <input name="cod_keterangan" value="{{ old('cod_keterangan',$r->cod_keterangan ?? '') }}">
                </div>
            </div>
        </div>

        {{-- DO --}}
        <div class="param-card">
            <div class="param-name">7. Oksigen Terlarut (DO)</div>
            <div class="grid-4">
                <div class="group">
                    <label>Hasil Analisis</label>
                    <input name="do" value="{{ old('do',$r->do ?? '') }}">
                </div>
                <div class="group">
                    <label>Satuan</label>
                    <input name="do_satuan" value="{{ old('do_satuan',$r->do_satuan ?? 'mg/l') }}">
                </div>
                <div class="group">
                    <label>Baku Mutu</label>
                    <input name="do_baku_mutu" value="{{ old('do_baku_mutu',$r->do_baku_mutu ?? '-') }}">
                </div>
                <div class="group">
                    <label>Keterangan</label>
                    <input name="do_keterangan" value="{{ old('do_keterangan',$r->do_keterangan ?? '') }}">
                </div>
            </div>
        </div>

        {{-- Nitrat (sebagai N) --}}
        <div class="param-card">
            <div class="param-name">8. Nitrat (sebagai N)</div>
            <div class="grid-4">
                <div class="group">
                    <label>Hasil Analisis</label>
                    <input name="nitrat" value="{{ old('nitrat',$r->nitrat ?? '') }}">
                </div>
                <div class="group">
                    <label>Satuan</label>
                    <input name="nitrat_satuan" value="{{ old('nitrat_satuan',$r->nitrat_satuan ?? 'mg/l') }}">
                </div>
                <div class="group">
                    <label>Baku Mutu</label>
                    <input name="nitrat_baku_mutu" value="{{ old('nitrat_baku_mutu',$r->nitrat_baku_mutu ?? '-') }}">
                </div>
                <div class="group">
                    <label>Keterangan</label>
                    <input name="nitrat_keterangan" value="{{ old('nitrat_keterangan',$r->nitrat_keterangan ?? '') }}">
                </div>
            </div>
        </div>

        {{-- Amonia (sebagai N) --}}
        <div class="param-card">
            <div class="param-name">9. Amonia (sebagai N)</div>
            <div class="grid-4">
                <div class="group">
                    <label>Hasil Analisis</label>
                    <input name="amonia" value="{{ old('amonia',$r->amonia ?? '') }}">
                </div>
                <div class="group">
                    <label>Satuan</label>
                    <input name="amonia_satuan" value="{{ old('amonia_satuan',$r->amonia_satuan ?? 'mg/l') }}">
                </div>
                <div class="group">
                    <label>Baku Mutu</label>
                    <input name="amonia_baku_mutu" value="{{ old('amonia_baku_mutu',$r->amonia_baku_mutu ?? '-') }}">
                </div>
                <div class="group">
                    <label>Keterangan</label>
                    <input name="amonia_keterangan" value="{{ old('amonia_keterangan',$r->amonia_keterangan ?? '') }}">
                </div>
            </div>
        </div>

        {{-- Total Fosfat (sebagai P) --}}
        <div class="param-card">
            <div class="param-name">10. Total Fosfat (sebagai P)</div>
            <div class="grid-4">
                <div class="group">
                    <label>Hasil Analisis</label>
                    <input name="total_fosfat" value="{{ old('total_fosfat',$r->total_fosfat ?? '') }}">
                </div>
                <div class="group">
                    <label>Satuan</label>
                    <input name="total_fosfat_satuan" value="{{ old('total_fosfat_satuan',$r->total_fosfat_satuan ?? 'mg/l') }}">
                </div>
                <div class="group">
                    <label>Baku Mutu</label>
                    <input name="total_fosfat_baku_mutu" value="{{ old('total_fosfat_baku_mutu',$r->total_fosfat_baku_mutu ?? '-') }}">
                </div>
                <div class="group">
                    <label>Keterangan</label>
                    <input name="total_fosfat_keterangan" value="{{ old('total_fosfat_keterangan',$r->total_fosfat_keterangan ?? '') }}">
                </div>
            </div>
        </div>

        {{-- Fecal Coliform --}}
        <div class="param-card">
            <div class="param-name">11. Fecal Coliform</div>
            <div class="grid-4">
                <div class="group">
                    <label>Hasil Analisis</label>
                    <input name="fecal_coliform" value="{{ old('fecal_coliform',$r->fecal_coliform ?? '') }}">
                </div>
                <div class="group">
                    <label>Satuan</label>
                    <input name="fecal_coliform_satuan" value="{{ old('fecal_coliform_satuan',$r->fecal_coliform_satuan ?? 'MPN/100ml') }}">
                </div>
                <div class="group">
                    <label>Baku Mutu</label>
                    <input name="fecal_coliform_baku_mutu" value="{{ old('fecal_coliform_baku_mutu',$r->fecal_coliform_baku_mutu ?? '200') }}">
                </div>
                <div class="group">
                    <label>Keterangan</label>
                    <input name="fecal_coliform_keterangan" value="{{ old('fecal_coliform_keterangan',$r->fecal_coliform_keterangan ?? '') }}">
                </div>
            </div>
        </div>

        {{-- Daya Hantar Listrik (DHL) --}}
        <div class="param-card">
            <div class="param-name">12. Daya Hantar Listrik (DHL)</div>
            <div class="grid-4">
                <div class="group">
                    <label>Hasil Analisis</label>
                    <input name="daya_hantar_listrik" value="{{ old('daya_hantar_listrik',$r->daya_hantar_listrik ?? '') }}">
                </div>
                <div class="group">
                    <label>Satuan</label>
                    <input name="daya_hantar_listrik_satuan" value="{{ old('daya_hantar_listrik_satuan',$r->daya_hantar_listrik_satuan ?? 'µS/cm') }}">
                </div>
                <div class="group">
                    <label>Baku Mutu</label>
                    <input name="daya_hantar_listrik_baku_mutu" value="{{ old('daya_hantar_listrik_baku_mutu',$r->daya_hantar_listrik_baku_mutu ?? '-') }}">
                </div>
                <div class="group">
                    <label>Keterangan</label>
                    <input name="daya_hantar_listrik_keterangan" value="{{ old('daya_hantar_listrik_keterangan',$r->daya_hantar_listrik_keterangan ?? '') }}">
                </div>
            </div>
        </div>

        {{-- Kekeruhan --}}
        <div class="param-card">
            <div class="param-name">13. Kekeruhan</div>
            <div class="grid-4">
                <div class="group">
                    <label>Hasil Analisis</label>
                    <input name="kekeruhan" value="{{ old('kekeruhan',$r->kekeruhan ?? '') }}">
                </div>
                <div class="group">
                    <label>Satuan</label>
                    <input name="kekeruhan_satuan" value="{{ old('kekeruhan_satuan',$r->kekeruhan_satuan ?? 'NTU') }}">
                </div>
                <div class="group">
                    <label>Baku Mutu</label>
                    <input name="kekeruhan_baku_mutu" value="{{ old('kekeruhan_baku_mutu',$r->kekeruhan_baku_mutu ?? '-') }}">
                </div>
                <div class="group">
                    <label>Keterangan</label>
                    <input name="kekeruhan_keterangan" value="{{ old('kekeruhan_keterangan',$r->kekeruhan_keterangan ?? '') }}">
                </div>
            </div>
        </div>

        <div class="footer">
            <a href="{{ route('admin.hasiluji.index') }}" class="btn btn-outline-secondary">
                Batal
            </a>
            <button class="btn btn-success">
                <i class="bi bi-save2 me-1"></i> Simpan Hasil Uji
            </button>
        </div>
    </form>
</div>
@endsection
