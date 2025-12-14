<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestResult extends Model
{
    protected $fillable = [
        'test_request_id',

        // HEADER DOKUMEN
        'kode_dokumen',
        'rev_tanggal',
        'hal',
        'nama_pelanggan',
        'tanggal_pengambilan_contoh',
        'jenis_kegiatan',
        'lokasi_pengambilan_contoh',
        'waktu_pengambilan_contoh',
        'kode_contoh',
        'acuan_baku_mutu',

        // SUHU
        'suhu',
        'suhu_satuan',
        'suhu_baku_mutu',
        'suhu_keterangan',

        // TDS
        'tds',
        'tds_satuan',
        'tds_baku_mutu',
        'tds_keterangan',

        // TSS
        'tss',
        'tss_satuan',
        'tss_baku_mutu',
        'tss_keterangan',

        // pH
        'ph',
        'ph_satuan',
        'ph_baku_mutu',
        'ph_keterangan',

        // BOD
        'bod',
        'bod_satuan',
        'bod_baku_mutu',
        'bod_keterangan',

        // COD
        'cod',
        'cod_satuan',
        'cod_baku_mutu',
        'cod_keterangan',

        // DO
        'do',
        'do_satuan',
        'do_baku_mutu',
        'do_keterangan',

        // NITRAT
        'nitrat',
        'nitrat_satuan',
        'nitrat_baku_mutu',
        'nitrat_keterangan',

        // TOTAL FOSFAT
        'total_fosfat',
        'total_fosfat_satuan',
        'total_fosfat_baku_mutu',
        'total_fosfat_keterangan',

        // AMONIA
        'amonia',
        'amonia_satuan',
        'amonia_baku_mutu',
        'amonia_keterangan',

        // FECAL COLIFORM
        'fecal_coliform',
        'fecal_coliform_satuan',
        'fecal_coliform_baku_mutu',
        'fecal_coliform_keterangan',

        // DAYA HANTAR LISTRIK
        'daya_hantar_listrik',
        'daya_hantar_listrik_satuan',
        'daya_hantar_listrik_baku_mutu',
        'daya_hantar_listrik_keterangan',

        // KEKERUHAN
        'kekeruhan',
        'kekeruhan_satuan',
        'kekeruhan_baku_mutu',
        'kekeruhan_keterangan',

        // FILE DOKUMEN
        'result_file',
    ];

    public function request()
    {
        return $this->belongsTo(TestRequest::class, 'test_request_id');
    }
}
