<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\UjiController;
use App\Http\Controllers\Admin\HasilUjiController;
use App\Http\Controllers\Customer\ProfileController;
use App\Http\Controllers\TestRequestController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\PublikasiController;
use App\Http\Controllers\Admin\IkaController;
use App\Http\Controllers\Admin\IkuController;
use App\Http\Controllers\Admin\StrukturOrganisasiController;
use App\Http\Controllers\TentangController;
use App\Http\Controllers\HomeController;

// ================= STATIC PAGE ================
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index']);
Route::get('/tentang', [TentangController::class, 'index'])->name('tentang');
Route::get('/layanan', [HomeController::class, 'layanan'])->name('layanan');
Route::get('/dokumen-lab/{type}/download', function ($type) {
    $doc = \App\Models\LabDocument::firstOrFail();

    $file = null;
    if ($type === 'sop') $file = $doc->sop_file;
    if ($type === 'sk')  $file = $doc->sk_sop_file;

    if (!$file) abort(404, 'File belum tersedia.');

    $path = storage_path('app/public/' . $file);
    if (!file_exists($path)) abort(404, 'File tidak ditemukan di server.');

    return response()->download($path);
})->name('dokumenlab.download');

// ================= GUEST =====================
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);

    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);

    Route::post('/password/email', [LoginController::class, 'sendResetLink'])->name('password.email');
    Route::get('/reset-password/{token}', [LoginController::class, 'showResetForm'])->name('password.reset');
    Route::post('/reset-password', [LoginController::class, 'resetPassword'])->name('password.update');

    Route::get('/auth/google', [GoogleController::class, 'redirectToGoogle'])->name('auth.google');
    Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);
});

// ========== VERIFIKASI EMAIL (public) ==========
Route::get('/verifikasi-email', [RegisterController::class, 'showVerifyForm'])->name('verify.email');
Route::post('/verifikasi-email', [RegisterController::class, 'verifyEmail']);
Route::post('/verifikasi-email/resend', [RegisterController::class, 'resendCode'])->name('verify.email.resend');

