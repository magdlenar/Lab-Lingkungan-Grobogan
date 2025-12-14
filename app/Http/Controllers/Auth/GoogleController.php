<?php 

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

/**
 * @mixin \Laravel\Socialite\Two\AbstractProvider
 */
class GoogleController extends Controller
{
    /**
     * Redirect pengguna ke Google Login
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Handle callback dari Google
     */
    public function handleGoogleCallback()
    {
        // Jika ingin menghindari error token mismatch → pakai stateless()
        $googleUser = Socialite::driver('google')->stateless()->user();

        // Cek user berdasarkan email
        $user = User::where('email', $googleUser->getEmail())->first();

        if ($user) {

            // Jika user sudah ada tapi belum punya google_id → update
            if (!$user->google_id) {
                $user->google_id = $googleUser->getId();
                $user->email_verified_at = now();
                $user->save();
            }

        } else {
            // Jika user baru → otomatis menjadi customer
            $user = User::create([
                'nama'              => $googleUser->getName(),
                'email'             => $googleUser->getEmail(),
                'password'          => Hash::make(Str::random(12)),
                'google_id'         => $googleUser->getId(),
                'email_verified_at' => now(),
                'role'              => 'customer', 
            ]);
        }

        // Login user
        Auth::login($user);

        // Redirect sesuai role
        if ($user->role === 'admin') {
            return redirect()->intended('/admin/dashboard');
        }

        // Default redirect untuk customer
        return redirect()->intended('/');
    }
}