<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // TAMPILKAN DAFTAR AKUN + SEARCH
    public function index(Request $request)
    {
        $query = User::query()
            // kalau mau filter hanya user biasa, bisa tambahkan where role
            ->where('role', 'customer')
            ->orderBy('created_at', 'desc');

        /* ========== SEARCH ========== */
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('instansi', 'like', "%{$search}%")
                  ->orWhere('nomor_hp', 'like', "%{$search}%");
            });
        }

        /* ========== FILTER TANGGAL (SAMA LOGIKA PERMINTAAN) ========== */
        $dateType = $request->get('date_type');    // date | month | year

        if ($dateType === 'date' && $request->filled('date')) {
            // filter persis per tanggal
            $query->whereDate('created_at', $request->date);

        } elseif ($dateType === 'month') {
            // filter per bulan (dan bisa digabung tahun)
            if ($request->filled('month')) {
                $query->whereMonth('created_at', $request->month);
            }
            if ($request->filled('year')) {
                $query->whereYear('created_at', $request->year);
            }

        } elseif ($dateType === 'year' && $request->filled('year')) {
            // filter per tahun saja
            $query->whereYear('created_at', $request->year);
        }

        $users = $query->paginate(10)->withQueryString();

        return view('admin.akun', compact('users'));
        // sesuaikan dengan nama view-mu:
        // return view('admin.akun.index', compact('users'));
    }

    // TAMBAH AKUN
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'role' => 'required'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role
        ]);

        return back()->with('success', 'Akun berhasil ditambahkan.');
    }

    // UPDATE AKUN
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'role' => 'required'
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;

        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return back()->with('success', 'Akun berhasil diperbarui.');
    }
public function print(Request $request)
{
    $search = $request->search;
    $bulan  = $request->bulan;
    $tahun  = $request->tahun;

    $users = User::where('role','customer')

        ->when($search, fn($q)=>$q->where('nama','like',"%$search%"))
        ->when($bulan, fn($q)=>$q->whereMonth('created_at',$bulan))
        ->when($tahun, fn($q)=>$q->whereYear('created_at',$tahun))
        ->get();

    return view('admin.print-akun', compact('users','bulan','tahun'));
}

    // HAPUS AKUN
    public function destroy($id)
    {
        User::destroy($id);
        return back()->with('success', 'Akun berhasil dihapus.');
    }

}
