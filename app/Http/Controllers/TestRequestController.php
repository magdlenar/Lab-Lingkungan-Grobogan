<?php
namespace App\Http\Controllers;

use App\Models\TestRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TestRequestController extends Controller
{
    public function create()
    {
        return view('customer.uji');
    }

    public function store(Request $request)
    {
        $request->validate([
            'pic_name' => 'required',
            'pic_phone' => 'required',
            'pic_email' => 'required|email',
            'sample_address' => 'required',
            'service_type' => 'required',
            'letter_file' => 'required|mimes:pdf,jpg,png|max:6144'
        ]);

        $file = $request->file('letter_file')->store('permohonan', 's3');

        TestRequest::create([
            'user_id' => Auth::id(),
            'pic_name' => $request->pic_name,
            'pic_phone' => $request->pic_phone,
            'pic_email' => $request->pic_email,
            'sample_address' => $request->sample_address,
            'service_type' => $request->service_type,
            'notes' => $request->notes,
            'letter_file' => $file,
            'status' => 'pemeriksaan kelengkapan'
        ]);

        return redirect()->route('uji.status')->with('success', 'Permohonan berhasil dikirim!');
    }

    public function status()
    {
        $requests = TestRequest::where('user_id', Auth::id())
        ->orderBy('created_at', 'desc')
        ->paginate(10);

         return view('customer.status', compact('requests'));
    }
    public function update(Request $request, $id)
    {
        $req = TestRequest::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        // optional: batasi update hanya kalau status memang tidak lengkap
        if ($req->status !== 'persyaratan tidak lengkap') {
            return back()->with('error', 'Permintaan ini tidak dalam status perbaikan.');
        }

        $request->validate([
            'pic_name' => 'required',
            'pic_phone' => 'required',
            'pic_email' => 'required|email',
            'sample_address' => 'required',
            'notes' => 'nullable|string',
            'letter_file' => 'nullable|mimes:pdf,jpg,png|max:6144'
        ]);

        // update field utama
        $req->pic_name = $request->pic_name;
        $req->pic_phone = $request->pic_phone;
        $req->pic_email = $request->pic_email;
        $req->sample_address = $request->sample_address;
        $req->notes = $request->notes;

        // jika user upload ulang surat
        if ($request->hasFile('letter_file')) {
            // hapus file lama
            if ($req->letter_file && Storage::disk('s3')->exists($req->letter_file)) {
                Storage::disk('s3')->delete($req->letter_file);
            }

            $req->letter_file = $request->file('letter_file')->store('permohonan', 's3');
        }

        // setelah diperbaiki, kembalikan ke pemeriksaan
        $req->status = 'pemeriksaan kelengkapan';
        $req->fix_fields = null; // reset catatan perbaikan admin kalau ada

        $req->save();

        return redirect()->route('uji.status')
            ->with('success', 'Data permintaan berhasil diperbarui dan dikirim ulang.');
    }
    public function downloadPickupLetterCustomer($id)
    {
        $req = TestRequest::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();
    
        if (!$req->pickup_letter_file) {
            abort(404, "Surat pengambilan sampel belum tersedia.");
        }
    
        // ✅ ambil file langsung dari Backblaze B2 (disk s3)
        return Storage::disk('s3')->download($req->pickup_letter_file);
    }


}
