<?php

namespace App\Http\Controllers;

use App\Models\Galeri;

class HomeController extends Controller
{
    public function index()
    {
        // ambil 4 artikel terbaru untuk preview di home
        $galeris = Galeri::latest()->take(4)->get();

        return view('home', compact('galeris'));
    }
}
