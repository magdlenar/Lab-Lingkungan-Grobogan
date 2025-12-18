<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StrukturOrganisasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StrukturOrganisasiController extends Controller
{
    public function index(Request $request)
{
    $q = StrukturOrganisasi::query()->with('parent');

    if ($request->filled('search')) {
        $search = $request->search;
        $q->where(function($w) use ($search) {
            $w->where('jabatan', 'like', "%{$search}%")
              ->orWhere('nama', 'like', "%{$search}%");
        });
    }

    // list admin tabel (urut global by parent_id then urutan)
    $items = $q->orderByRaw('COALESCE(parent_id, 0), urutan')->get();

    // parent dropdown: semua item biar bisa pilih atasan sesuai struktur
    $parents = StrukturOrganisasi::orderByRaw('COALESCE(parent_id, 0), urutan')->get();

    return view('admin.struktur', compact('items','parents'));
}
        public function store(Request $request)
{
    $request->validate([
        'jabatan_select' => ['required','string'],
        'jabatan_manual' => ['nullable','string','max:255'],
        'nama'           => ['required','string','max:255'],
        'urutan'         => ['nullable','integer','min:0'],
        'parent_id'      => ['nullable','exists:struktur_organisasis,id'],
        'foto'           => ['nullable','image','mimes:jpg,jpeg,png,webp','max:5120'],
    ]);

    // ✅ gabungkan jabatan
    $jabatanSelect = (string) $request->input('jabatan_select');
    $jabatanManual = trim((string) $request->input('jabatan_manual', ''));

    if ($jabatanSelect === '__custom__') {
        if ($jabatanManual === '') {
            return back()->withErrors(['jabatan_manual' => 'Jabatan manual wajib diisi.'])->withInput();
        }
        $jabatan = $jabatanManual;
    } else {
        $jabatan = $jabatanSelect;
    }

    $data = $request->only('nama','urutan','parent_id');
    $data['jabatan'] = $jabatan;

    if ($request->hasFile('foto')) {
        $data['foto'] = $request->file('foto')->store('struktur', 's3');
    }

    StrukturOrganisasi::create($data);

    return back()->with('success', 'Personel berhasil ditambahkan.');
}


  public function update(Request $request, StrukturOrganisasi $struktur)
{
    $request->validate([
        'jabatan_select' => ['required','string'],
        'jabatan_manual' => ['nullable','string','max:255'],
        'nama'           => ['required','string','max:255'],
        'urutan'         => ['nullable','integer','min:0'],
        'parent_id'      => ['nullable','exists:struktur_organisasis,id'],
        'foto'           => ['nullable','image','mimes:jpg,jpeg,png,webp','max:2048'],
    ]);

    $jabatanSelect = (string) $request->input('jabatan_select');
    $jabatanManual = trim((string) $request->input('jabatan_manual', ''));

    if ($jabatanSelect === '__custom__') {
        if ($jabatanManual === '') {
            return back()->withErrors(['jabatan_manual' => 'Jabatan manual wajib diisi.'])->withInput();
        }
        $jabatan = $jabatanManual;
    } else {
        $jabatan = $jabatanSelect;
    }

    $data = $request->only('nama','urutan','parent_id');
    $data['jabatan'] = $jabatan;

    if ($request->hasFile('foto')) {
        if ($struktur->foto) Storage::disk('s3')->delete($struktur->foto);
        $data['foto'] = $request->file('foto')->store('struktur', 's3');
    }

    $struktur->update($data);

    return back()->with('success','Data struktur organisasi berhasil diperbarui.');
}

    public function destroy(StrukturOrganisasi $struktur)
    {
        if($struktur->foto){
            Storage::disk('s3')->delete($struktur->foto);
        }
        $struktur->delete();

        return back()->with('success','Data struktur organisasi berhasil dihapus.');
    }
}
