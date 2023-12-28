<?php

use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\PermohonanController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\UploadController;
use App\Models\Notifikasi;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
});
Route::get('/login', function () {
    return view('auth.login');
})->middleware('guest')->name('login');;
Route::get('/register', function () {
    return view('auth.register');
})->middleware('guest')->name('register');

// Socialite Auth Routes
Route::get('/auth/{provider}', [SocialiteController::class, 'redirectToProvider'])->name('socialite.redirect');
Route::get('/auth/{provider}/callback', [SocialiteController::class, 'handleProviderCallback'])->name('socialite.callback');

// Email Verification Routes
// Email Verification Notice
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');
// Email Verification Handler
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect()->route('dashboard');
})->middleware(['auth', 'signed'])->name('verification.verify');
// Resending the Verification Email
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::middleware(['auth'])->group(function () {
    Route::get('/logout', function () {
        auth()->logout();
        return redirect()->route('login');
    })->name('logout');

    // Verified Routes
    Route::middleware('verified')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Route Permohonan
        Route::get('/permohonan', [PermohonanController::class, 'permohonan'])->name('permohonan');

        Route::get('/permohonan/pendaftaran-merek', [PermohonanController::class, 'pendaftaranMerk'])->name('permohonan.pendaftaran-merek');
        Route::get('/permohonan/pendaftaran-merek/revisi/{no_permohonan}', [PermohonanController::class, 'revisiPendaftaranMerk'])->name('permohonan.pendaftaran-merek.revisi');
        Route::post('/permohonan/pendaftaran-merek', [PermohonanController::class, 'storePendaftaranMerk'])->name('permohonan.pendaftaran-merek.store');
        Route::post('/permohonan/pendaftaran-merek/revisi/{no_permohonan}', [PermohonanController::class, 'updatePendaftaranMerk'])->name('permohonan.pendaftaran-merek.update');
        Route::get('/permohonan/pendaftaran-merek/{no_permohonan}', [PermohonanController::class, 'showPendaftaranMerek'])->name('permohonan.pendaftaran-merek.show');
        Route::post('/permohonan/pendaftaran-merek/delete/{id}', [PermohonanController::class, 'deletePendaftaranMerek'])->name('permohonan.pendaftaran-merek.delete');

        Route::get('admin/permohonan', [PermohonanController::class, 'permohonanAdmin'])->name('admin.permohonan');
        Route::get('admin/permohonan/pendaftaran-merek/{no_permohonan}', [PermohonanController::class, 'adminShowPendaftaranMerek'])->name('admin.permohonan.pendaftaran-merek.show');
        Route::post('admin/permohonan/pendaftaran-merek/delete/{id}', [PermohonanController::class, 'deletePendaftaranMerek'])->name('admin.permohonan.pendaftaran-merek.delete');

        // Route Profil
        Route::get('/profil', [ProfilController::class, 'profil'])->name('profil');
        Route::get('/profil/edit', [ProfilController::class, 'edit'])->name('profil.edit');
        Route::post('/profil/edit', [ProfilController::class, 'update'])->name('profil.update');

        // Route Notifikasi
        Route::get('/notifikasi', function () {
            return view('dashboard.notifikasi.lihat');
        })->name('notifikasi.show');
        Route::get('/pengumuman', [PengumumanController::class, 'pengumuman'])->name('pengumuman');
        Route::get('/pengumuman/buat', [PengumumanController::class, 'createPengumuman'])->name('pengumuman.create');
        Route::post('/pengumuman/buat', [PengumumanController::class, 'storePengumuman'])->name('pengumuman.store');
        Route::get('/pengumuman/edit/{id}', [PengumumanController::class, 'editPengumuman'])->name('pengumuman.edit');
        Route::post('/pengumuman/update', [PengumumanController::class, 'updatePengumuman'])->name('pengumuman.update');
        Route::post('/pengumuman/delete', [PengumumanController::class, 'deletePengumuman'])->name('pengumuman.delete');

        // Route Laporan
        Route::get('/laporan/pendaftaran-merek', [LaporanController::class, 'index'])->name('laporan.pendaftaran-merek');
        Route::get('/laporan/pendaftaran-merek/cetakpdf', [LaporanController::class, 'cetak_pdf'])->name('laporan.pendaftaran-merek.cetakpdf');

        Route::get('/pengelolaan/user', function () {
            return view('dashboard.pengelolaan-user.index');
        })->name('pengelolaan.user');

        Route::post('/upload', [UploadController::class, 'image'])->name('upload');
    });
});

Route::get('/country_code', function () {
    // parse the array to json
    $country_code = json_encode(config('constants.country_code'));
    return $country_code;
})->name('country_code');
