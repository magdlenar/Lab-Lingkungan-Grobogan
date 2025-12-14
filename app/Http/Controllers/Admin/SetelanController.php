<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SetelanController extends Controller
{
    public function index()
    {
        $user = Auth::user(); // ambil admin yang login
        return view('admin.setelan', compact('user'));
    }

    public function update(Request $request)
        {
            /** @var User $user */
            $user = Auth::user(); 

            $request->validate([
                'email' => 'required|email',
                'password' => 'nullable|min:6'
            ]);

            $user->email = $request->email;

            if ($request->password) {
                $user->password = Hash::make($request->password);
            }

            $user->save();

            return back()->with('success', 'Setelan berhasil diperbarui!');
        }

}
