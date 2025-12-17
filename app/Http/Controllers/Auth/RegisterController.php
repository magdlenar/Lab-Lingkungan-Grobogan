<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\VerificationCodeMail;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'nama'       => 'required|string|max:255',
            'email'      => 'required|string|email|max:255|unique:users',
            'nomor_hp'   => 'required|string|max:20',
            'instansi'   => 'required|string|max:255',
            'password'   => 'required|string|min:8|confirmed',
        ]);

        // Generate kode verifikasi 6 huruf kapital
        $verificationCode = Str::upper(Str::random(6));

        // Simpan user
        $user = User::create([
            'nama'              => $request->nama,
            'email'             => $request->email,
            'nomor_hp'          => $request->nomor_hp,
            'instansi'          => $request->instansi,
            'password'          => Hash::make($request->password),
            'verification_code' => $verificationCode,
            'role'              => 'customer', // default role
        ]);

        try {
            Mail::to($user->email)->send(new VerificationCodeMail($user));
        } catch (\Exception $e) {
            \Log::error('Email verification failed: ' . $e->getMessage());
        
            return back()->withErrors([
                'email' => 'Gagal mengirim email verifikasi. Coba lagi nanti.'
            ]);
        }

        // Simpan session untuk halaman verifikasi
        session(['verify_email' => $user->email]);

        return redirect()
            ->route('verify.email')
            ->with('status', 'Kode verifikasi telah dikirim ke email Anda.');
    }

    public function showVerifyForm()
    {
        if (!session('verify_email')) {
            return redirect()->route('register')
                ->withErrors(['email' => 'Session verifikasi tidak ditemukan. Silakan daftar ulang.']);
        }
    
        return view('auth.verify_email');
    }

    public function verifyEmail(Request $request)
    {
        $request->validate(['code' => 'required|string']);

        $user = User::where('email', session('verify_email'))
                    ->where('verification_code', $request->code)
                    ->first();

        if (!$user) {
            return back()->withErrors(['code' => 'Kode verifikasi salah atau tidak cocok dengan email Anda.']);
        }

        $user->email_verified_at = now();
        $user->verification_code = null;
        $user->save();

        session()->forget('verify_email');

        return redirect()->route('login')
            ->with('status', 'Email berhasil diverifikasi. Silakan login.');
    }


    //   FUNGSI KIRIM ULANG KODE VERIFIKASI
    public function resendCode(Request $request)
    {
        $email = session('verify_email');

        if (!$email) {
            return redirect()->route('register')
                ->withErrors(['email' => 'Session tidak ditemukan, silakan daftar ulang.']);
        }

        $user = User::where('email', $email)->first();

        if (!$user) {
            return redirect()->route('register')
                ->withErrors(['email' => 'Akun tidak ditemukan.']);
        }

        // Buat kode baru
        $newCode = Str::upper(Str::random(6));

        $user->verification_code = $newCode;
        $user->save();

        // Kirim email ulang
        Mail::to($user->email)->send(new VerificationCodeMail($user));

        return back()->with('status', 'Kode verifikasi baru telah dikirim!');
    }
     // === KHUSUS PROFILE UPDATE ===
    public function sendVerificationCode($user)
    {
        $newCode = Str::upper(Str::random(6));

        $user->verification_code = $newCode;
        $user->email_verified_at = null;
        $user->save();

        Mail::to($user->email)->send(new VerificationCodeMail($user));

        return true;
    }
}
