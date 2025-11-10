<?php

use App\Http\Controllers\PetaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SUPDFController;
use App\Http\Controllers\PrintSPPController;

Route::get('/', function () {
    // return view('welcome');
    return redirect(route('filament.user.auth.login'));
});

// Route::get('download', function () {
//     return 'Latihan Laporan PDF';
// })->name('download.tes');
