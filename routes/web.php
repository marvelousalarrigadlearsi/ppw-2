<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KamarController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('kamar', KamarController::class);