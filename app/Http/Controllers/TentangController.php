<?php

namespace App\Http\Controllers;

use App\Models\StrukturOrganisasi;

class TentangController extends Controller
{
    public function index()
    {
        $items = StrukturOrganisasi::with('childrenRecursive')
            ->whereNull('parent_id')
            ->orderBy('urutan')
            ->get();


        return view('tentang', compact('items'));
    }
}