// ================= LOGOUT =====================
Route::post('/logout', [LoginController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');
// ================= GALERI (PUBLIC) =====================
// bisa diakses tanpa login
Route::get('/galeri', [GaleriController::class, 'publicIndex'])->name('galeri.index');
Route::get('/galeri/{slug}', [GaleriController::class, 'publicShow'])->name('galeri.show');
Route::post('/galeri/{id}/komentar', [GaleriController::class, 'storeComment'])->name('galeri.comment.store');

Route::get('/publikasi/ika', [PublikasiController::class,'ika'])->name('publik.ika');
Route::get('/publikasi/iku', [PublikasiController::class,'iku'])->name('publik.iku');

// ================= ADMIN PANEL =====================
Route::prefix('admin')
    ->middleware(['auth', 'admin'])
    ->group(function () {

        // DASHBOARD
        Route::get('/dashboard', [UjiController::class, 'dashboard'])->name('admin.dashboard');
        Route::post('/dokumen-lab/update', [UjiController::class, 'updateLabDocuments'])
        ->name('admin.dokumenlab.update');


        // AKUN
        Route::get('/akun', [UserController::class, 'index'])->name('admin.akun');
        Route::get('/akun/print', [UserController::class, 'print'])->name('admin.akun.print');
        Route::delete('/akun/delete/{id}', [UserController::class, 'destroy'])->name('admin.akun.destroy');

        // SETELAN
        Route::get('/setelan', [App\Http\Controllers\Admin\SetelanController::class, 'index'])->name('admin.setelan');
        Route::post('/setelan/update', [App\Http\Controllers\Admin\SetelanController::class, 'update'])->name('admin.setelan.update');

        // PERMINTAAN UJI
        Route::get('/permintaan', [UjiController::class, 'index'])->name('admin.permintaan');
        Route::get('/ujiprint', [UjiController::class, 'print'])->name('admin.uji.print');
        Route::get('/file/{id}', [UjiController::class, 'downloadFile'])->name('admin.file');
        Route::put('/uji/status/{id}', [UjiController::class, 'updateStatus'])->name('admin.uji.status');
        Route::delete('/uji/{id}', [UjiController::class, 'destroy'])->name('uji.destroy');
        Route::get('/permintaan/{id}/pickup-letter', [UjiController::class, 'downloadPickupLetter'])
        ->name('pickup_letter.download');

        // HASIL UJI
        Route::get('/hasil-uji', [HasilUjiController::class, 'index'])
            ->name('admin.hasiluji.index');

        // ✅ TARUH PRINT LIST DI ATAS ROUTE {id}
        Route::get('/hasil-uji/print-list', [HasilUjiController::class, 'printList'])
            ->name('admin.hasiluji.printlist');

        // route dengan parameter id (kasih whereNumber biar aman)
        Route::get('/hasil-uji/{id}', [HasilUjiController::class, 'form'])
            ->whereNumber('id')
            ->name('admin.hasiluji.form');

        Route::post('/hasil-uji/{id}', [HasilUjiController::class, 'store'])
            ->whereNumber('id')
            ->name('admin.hasiluji.store');

        Route::post('/hasil-uji/{id}/upload', [HasilUjiController::class, 'upload'])
            ->whereNumber('id')
            ->name('admin.hasiluji.upload');

        Route::get('/hasil-uji/{id}/print', [HasilUjiController::class, 'print'])
            ->whereNumber('id')
            ->name('admin.hasiluji.print');

        Route::get('/hasil-uji/{id}/download', [HasilUjiController::class, 'downloadFile'])
            ->whereNumber('id')
            ->name('admin.hasiluji.download');
                // ================= GALERI ADMIN =====================
        Route::get('/galeri', [GaleriController::class, 'adminIndex'])->name('admin.galeri.index');
        Route::post('/galeri', [GaleriController::class, 'adminStore'])->name('admin.galeri.store');
        Route::put('/galeri/{id}', [GaleriController::class, 'adminUpdate'])->name('admin.galeri.update');
        Route::delete('/galeri/{id}', [GaleriController::class, 'adminDestroy'])->name('admin.galeri.destroy');
        Route::delete('/galeri/comment/{id}', [App\Http\Controllers\GaleriController::class, 'destroyComment'])
            ->whereNumber('id')
            ->name('admin.galeri.comment.destroy');
        Route::get('/publikasi', fn() => redirect()->route('admin.ika.index'))->name('publikasi.index');
        Route::resource('ika', IkaController::class)
            ->names('admin.ika')
            ->only(['index','store','update','destroy']);

        Route::resource('iku', IkuController::class)
            ->names('admin.iku')
            ->only(['index','store','update','destroy']);
        Route::resource('struktur', StrukturOrganisasiController::class)
        ->names('admin.struktur')
        ->except(['show','create','edit']);

    });

// ================= CUSTOMER PANEL =====================
Route::middleware('auth')->group(function () {

    // PROFILE CUSTOMER
    Route::get('/customer/profil', [ProfileController::class, 'index'])->name('customer.profil');
    Route::post('/profil/update', [ProfileController::class, 'updateProfile'])->name('profil.update');
    Route::post('/profil/update-password', [ProfileController::class, 'updatePassword'])->name('profil.password');

    // FORM PERMINTAAN UJI
    Route::get('/customer/uji', [TestRequestController::class, 'create'])->name('uji.create');
    Route::post('/customer/uji', [TestRequestController::class, 'store'])->name('uji.store');

    // STATUS PERMINTAAN
    Route::get('/customer/status', [TestRequestController::class, 'status'])->name('uji.status');
    Route::get('/uji/{id}/pickup-letter', [TestRequestController::class, 'downloadPickupLetterCustomer'])
    ->name('uji.pickup_letter.download');

    // UPDATE JIKA PERSYARATAN TIDAK LENGKAP
    Route::post('/permintaan-uji/update/{id}', [TestRequestController::class, 'update'])->name('uji.update');

    // HASIL UJI CUSTOMER VIEW
    Route::get('/hasil-uji', [UjiController::class, 'hasilUjiList'])
        ->name('uji.hasil.list');

    // DETAIL HASIL UJI CUSTOMER (SUDAH ADA DI KAMU)
    Route::get('/hasil-uji/{id}', [UjiController::class, 'hasilUji'])
        ->name('uji.hasil');

    // DOWNLOAD DOKUMEN HASIL UJI CUSTOMER
    Route::get('/hasil-uji/{id}/download', [UjiController::class, 'downloadHasilUji'])
        ->name('uji.hasil.download');
});
