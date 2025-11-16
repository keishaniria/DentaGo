<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Pasien\DashboardController;
use App\Http\Controllers\Pasien\ReservasiController;
use App\Http\Controllers\Pasien\JadwalpemeriksaanController;
use App\Http\Controllers\Pasien\RiwayatpemeriksaanController;
use App\Http\Controllers\Pasien\ProfilController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/pasien/dashboard', [DashboardController::class, 'index'])
   ->name('pasien.dashboard');

Route::get('/pasien/reservasi', [ReservasiController::class, 'index'])
   ->name('pasien.reservasi');

Route::get('/pasien/jadwalpemeriksaan', [JadwalpemeriksaanController::class, 'index'])
   ->name('pasien.jadwalpemeriksaan');

Route::get('/pasien/riwayatpemeriksaan', [RiwayatpemeriksaanController::class, 'index'])
   ->name('pasien.riwayatpemeriksaan');

Route::get('/pasien/profilsaya', [ProfilController::class, 'index'])
   ->name('pasien.profilesaya');

Route::get('/edit-profil', [Profilcontroller::class, 'edit'])
    ->name('pasien.editprofil');