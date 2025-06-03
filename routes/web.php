<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\KategoriKelasController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\MapelController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // kategori kelas
    Route::resource('kategori_kelas', KategoriKelasController::class)->except(['update']);
    Route::put('kategori_kelas/{id}', [KategoriKelasController::class, 'update'])->name('kategori_kelas.update');

    // kelas
    Route::resource('kelas', KelasController::class);

    // guru
    Route::resource('guru', GuruController::class);
    Route::get('/guru/create', [GuruController::class, 'create'])->name('guru.create');

    // mapel
    Route::resource('mapel', MapelController::class);
     Route::get('/mapel/create', [MapelController::class, 'create'])->name('mapel.create');


});

Route::get('/', function () {
    return view('welcome');
});
