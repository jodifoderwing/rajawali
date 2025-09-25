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

Route::get('viewsupdf', [SUPDFController::class, 'viewsupdf'])->name('viewsupdf');

Route::get('refresh', [SUPDFController::class, 'refresh'])->name('refresh');

Route::get('/berkas/print-spp/{id}', [PrintSPPController::class, 'cetakSPP'])->name('berkas.print-spp');

Route::get('/berkas/print-sbp/{id}', [PrintSPPController::class, 'cetakSBP'])->name('berkas.print-sbp');

Route::get('/berkas/print-formulirsurvey/{id}', [PrintSPPController::class, 'cetakFormulirSurvey'])->name('berkas.print-formulirsurvey');

Route::get('/berkas/print-hasilsurvey/{id}', [PrintSPPController::class, 'cetakHasilSurvey'])->name('berkas.print-hasilsurvey');

Route::get('/peta-survey/{id}', [PetaController::class, 'showPetaSurvey'])->name('peta-survey');

Route::get('/berkas/print-serat/{id}', [PrintSPPController::class, 'cetakSerat'])->name('berkas.print-serat');

Route::get('/berkas/print-warkah/{id}', [PrintSPPController::class, 'cetakWarkah'])->name('berkas.print-warkah');

Route::get('/berkas/print-serah/{id}', [PrintSPPController::class, 'cetakSerah'])->name('berkas.print-serah');
