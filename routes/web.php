<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Dokter\DashboardController as DokterDashboardController;
use App\Http\Controllers\Dokter\JadwalPemeriksaanController as JadwalPemeriksaanDokterController;
use App\Http\Controllers\Pasien\DashboardController as PasienDashboardController;
use App\Http\Controllers\dokter\LaporanController;
use App\Http\Controllers\Dokter\PasienController;
use App\Http\Controllers\Dokter\PemeriksaanController;
use App\Http\Controllers\Dokter\ProfilDokterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Pasien\ReservasiController;
use App\Http\Controllers\Pasien\JadwalpemeriksaanController as JadwalPemeriksaanPasienController;
use App\Http\Controllers\Pasien\RiwayatpemeriksaanController;
use App\Http\Controllers\Pasien\ProfilController;
use App\Http\Controllers\AuthController;


Route::get('/', function () {

    return view('sign-in');
});

Route::get('/sign-up', [AuthController::class, 'showSignup'])->name('signup.show');
Route::post('/sign-up/submit', [AuthController::class, 'submitSignup'])->name('signup.submit');

Route::get('/sign-in', [AuthController::class, 'showSignin'])->name('login.show');
Route::post('/sign-in/submit', [AuthController::class, 'submitSignin'])->name('login.submit');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::prefix('admin')->group(function () {
   Route::get('/dashboard/dashboard', [AdminController::class, 'index'])->name('admin.layout.dashboard');
});

Route::prefix('dokter')->group(function () {
   Route::get('/dashboard', [DokterDashboardController::class, 'index'])->name('dokter.dashboard');
   Route::get('/jadwal', [JadwalPemeriksaanDokterController::class, 'index'])->name('dokter.jadwal.index');
   Route::post('/jadwal/update-status/{id}', [JadwalPemeriksaanController::class, 'updateStatus'])->name('dokter.jadwal.updateStatus');
   Route::delete('/jadwal/{id}', [JadwalPemeriksaanController::class, 'destroy'])->name('dokter.jadwal.destroy');

   Route::get('/profil', [ProfilDokterController::class, 'index'])->name('dokter.profil.index');

   Route::get('/pasien', [PasienController::class, 'index'])->name('dokter.pasien.index');
   Route::get('/pasien/{id}', [PasienController::class, 'show'])->where('id', '[0-9]+')->name('dokter.pasien.show');

   Route::get('/pasien/{id}/pemeriksaan/create', [PemeriksaanController::class, 'create'])->name('dokter.pemeriksaan.create');
   Route::post('/pasien/{id}/pemeriksaan', [PemeriksaanController::class, 'store'])->name('dokter.pemeriksaan.store');
   Route::get('/pemeriksaan/{id}/edit', [PemeriksaanController::class, 'edit'])->name('dokter.pemeriksaan.edit');
   Route::put('/pemeriksaan/{id}', [PemeriksaanController::class, 'update'])->name('dokter.pemeriksaan.update');


   Route::get('/laporan', [LaporanController::class, 'index'])->name('dokter.laporan.index');
   Route::get('/laporan/{id}', [LaporanController::class, 'show'])->name('dokter.laporan.show');
   Route::get('/laporan/{id}/export', [LaporanController::class, 'exportExcel'])->name('dokter.laporan.export');
});


Route::get('/pasien/dashboard', [PasienDashboardController::class, 'index'])
   ->name('pasien.dashboard');

Route::get('/pasien/reservasi', [ReservasiController::class, 'index'])
   ->name('pasien.reservasi');

Route::get('/pasien/jadwalpemeriksaan', [JadwalPemeriksaanPasienController::class, 'index'])
   ->name('pasien.jadwalpemeriksaan');

Route::get('/pasien/riwayatpemeriksaan', [RiwayatpemeriksaanController::class, 'index'])
   ->name('pasien.riwayatpemeriksaan');

Route::get('/pasien/profilsaya', [ProfilController::class, 'index'])
   ->name('pasien.profilesaya');

Route::get('/edit-profil', [Profilcontroller::class, 'edit'])

    ->name('pasien.editprofil');


