<?php

use App\Http\Controllers\BobotController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\SpkController;
use App\Http\Controllers\SupplierController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
// use Livewire\Livewire;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('beranda');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/tentang', function () {
        return view('tentang.main');
    })->name('tentang');

    Route::prefix('spk')->group(function () {
        Route::get('/', [SpkController::class, 'index'])->name('spk.index');

        // Kriteria
        Route::get('/kriteria', [KriteriaController::class, 'index'])->name('kriteria.index');
        Route::post('/kriteria', [KriteriaController::class, 'store'])->name('kriteria.store');
        Route::delete('/kriteria/{id}', [KriteriaController::class, 'destroy'])->name('kriteria.destroy');

        // Bobot
        Route::get('/bobot', [BobotController::class, 'index'])->name('bobot.index');
        Route::post('/bobot', [BobotController::class, 'store'])->name('bobot.store');
        Route::get('/bobot/{id}/edit', [BobotController::class, 'edit'])->name('bobot.edit');
        Route::put('/bobot/{id}', [BobotController::class, 'update'])->name('bobot.update');

        // Supplier
        Route::get('/supplier', [SupplierController::class, 'index'])->name('supplier.index');
        Route::post('/supplier', [SupplierController::class, 'store'])->name('supplier.store');
        Route::get('/skor-utilitas', [SupplierController::class, 'skorUtilitas'])->name('supplier.skorUtilitas');

        // SPK
        Route::get('/nilai-kriteria', [SpkController::class, 'nilaiKriteria'])->name('spk.nilai-kriteria');
        Route::get('/normalisasi', [SpkController::class, 'normalisasi'])->name('spk.normalisasi');
        Route::get('/normalisasi/{supplierID}', [SpkController::class, 'normalisasiSupplier'])->name('spk.normalisasi.supplier');
        Route::get('/supplier-terbaik', [SpkController::class, 'supplierTerbaik'])->name('spk.supplier-terbaik');
        Route::get('/cetak-laporan', [SpkController::class, 'cetakLaporan'])->name('spk.cetak-laporan');
    });
});
