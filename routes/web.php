<?php

use App\Http\Controllers\KamarController;
use App\Http\Controllers\UserController;
use App\Models\Kamar;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {

    Route::get('/', function () {
        return redirect()->route('dashboard');
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

    // Semua user yang login: hanya melihat daftar & ketersediaan kamar.
    Route::get('/kamar', [KamarController::class, 'index'])->name('kamar.index');

    // Khusus admin: kelola kamar dan users.
    Route::middleware('admin')->group(function () {
        Route::resource('kamar', KamarController::class)->except(['index', 'show']);
        Route::resource('users', UserController::class)->except('show');
    });
});