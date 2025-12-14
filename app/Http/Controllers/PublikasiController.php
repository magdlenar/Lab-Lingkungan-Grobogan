<?php

namespace App\Http\Controllers;

use App\Models\Ika;
use App\Models\Iku;
use Illuminate\Http\Request;

class PublikasiController extends Controller
{
    public function ika(Request $request)
    {
        $q = Ika::query();

        if ($request->search) {
            $q->where('kode_lokasi','like',"%{$request->search}%")
              ->orWhere('alamat','like',"%{$request->search}%")
              ->orWhere('sungai','like',"%{$request->search}%");
        }

        $ikas = $q->orderByDesc('tanggal')->paginate(12);

        return view('pika', compact('ikas'));
    }

    public function iku(Request $request)
    {
        $q = Iku::query();

        if ($request->search) {
            $q->where('kabupaten_kota','like',"%{$request->search}%");
        }

        $ikus = $q->orderByDesc('created_at')->paginate(12);

        return view('piku', compact('ikus'));
    }
}

