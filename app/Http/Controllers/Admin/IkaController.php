<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ika;
use Illuminate\Http\Request;

class IkaController extends Controller
{
    public function index(Request $request)
    {
        $q = Ika::query();

        if ($request->search) {
            $q->where('kode_lokasi','like',"%{$request->search}%")
              ->orWhere('alamat','like',"%{$request->search}%")
              ->orWhere('sungai','like',"%{$request->search}%")
              ->orWhere('kategori','like',"%{$request->search}%");
        }

        $ikas = $q->orderByDesc('tanggal')->paginate(10);

        return view('admin.ika', compact('ikas'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'kode_lokasi' => 'required|string|max:50',
            'alamat'      => 'required|string',
            'sungai'      => 'nullable|string|max:120',
            'tanggal'     => 'required|date',
            'kategori'    => 'nullable|string|max:80',

            'latitude'    => 'nullable|numeric',
            'longitude'   => 'nullable|numeric',

            'kelas1'      => 'nullable|string|max:50',
            'kelas2'      => 'nullable|string|max:50',
            'kelas3'      => 'nullable|string|max:50',
            'kelas4'      => 'nullable|string|max:50',
        ]);

        Ika::create($data);

        return back()->with('success','Data IKA berhasil ditambah.');
    }

    public function update(Request $request, Ika $ika)
    {
        $data = $request->validate([
            'kode_lokasi' => 'required|string|max:50',
            'alamat'      => 'required|string',
            'sungai'      => 'nullable|string|max:120',
            'tanggal'     => 'required|date',
            'kategori'    => 'nullable|string|max:80',
            'latitude'    => 'nullable|numeric',
            'longitude'   => 'nullable|numeric',
            'kelas1'      => 'nullable|string|max:50',
            'kelas2'      => 'nullable|string|max:50',
            'kelas3'      => 'nullable|string|max:50',
            'kelas4'      => 'nullable|string|max:50',
        ]);

        $ika->update($data);

        return back()->with('success','Data IKA berhasil diupdate.');
    }

    public function destroy(Ika $ika)
    {
        $ika->delete();
        return back()->with('success','Data IKA dihapus.');
    }
}
