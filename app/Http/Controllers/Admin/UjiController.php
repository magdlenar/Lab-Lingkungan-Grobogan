<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Models\TestRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\LabDocument;

class UjiController extends Controller
{
    public function index(Request $request)
    {
        $service = $request->service_type;
        $date    = $request->date;
        $month   = $request->month;
        $year    = $request->year;
        $search  = $request->search;

        $data = TestRequest::with('user');

        // FILTER layanan
        if ($service) {
            $data->where('service_type', $service);
        }

        // FILTER tanggal spesifik
        if ($date) {
            $data->whereDate('created_at', $date);
        }

        // FILTER bulan
        if ($month) {
            $data->whereMonth('created_at', $month);
        }

        // FILTER tahun
        if ($year) {
            $data->whereYear('created_at', $year);
        }

        // FILTER SEARCH (nama user, instansi, PIC)
        if ($search) {
            $data->where(function ($q) use ($search) {
                $q->whereHas('user', function ($u) use ($search) {
                    $u->where('nama', 'like', "%{$search}%")      // ✅ ganti name -> nama
                    ->orWhere('instansi', 'like', "%{$search}%");
                })
                ->orWhere('pic_name', 'like', "%{$search}%")
                ->orWhere('pic_phone', 'like', "%{$search}%")
                ->orWhere('pic_email', 'like', "%{$search}%");
            });
        }

        // HITUNG TOTAL
        $counts = [
            'uji kualitas sungai' => TestRequest::where('service_type', 'uji kualitas sungai')->count(),
            'uji kualitas limbah' => TestRequest::where('service_type', 'uji kualitas limbah')->count(),
            'uji kualitas danau'  => TestRequest::where('service_type', 'uji kualitas danau')->count(),
            'uji kualitas lindi'  => TestRequest::where('service_type', 'uji kualitas lindi')->count(),
        ];

        return view('admin.permintaan', [
            'requests' => $data->latest()->paginate(10),
            'counts'   => $counts
        ]);
    }
    public function dashboard()
{
    // ================== STATISTIK PER STATUS ==================
    $pemeriksaan = TestRequest::where('status', 'pemeriksaan kelengkapan')->count();
    $tdkLengkap  = TestRequest::where('status', 'persyaratan tidak lengkap')->count();
    $lengkap     = TestRequest::where('status', 'persyaratan lengkap')->count();
    $jadwalSampel= TestRequest::where('status', 'jadwal pengambilan sampel')->count();
    $ambilSampel = TestRequest::where('status', 'sedang dilakukan analisis')->count();
    $ujiSelesai  = TestRequest::where('status', 'uji selesai')->count();
    $verifikasi  = TestRequest::where('status', 'verifikasi hasil uji')->count();
    $terbitLHU   = TestRequest::where('status', 'penerbitan LHU')->count(); // sesuai migration

    // ================== AMBIL LIST TAHUN ==================
    $tahunPermintaan = TestRequest::selectRaw('YEAR(created_at) as year')
        ->distinct()
        ->orderBy('year')
        ->pluck('year');

    $tahunAkun = User::where('role', 'customer')
        ->selectRaw('YEAR(created_at) as year')
        ->distinct()
        ->orderBy('year')
        ->pluck('year');

    // gabung tahun dari dua tabel biar label sama
    $labelTahun = $tahunPermintaan
        ->merge($tahunAkun)
        ->unique()
        ->sort()
        ->values()
        ->toArray();

    // kalau belum ada data sama sekali, tetap tampilkan tahun ini
    if (count($labelTahun) == 0) {
        $labelTahun = [now()->year];
    }

    // ================== GRAFIK PERMINTAAN PER TAHUN ==================
    $permintaanPerTahun = TestRequest::selectRaw('YEAR(created_at) as year, COUNT(*) as total')
        ->groupBy('year')
        ->orderBy('year')
        ->pluck('total', 'year');   // contoh: [2022=>10, 2023=>15]

    $dataPermintaanTahun = [];
    foreach ($labelTahun as $t) {
        $dataPermintaanTahun[] = $permintaanPerTahun[$t] ?? 0;
    }

    // ================== GRAFIK AKUN CUSTOMER PER TAHUN ==================
    $akunPerTahun = User::where('role', 'customer')
        ->selectRaw('YEAR(created_at) as year, COUNT(*) as total')
        ->groupBy('year')
        ->orderBy('year')
        ->pluck('total', 'year');

    $dataAkunTahun = [];
    foreach ($labelTahun as $t) {
        $dataAkunTahun[] = $akunPerTahun[$t] ?? 0;
    }
   $labDoc = LabDocument::first();

    return view('admin.dashboard', compact(
        'pemeriksaan',
        'tdkLengkap',
        'lengkap',
        'jadwalSampel',
        'ambilSampel',
        'ujiSelesai',
        'verifikasi',
        'terbitLHU',
        'labelTahun',
        'dataPermintaanTahun',
        'dataAkunTahun',
        'labDoc'
    ));
}

    // ================= PRINT ==================
    public function print(Request $request)
    {
        $query = TestRequest::query();

        // FILTER layanan
        if ($request->service_type) {
            $query->where('service_type', $request->service_type);
        }

        // FILTER tanggal/bulan/tahun
        if ($request->date_type == 'date' && $request->date) {
            $query->whereDate('created_at', $request->date);
        }

        if ($request->date_type == 'month' && $request->month) {
            $query->whereMonth('created_at', $request->month);
            if ($request->year) {
                $query->whereYear('created_at', $request->year);
            }
        }

        if ($request->date_type == 'year' && $request->year) {
            $query->whereYear('created_at', $request->year);
        }

        // FILTER search
        if ($request->search) {
            $query->where(function($q) use ($request) {
                $q->where('pic_name', 'like', "%{$request->search}%")
                ->orWhere('sample_address', 'like', "%{$request->search}%")
                ->orWhere('service_type', 'like', "%{$request->search}%");
            });
        }

        $data = $query->get();

        return view('admin.ujiprint', compact('data'));
    }


