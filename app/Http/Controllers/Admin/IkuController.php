<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Iku;
use Illuminate\Http\Request;

class IkuController extends Controller
{
    public function index(Request $request)
    {
        $q = Iku::query();

        if ($request->search) {
            $q->where('kabupaten_kota','like',"%{$request->search}%");
        }

        $ikus = $q->orderByDesc('created_at')->paginate(10);

        return view('admin.iku', compact('ikus'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'kabupaten_kota' => 'required|string|max:120',
            'rataan_no2'     => 'nullable|numeric',
            'rataan_so2'     => 'nullable|numeric',
            'indeks_no2'     => 'nullable|numeric',
            'indeks_so2'     => 'nullable|numeric',
            'rataan_indeks'  => 'nullable|numeric',
            'nilai_iku'      => 'nullable|numeric',
            'target_iku'     => 'nullable|numeric',
        ]);

        Iku::create($data);

        return back()->with('success','Data IKU berhasil ditambah.');
    }

    public function update(Request $request, Iku $iku)
    {
        $data = $request->validate([
            'kabupaten_kota' => 'required|string|max:120',
            'rataan_no2'     => 'nullable|numeric',
            'rataan_so2'     => 'nullable|numeric',
            'indeks_no2'     => 'nullable|numeric',
            'indeks_so2'     => 'nullable|numeric',
            'rataan_indeks'  => 'nullable|numeric',
            'nilai_iku'      => 'nullable|numeric',
            'target_iku'     => 'nullable|numeric',
        ]);

        $iku->update($data);

        return back()->with('success','Data IKU berhasil diupdate.');
    }

    public function destroy(Iku $iku)
    {
        $iku->delete();
        return back()->with('success','Data IKU dihapus.');
    }
}
