<?php

use App\Http\Controllers\GoogleController;
use App\Http\Controllers\KamarController;
use App\Http\Controllers\NotifikasiController;
use App\Http\Controllers\UserController;
use App\Models\Kamar;
use Illuminate\Support\Facades\Route;

// Login dengan Google (SSO): hanya untuk tamu yang belum login.
Route::middleware('guest')->group(function () {
    Route::get('/auth/google', [GoogleController::class, 'redirect'])->name('google.redirect');
    Route::get('/auth/google/callback', [GoogleController::class, 'callback'])->name('google.callback');
});

Route::middleware('auth')->group(function () {

    Route::get('/', function () {
        return redirect()->route('dashboard');
    });

    Route::get('/dashboard', function () {
        $totalKamar = Kamar::count();
        $kamarTersedia = Kamar::where('status', 'Tersedia')->count();
        $kamarTerisi = Kamar::where('status', 'Terisi')->count();

        // Daftar notifikasi (mis. "pengguna baru mendaftar") hanya ditampilkan untuk admin.
        $user = auth()->user();
        $notifikasi = $user->isAdmin()
            ? $user->notifications()->latest()->take(10)->get()
            : collect();

        return view('dashboard', compact(
            'totalKamar',
            'kamarTersedia',
            'kamarTerisi',
            'notifikasi'
        ));
    })->name('dashboard');

    Route::post('/notifikasi/baca-semua', [NotifikasiController::class, 'bacaSemua'])->name('notifikasi.baca');

    // Semua user yang login: hanya melihat daftar & ketersediaan kamar.
    Route::get('/kamar', [KamarController::class, 'index'])->name('kamar.index');

    // Khusus admin: kelola kamar dan users.
    Route::middleware('admin')->group(function () {
        Route::resource('kamar', KamarController::class)->except(['index', 'show']);
        Route::resource('users', UserController::class)->except('show');
    });
});