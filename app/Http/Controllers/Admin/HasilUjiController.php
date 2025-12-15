<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TestRequest;
use App\Models\TestResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HasilUjiController extends Controller
{
    // ===== LIST HALAMAN HASIL UJI =====
    public function index(Request $request)
{
    $search      = $request->search;
    $dateType    = $request->date_type;
    $date        = $request->date;
    $month       = $request->month;
    $year        = $request->year;
    $serviceType = $request->service_type; // <= TAMBAHAN

    $requests = TestRequest::with(['user','result'])
        ->when($search, function($q) use ($search){
            $q->whereHas('user', function($u) use ($search){
                $u->where('nama','like',"%$search%")
                  ->orWhere('instansi','like',"%$search%");
            })
            ->orWhere('pic_name','like',"%$search%")
            ->orWhere('service_type','like',"%$search%");
        })
        // <= FILTER LAYANAN (PERSIS permintaan.blade.php)
        ->when($serviceType, function($q) use ($serviceType){
            $q->where('service_type', $serviceType);
        })
        ->when($dateType === 'date' && $date, fn($q)=>$q->whereDate('created_at',$date))
        ->when($dateType === 'month' && $month, function($q) use ($month,$year){
            $q->whereMonth('created_at',$month);
            if($year) $q->whereYear('created_at',$year);
        })
        ->when($dateType === 'year' && $year, fn($q)=>$q->whereYear('created_at',$year))
        ->latest()
        ->paginate(10)
        ->appends($request->query()); // biar pagination bawa filter

    // list tahun untuk dropdown
    $tahunList = TestRequest::selectRaw('YEAR(created_at) as y')
        ->groupBy('y')->orderBy('y','desc')->pluck('y');

    return view('admin.hasil_uji.index', compact('requests','search','tahunList'));
}

public function printList(Request $request)
{
    $search      = $request->search;
    $dateType    = $request->date_type;
    $date        = $request->date;
    $month       = $request->month;
    $year        = $request->year;
    $serviceType = $request->service_type; // <= TAMBAHAN

    $data = TestRequest::with(['user','result'])
        ->when($search, function($q) use ($search){
            $q->whereHas('user', function($u) use ($search){
                $u->where('nama','like',"%$search%")
                  ->orWhere('instansi','like',"%$search%");
            })
            ->orWhere('pic_name','like',"%$search%")
            ->orWhere('service_type','like',"%$search%");
        })
        // <= FILTER LAYANAN
        ->when($serviceType, function($q) use ($serviceType){
            $q->where('service_type', $serviceType);
        })
        ->when($dateType === 'date' && $date, fn($q)=>$q->whereDate('created_at',$date))
        ->when($dateType === 'month' && $month, function($q) use ($month,$year){
            $q->whereMonth('created_at',$month);
            if($year) $q->whereYear('created_at',$year);
        })
        ->when($dateType === 'year' && $year, fn($q)=>$q->whereYear('created_at',$year))
        ->latest()
        ->get();

    return view('admin.hasil_uji.print_list', compact('data'));
}


    // ===== FORM CREATE / EDIT =====
    public function form($test_request_id)
    {
        $req = TestRequest::with('user','result')->findOrFail($test_request_id);

        return view('admin.hasil_uji.form', compact('req'));
    }

    // ===== SIMPAN / UPDATE =====
    public function store(Request $request, $test_request_id)
{
    $req = TestRequest::findOrFail($test_request_id);

    $data = $request->validate([
        // HEADER DOKUMEN
        'kode_dokumen'               => 'nullable|string|max:50',
        'rev_tanggal'                => 'nullable|string|max:50',
        'hal'                        => 'nullable|string|max:20',
        'nama_pelanggan'             => 'nullable|string|max:255',
        'tanggal_pengambilan_contoh' => 'nullable|date',
        'jenis_kegiatan'             => 'nullable|string|max:255',
        'lokasi_pengambilan_contoh'  => 'nullable|string',
        'waktu_pengambilan_contoh'   => 'nullable|string|max:50',
        'kode_contoh'                => 'nullable|string|max:100',
        'acuan_baku_mutu'            => 'nullable|string',

        // SUHU
        'suhu'             => 'nullable|string|max:50',
        'suhu_satuan'      => 'nullable|string|max:50',
        'suhu_baku_mutu'   => 'nullable|string|max:50',
        'suhu_keterangan'  => 'nullable|string|max:255',

        // TDS
        'tds'              => 'nullable|string|max:50',
        'tds_satuan'       => 'nullable|string|max:50',
        'tds_baku_mutu'    => 'nullable|string|max:50',
        'tds_keterangan'   => 'nullable|string|max:255',

        // TSS
        'tss'              => 'nullable|string|max:50',
        'tss_satuan'       => 'nullable|string|max:50',
        'tss_baku_mutu'    => 'nullable|string|max:50',
        'tss_keterangan'   => 'nullable|string|max:255',

        // pH
        'ph'               => 'nullable|string|max:50',
        'ph_satuan'        => 'nullable|string|max:50',
        'ph_baku_mutu'     => 'nullable|string|max:50',
        'ph_keterangan'    => 'nullable|string|max:255',

        // BOD
        'bod'              => 'nullable|string|max:50',
        'bod_satuan'       => 'nullable|string|max:50',
        'bod_baku_mutu'    => 'nullable|string|max:50',
        'bod_keterangan'   => 'nullable|string|max:255',

        // COD
        'cod'              => 'nullable|string|max:50',
        'cod_satuan'       => 'nullable|string|max:50',
        'cod_baku_mutu'    => 'nullable|string|max:50',
        'cod_keterangan'   => 'nullable|string|max:255',

        // DO
        'do'               => 'nullable|string|max:50',
        'do_satuan'        => 'nullable|string|max:50',
        'do_baku_mutu'     => 'nullable|string|max:50',
        'do_keterangan'    => 'nullable|string|max:255',

        // NITRAT
        'nitrat'              => 'nullable|string|max:50',
        'nitrat_satuan'       => 'nullable|string|max:50',
        'nitrat_baku_mutu'    => 'nullable|string|max:50',
        'nitrat_keterangan'   => 'nullable|string|max:255',

        // TOTAL FOSFAT
        'total_fosfat'              => 'nullable|string|max:50',
        'total_fosfat_satuan'       => 'nullable|string|max:50',
        'total_fosfat_baku_mutu'    => 'nullable|string|max:50',
        'total_fosfat_keterangan'   => 'nullable|string|max:255',

        // AMONIA
        'amonia'              => 'nullable|string|max:50',
        'amonia_satuan'       => 'nullable|string|max:50',
        'amonia_baku_mutu'    => 'nullable|string|max:50',
        'amonia_keterangan'   => 'nullable|string|max:255',

        // FECAL COLIFORM
        'fecal_coliform'              => 'nullable|string|max:50',
        'fecal_coliform_satuan'       => 'nullable|string|max:50',
        'fecal_coliform_baku_mutu'    => 'nullable|string|max:50',
        'fecal_coliform_keterangan'   => 'nullable|string|max:255',

        // DAYA HANTAR LISTRIK
        'daya_hantar_listrik'              => 'nullable|string|max:50',
        'daya_hantar_listrik_satuan'       => 'nullable|string|max:50',
        'daya_hantar_listrik_baku_mutu'    => 'nullable|string|max:50',
        'daya_hantar_listrik_keterangan'   => 'nullable|string|max:255',

        // KEKERUHAN
        'kekeruhan'              => 'nullable|string|max:50',
        'kekeruhan_satuan'       => 'nullable|string|max:50',
        'kekeruhan_baku_mutu'    => 'nullable|string|max:50',
        'kekeruhan_keterangan'   => 'nullable|string|max:255',
    ]);

    $data['test_request_id'] = $req->id;

    TestResult::updateOrCreate(
        ['test_request_id' => $req->id],
        $data
    );

    return redirect()->route('admin.hasiluji.index')
        ->with('success','Hasil uji berhasil disimpan.');
}
    // ===== UPLOAD FILE DOKUMEN HASIL UJI =====
    public function upload(Request $request, $test_request_id)
    {
        $req = TestRequest::with('result')->findOrFail($test_request_id);

        $request->validate([
            'result_file' => 'required|file|mimes:pdf,doc,docx,xls,xlsx,jpg,jpeg,png|max:6144'
        ]);

        $file = $request->file('result_file');
        $path = $file->store('hasil_uji', 'public');

        $result = TestResult::firstOrCreate(
            ['test_request_id' => $req->id],
            ['test_request_id' => $req->id]
        );

        // hapus file lama kalau ada
        if($result->result_file && Storage::disk('public')->exists($result->result_file)){
            Storage::disk('public')->delete($result->result_file);
        }

        $result->result_file = $path;
        $result->save();

        return back()->with('success','Dokumen hasil uji berhasil diupload.');
    }

    // ===== PRINT =====
    public function print($test_request_id)
    {
        $req = TestRequest::with('user','result')->findOrFail($test_request_id);

        return view('admin.hasil_uji.print', compact('req'));
    }

    // ===== DOWNLOAD FILE HASIL UJI =====
    public function downloadFile($test_request_id)
    {
        $req = TestRequest::with('result')->findOrFail($test_request_id);

        if(!$req->result || !$req->result->result_file){
            abort(404,'File tidak ditemukan.');
        }

        // ambil path asli di storage
        $filePath = storage_path('app/public/' . $req->result->result_file);

        if (!file_exists($filePath)) {
            abort(404, 'File tidak ditemukan di server.');
        }

        return response()->download($filePath);
    }
}
