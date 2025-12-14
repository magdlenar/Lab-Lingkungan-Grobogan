<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ProfileController extends Controller
{
    // TAMPILKAN PROFIL
    public function index()
    {
        $user = Auth::user();
        return view('customer.profil', compact('user'));
    }

    // UPDATE PROFIL
    public function updateProfile(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email',
            'nomor_hp' => 'required',
            'instansi' => 'required',
        ]);

        /** @var User $user */
        $user = User::find(Auth::id());
        $user->nama = $request->nama;
        $user->email = $request->email;
        $user->nomor_hp = $request->nomor_hp;
        $user->instansi = $request->instansi;
        $user->save();

        return back()->with('success', 'Profil berhasil diperbarui!');
    }

    // UPDATE PASSWORD
    public function updatePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|min:6|confirmed'
        ]);

        /** @var User $user */
        $user = User::find(Auth::id());
        $user->password = Hash::make($request->password);
        $user->save();

        return back()->with('success', 'Password berhasil diperbarui!');
    }

    // HAPUS AKUN
    public function deleteAccount()
    {
        /** @var User $user */
        $user = User::find(Auth::id());

        Auth::logout();
        $user->delete();

        return redirect('/')->with('success', 'Akun berhasil dihapus.');
    }
}
