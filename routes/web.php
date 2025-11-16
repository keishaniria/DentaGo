<?php

use App\Http\Controllers\Dokter\DashboardController;
use App\Http\Controllers\Dokter\JadwalPemeriksaanController;
use App\Http\Controllers\dokter\LaporanController;
use App\Http\Controllers\Dokter\PasienController;
use App\Http\Controllers\Dokter\PemeriksaanController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Pasien\DashboardController;
use App\Http\Controllers\Pasien\ReservasiController;
use App\Http\Controllers\Pasien\JadwalpemeriksaanController;
use App\Http\Controllers\Pasien\RiwayatpemeriksaanController;
use App\Http\Controllers\Pasien\ProfilController;

Route::get('/', function () {
    return view('welcome');
});

<<<<<<< HEAD
Route::get('/dokter/dashboard', [DashboardController::class, 'index'])
    ->name('dokter.dashboard');

// Halaman Jadwal Pemeriksaan Dokter
Route::prefix('dokter')->group(function () {
    Route::get('/jadwal', [JadwalPemeriksaanController::class, 'index'])->name('dokter.jadwal.index');
    Route::post('/jadwal/update-status/{id}', [JadwalPemeriksaanController::class, 'updateStatus'])->name('dokter.jadwal.updateStatus');
    Route::delete('/jadwal/{id}', [JadwalPemeriksaanController::class, 'destroy'])->name('dokter.jadwal.destroy');

    Route::get('/pasien', [PasienController::class, 'index'])->name('dokter.pasien.index');
    Route::get('pasien/{id}', [PasienController::class, 'show'])->name('dokter.pasien.show');

    Route::get('/pasien/{id}/pemeriksaan/create', [PemeriksaanController::class, 'create'])->name('dokter.pemeriksaan.create');
    Route::post('/pasien/{id}/pemeriksaan', [PemeriksaanController::class, 'store'])->name('dokter.pemeriksaan.store');
    Route::get('/pemeriksaan/{id}/edit', [PemeriksaanController::class, 'edit'])->name('dokter.pemeriksaan.edit');
    Route::put('/pemeriksaan/{id}', [PemeriksaanController::class, 'update'])->name('dokter.pemeriksaan.update');


    Route::get('/laporan', [LaporanController::class, 'index'])->name('dokter.laporan.index');
    Route::get('/laporan/{id}', [LaporanController::class, 'show'])->name('dokter.laporan.show');
    Route::get('/laporan/export', [LaporanController::class, 'exportExcel'])->name('dokter.laporan.export');
});
=======
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
>>>>>>> a05e249da126686314d6e137d5d159d6466baf41
