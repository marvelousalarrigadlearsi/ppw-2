<?php

use App\Http\Controllers\KamarController;
use App\Http\Controllers\UserController;
use App\Models\Kamar;
use Illuminate\Support\Facades\Route;

// Semua halaman di dalam grup ini hanya bisa dibuka setelah login.
Route::middleware('auth')->group(function () {

    Route::get('/', function () {
        return redirect()->route('kamar.index');
    });

    Route::get('/dashboard', function () {
        $totalKamar = Kamar::count();
        $kamarTersedia = Kamar::where('status', 'Tersedia')->count();
        $kamarTerisi = Kamar::where('status', 'Terisi')->count();

        return view('dashboard', compact(
            'totalKamar',
            'kamarTersedia',
            'kamarTerisi'
        ));
    })->name('dashboard');

    Route::resource('kamar', KamarController::class)->except('show');

    // Khusus admin: kelola data users.
    Route::middleware('admin')->group(function () {
        Route::resource('users', UserController::class)->except('show');
    });
});