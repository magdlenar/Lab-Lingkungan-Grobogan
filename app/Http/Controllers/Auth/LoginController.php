<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    // ==========================
    // HALAMAN LOGIN
    // ==========================
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // ==========================
    // PROSES LOGIN
    // ==========================
    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials, $request->has('remember'))) {

            // FIX 419
            $request->session()->regenerate();
            $request->session()->regenerateToken();

            if (Auth::user()->role === 'admin') {
                return redirect()->intended('/admin/dashboard');
            }

            return redirect()->intended('/home');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->withInput();
    }
    // LOGOUT
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    // =============== RESET PASSWORD ======================

    // 1. Kirim email reset password
    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email']
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with('status', "Link reset password telah dikirim ke email Anda.")
            : back()->withErrors(['email' => 'Email tidak ditemukan.']);
    }

    // 2. Tampilkan form reset (saat klik link email)
    public function showResetForm($token)
    {
        return view('auth.reset-password', ['token' => $token]);
    }

    // 3. Proses reset password
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'min:8', 'confirmed'],
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) use ($request) {
                $user->password = Hash::make($request->password);
                $user->save();
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', "Password berhasil direset. Silakan login.")
            : back()->withErrors(['email' => 'Gagal mereset password.']);
    }
}
