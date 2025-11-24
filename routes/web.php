<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\DokterController;
use App\Http\Controllers\Admin\RiwayatController;
use App\Http\Controllers\AdminPasienController;
use App\Http\Controllers\Dokter\DashboardController as DokterDashboardController;
use App\Http\Controllers\Dokter\JadwalPemeriksaanController as DokterJadwalController;
use App\Http\Controllers\Dokter\JamPraktekController;
use App\Http\Controllers\Dokter\JadwalPemeriksaanController as JadwalPemeriksaanDokterController;
use App\Http\Controllers\Pasien\DashboardController as PasienDashboardController;
use App\Http\Controllers\dokter\LaporanController;
use App\Http\Controllers\Dokter\PasienController;
use App\Http\Controllers\Dokter\PemeriksaanController;
use App\Http\Controllers\Dokter\ProfilDokterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Pasien\ReservasiController;
use App\Http\Controllers\Pasien\JadwalpemeriksaanController as PasienJadwalController;
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

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');;

Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])
        ->name('admin.dashboard');
    Route::get('/dashboard', [AdminController::class, 'index'])
        ->name('admin.dashboard');

   Route::patch('/reservasi/{id}/status', [ReservasiController::class, 'updateStatus'])
        ->name('admin.reservasi.updateStatus');
   
   Route::get('/riwayat-pemeriksaan', [RiwayatController::class, 'index'])
         ->name('admin.pemeriksaan.index');
   Route::get('/riwayat-pemeriksaan/export-excel', [RiwayatController::class, 'exportXlsx'])
         ->name('admin.riwayat.export.xlsx');

    //dokter
   Route::get('/dokter', [DokterController::class, 'index'])
      ->name('admin.dokter.index');
   Route::get('/dokter/tambah-data', [DokterController::class, 'create'])
      ->name('admin.dokter.tambah-dokter');
   Route::post('/dokter/tambah-data', [DokterController::class, 'store'])
      ->name('admin.dokter.store');
   Route::get('/dokter/detail-dokter/{id}', [DokterController::class, 'show'])
         ->name('admin.dokter.detail');
   Route::get('/dokter/edit-dokter/{id}', [DokterController::class, 'edit'])
      ->name('admin.dokter.edit');
   Route::put('/dokter/edit-dokter/{id}', [DokterController::class, 'update'])
      ->name('admin.dokter.update');
   Route::get('/dokter/{id}', [DokterController::class, 'destroy'])
        ->name('admin.dokter.delete');

   //pasien
   Route::get('/pasien', [AdminPasienController::class, 'index'])
        ->name('admin.pasien.index');
   Route::get('/reservasi/{id}/cancelled', [AdminPasienController::class, 'cancel'])
        ->name('admin.pemeriksaan.cancel');
});

// Halaman Jadwal Pemeriksaan Dokter
Route::prefix('dokter')->group(function () {
   Route::get('/dashboard', [DokterDashboardController::class, 'index'])->name('dokter.dashboard');
   Route::get('/jadwal', [JadwalPemeriksaanDokterController::class, 'index'])->name('dokter.jadwal.index');
   Route::put('/jadwal/{id}/status', [DokterJadwalController::class, 'updateStatus'])->name('dokter.jadwal.updateStatus');
   Route::delete('/jadwal/{id}', [JadwalPemeriksaanDokterController::class, 'destroy'])->name('dokter.jadwal.destroy');
   Route::post('/store', [JamPraktekController::class, 'store'])->name('dokter.jadwal.store');

   Route::get('/profil', [ProfilDokterController::class, 'index'])->name('dokter.profil.index');

   Route::get('/pasien', [PasienController::class, 'index'])->name('dokter.pasien.index');
   Route::get('/pasien/{id}', [PasienController::class, 'show'])->where('id', '[0-9]+')->name('dokter.pasien.show');

   Route::get('/pasien/{id}/pemeriksaan/create', [PemeriksaanController::class, 'create'])->name('dokter.pemeriksaan.create');
   Route::post('/pasien/{id}/pemeriksaan', [PemeriksaanController::class, 'store'])->name('dokter.pemeriksaan.store');
   Route::get('/pemeriksaan/{id}/edit', [PemeriksaanController::class, 'edit'])->name('dokter.pemeriksaan.edit');
   Route::put('/pemeriksaan/{id}', [PemeriksaanController::class, 'update'])->name('dokter.pemeriksaan.update');


   Route::get('/laporan', [LaporanController::class, 'index'])->name('dokter.laporan.index');
   //Route::get('/laporan/{id}', [LaporanController::class, 'show'])->name('dokter.laporan.show');
   Route::get('/laporan/export', [LaporanController::class, 'exportExcel'])->name('dokter.laporan.export');
});

// Pasien Route
Route::get('/pasien/dashboard', [PasienDashboardController::class, 'index'])
   ->name('pasien.dashboard');

Route::prefix('pasien')->group(function () {
   Route::get('/reservasi', [ReservasiController::class, 'index'])
      ->name('pasien.reservasi');
   Route::post('/reservasi', [ReservasiController::class, 'store'])
      ->name('pasien.reservasi.store');
   Route::get('/jadwalpemeriksaan', [PasienJadwalController::class, 'index'])
      ->name('pasien.jadwalpemeriksaan');
   Route::get('/jadwalpemeriksaan{id}', [PasienJadwalController::class, 'show'])
      ->name('pasien.jadwalpemeriksaan.show');
      
   Route::get('/profilsaya', [ProfilController::class, 'index'])
   ->name('pasien.profilesaya');
   Route::get('/profil/edit', [ProfilController::class, 'edit'])
      ->name('pasien.editprofil');
   Route::put('/profil/update', [ProfilController::class, 'update'])
      ->name('pasien.updateprofil');
   Route::delete('/profil/hapus', [ProfilController::class, 'hapusAkun'])
      ->name('pasien.hapusakun');

   Route::get('/riwayatpemeriksaan', [RiwayatpemeriksaanController::class, 'index'])
      ->name('pasien.riwayatpemeriksaan');
   Route::get('riwayatpemeriksaan/{id}', [RiwayatpemeriksaanController::class, 'show'])
      ->name('pasien.riwayatpemeriksaan.detail');
});
