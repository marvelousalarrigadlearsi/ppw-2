<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KamarController;
use App\Models\Kamar;

Route::get('/', function () {
    return redirect()->route('kamar.index');
});

Route::get('/kamar', [KamarController::class, 'index'])
    ->name('kamar.index');

Route::get('/kamar/create', [KamarController::class, 'create'])
    ->name('kamar.create');

Route::post('/kamar', [KamarController::class, 'store'])
    ->name('kamar.store');

Route::get('/kamar/{id}/edit', [KamarController::class, 'edit'])
    ->name('kamar.edit');

Route::put('/kamar/{id}', [KamarController::class, 'update'])
    ->name('kamar.update');

Route::delete('/kamar/{id}', [KamarController::class, 'destroy'])
    ->name('kamar.destroy');               
Route::delete('/kamar/{id}', [KamarController::class, 'destroy'])
    ->name('kamar.destroy');

Route::get('/', function () {
    return redirect()->route('dashboard');
})->middleware('auth');

Route::get('/dashboard', function () {
    $totalKamar = Kamar::count();
    $kamarTersedia = Kamar::where('status', 'Tersedia')->count();
    $kamarTerisi = Kamar::where('status', 'Terisi')->count();

    return view('dashboard', compact(
        'totalKamar',
        'kamarTersedia',
        'kamarTerisi'
    ));
})->middleware('auth')->name('dashboard');

Route::resource('kamar', KamarController::class)->middleware('auth');