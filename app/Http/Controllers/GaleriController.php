<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use App\Models\GaleriComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GaleriController extends Controller
{
    /* ================= ADMIN ================= */

    public function adminIndex(Request $request)
    {
        $search = $request->search;

        $galeris = Galeri::when($search, function($q) use ($search){
                $q->where('judul','like',"%$search%")
                  ->orWhere('deskripsi','like',"%$search%")
                  ->orWhere('tagar','like',"%$search%");
            })
            ->latest()
            ->paginate(10);

        return view('admin.galeri', compact('galeris','search'));
    }

    public function adminStore(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tagar' => 'nullable|string|max:255',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
        ]);

        $path = null;
        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('galeri', 's3');
        }
        Galeri::create([
            'judul' => $request->judul,
            'gambar' => $path,
            'deskripsi' => $request->deskripsi,
            'tagar' => $request->tagar,
        ]);

        return back()->with('success','Artikel galeri berhasil dibuat.');
    }

    public function adminUpdate(Request $request, $id)
    {
        $galeri = Galeri::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tagar' => 'nullable|string|max:255',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
        ]);

        if ($request->hasFile('gambar')) {
            // ✅ HAPUS GAMBAR LAMA DI B2
            if ($galeri->gambar && Storage::disk('s3')->exists($galeri->gambar)) {
                Storage::disk('s3')->delete($galeri->gambar);
            }

            // ✅ SIMPAN GAMBAR BARU KE B2
            $galeri->gambar = $request->file('gambar')->store('galeri', 's3');
        }

        $galeri->judul = $request->judul;
        $galeri->deskripsi = $request->deskripsi;
        $galeri->tagar = $request->tagar;
        $galeri->save();

        return back()->with('success','Artikel berhasil diupdate.');
    }

    public function adminDestroy($id)
    {
        $galeri = Galeri::findOrFail($id);

        if ($galeri->gambar && Storage::disk('s3')->exists($galeri->gambar)) {
            Storage::disk('s3')->delete($galeri->gambar);
        }

        $galeri->delete();

        return back()->with('success','Artikel berhasil dihapus.');
    }

    /* ================= PUBLIC ================= */

    public function publicIndex(Request $request)
    {
        $search = $request->search;

        $galeris = Galeri::when($search, function($q) use ($search){
                $q->where('judul','like',"%$search%")
                  ->orWhere('deskripsi','like',"%$search%")
                  ->orWhere('tagar','like',"%$search%");
            })
            ->latest()
            ->paginate(10);

        return view('gallery', compact('galeris','search'));
    }

    public function publicShow($slug)
    {
        $galeri = Galeri::where('slug',$slug)->firstOrFail();
        $comments = $galeri->comments()->paginate(10);

        return view('gallery_show', compact('galeri','comments'));
    }

    public function storeComment(Request $request, $id)
    {
        $galeri = Galeri::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:80',
            'komentar' => 'required|string|max:500',
        ]);

        GaleriComment::create([
            'galeri_id' => $galeri->id,
            'nama' => $request->nama,
            'komentar' => $request->komentar,
        ]);

        return back()->with('success','Komentar berhasil dikirim.');
    }
        public function destroyComment($id)
        {
            $comment = GaleriComment::findOrFail($id);
            $comment->delete();
    
            return back()->with('success', 'Komentar berhasil dihapus.');
        }

}
