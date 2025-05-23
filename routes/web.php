<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KategoriKelasController;
use App\Http\Controllers\KelasController;

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::resource('kategori_kelas', KategoriKelasController::class)->except(['update']);
Route::put('kategori_kelas/{id}', [KategoriKelasController::class, 'update'])->name('kategori_kelas.update');

Route::resource('kelas', KelasController::class);




Route::get('/' , function(){
    return view('welcome');
});