    // ============= DOWNLOAD FILE =================
    public function downloadFile($id)
    {
        $req = TestRequest::findOrFail($id);
    
        if (!$req->letter_file) {
            abort(404, "File tidak ditemukan.");
        }
    
        // ✅ download langsung dari Backblaze B2 (disk s3)
        return Storage::disk('s3')->download($req->letter_file);
    }

    // ============= UPDATE STATUS =================
    public function updateStatus(Request $request, $id)
    {
        $req = TestRequest::findOrFail($id);

        // update status
        $req->status = $request->status;

        // catatan
        if ($request->filled('notes')) {
            $req->notes = $request->notes;
        }

        // ================= PERBAIKAN DATA =================
        if ($request->status === 'persyaratan tidak lengkap') {
            $req->fix_fields = json_encode($request->fix_fields ?? []);
        } else {
            $req->fix_fields = null;
        }

        // ================= PENGAMBILAN SAMPEL =================
        if ($request->status === 'pengambilan sampel') {

            // tanggal pengambilan
            if ($request->filled('sample_pickup_date')) {
                $req->sample_pickup_date = $request->sample_pickup_date;
            }

            // upload surat pengambilan sampel
            if ($request->hasFile('pickup_letter_file')) {

                $request->validate([
                    'pickup_letter_file' => 'mimes:pdf,jpg,png|max:5120' // 5 MB
                ]);

                // hapus file lama jika ada
                if ($req->pickup_letter_file && Storage::disk('s3')->exists($req->pickup_letter_file)) {
                    Storage::disk('s3')->delete($req->pickup_letter_file);
                }

                // simpan file baru
                $req->pickup_letter_file = $request->file('pickup_letter_file')
                    ->store('pickup_letters', 's3');
            }
        }

        // ================= SIMPAN =================
        $req->save();

        return back()->with('success', 'Status berhasil diperbarui.');
    }

        // ============= HAPUS DATA =================
    public function destroy($id)
    {
        $uji = TestRequest::findOrFail($id);
    
        // ✅ HAPUS FILE di Backblaze B2 jika ada
        if ($uji->letter_file && Storage::disk('s3')->exists($uji->letter_file)) {
            Storage::disk('s3')->delete($uji->letter_file);
        }
    
        $uji->delete();
    
        return back()->with('success', 'Data permintaan uji berhasil dihapus.');
    }

    // ============= HALAMAN HASIL UJI =================
    public function hasilUji($id)
    {
        $req = TestRequest::findOrFail($id);
        return view('customer.hasil-uji', compact('req'));
    }
    public function hasilUjiList()
{
    $requests = TestRequest::with(['result'])
        ->where('user_id', Auth::id())
        ->whereHas('result') // hanya yang sudah ada hasilnya
        ->latest()
        ->paginate(10);

    return view('customer.hasil-uji-list', compact('requests'));
}

public function downloadHasilUji($id)
    {
        $req = TestRequest::with('result')
            ->where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();
    
        if (!$req->result || !$req->result->result_file) {
            abort(404, "File hasil uji belum tersedia.");
        }
    
        // ✅ ambil file langsung dari Backblaze B2
        return Storage::disk('s3')->download($req->result->result_file);
    }
    
public function downloadPickupLetter($id)
    {
        $req = TestRequest::findOrFail($id);
    
        if (!$req->pickup_letter_file) {
            abort(404, "File tidak ditemukan.");
        }
    
        // ✅ download dari Backblaze B2
        return Storage::disk('s3')->download($req->pickup_letter_file);
    }
    
public function updateLabDocuments(Request $request)
{
    $doc = LabDocument::first() ?? LabDocument::create([]);

    $request->validate([
        'sop_file' => 'nullable|mimes:pdf,jpg,png|max:5120',
        'sk_sop_file' => 'nullable|mimes:pdf,jpg,png|max:5120',
    ]);

    // SOP
    if ($request->hasFile('sop_file')) {
        if ($doc->sop_file) {
            try {
                Storage::disk('s3')->delete($doc->sop_file);
            } catch (\Throwable $e) {
                \Log::warning('Gagal hapus SOP lama di S3: '.$doc->sop_file.' | '.$e->getMessage());
            }
        }

        try {
            $doc->sop_file = Storage::disk('s3')->putFile('lab_docs', $request->file('sop_file'), 'private');
        } catch (\Throwable $e) {
            \Log::error('Gagal upload SOP ke S3: '.$e->getMessage());
            return back()->withErrors(['sop_file' => 'Upload SOP gagal. Cek setting Backblaze B2 (S3).']);
        }
    }

    // SK SOP
    if ($request->hasFile('sk_sop_file')) {
        if ($doc->sk_sop_file) {
            try {
                Storage::disk('s3')->delete($doc->sk_sop_file);
            } catch (\Throwable $e) {
                \Log::warning('Gagal hapus SK SOP lama di S3: '.$doc->sk_sop_file.' | '.$e->getMessage());
            }
        }

        try {
            $doc->sk_sop_file = Storage::disk('s3')->putFile('lab_docs', $request->file('sk_sop_file'), 'private');
        } catch (\Throwable $e) {
            \Log::error('Gagal upload SK SOP ke S3: '.$e->getMessage());
            return back()->withErrors(['sk_sop_file' => 'Upload SK SOP gagal. Cek setting Backblaze B2 (S3).']);
        }
    }

    $doc->save();

    return back()->with('success', 'Dokumen SOP berhasil diperbarui.');
}

}
