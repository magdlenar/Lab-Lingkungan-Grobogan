<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use App\Models\LabDocument;
class HomeController extends Controller
{
    public function index()
    {
        // ambil 4 artikel terbaru untuk preview di home
        $galeris = Galeri::latest()->take(4)->get();

        return view('home', compact('galeris'));
    }
    public function layanan()
{
    $labDoc = LabDocument::first();
    return view('layanan', compact('labDoc'));
}
}
