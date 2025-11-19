<?php
use App\Http\Controllers\Dokter\DashboardController as DokterDashboardController;
use App\Http\Controllers\Dokter\JadwalPemeriksaanController as DokterJadwalController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Dokter\JadwalPemeriksaanController as JadwalPemeriksaanDokterController;
use App\Http\Controllers\dokter\LaporanController;
use App\Http\Controllers\Dokter\PasienController;
use App\Http\Controllers\Dokter\PemeriksaanController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Pasien\DashboardController as PasienDashboardController;
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

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/dokter/dashboard', [DokterDashboardController::class, 'index'])
    ->name('dokter.dashboard');

Route::prefix('admin')->group(function () {
   Route::get('/dashboard/dashboard', [AdminController::class, 'index'])->name('admin.layout.dashboard');
});

// Halaman Jadwal Pemeriksaan Dokter
Route::prefix('dokter')->group(function () {
    Route::get('/jadwal', [DokterJadwalController::class, 'index'])->name('dokter.jadwal.index');
    Route::post('/jadwal/update-status/{id}', [JadwalPemeriksaanController::class, 'updateStatus'])->name('dokter.jadwal.updateStatus');
    Route::delete('/jadwal/{id}', [JadwalPemeriksaanController::class, 'destroy'])->name('dokter.jadwal.destroy');
    Route::get('/jadwal', [JadwalPemeriksaanDokterController::class, 'index'])->name('dokter.jadwal.index');
    Route::post('/jadwal/update-status/{id}', [JadwalPemeriksaanDokterController::class, 'updateStatus'])->name('dokter.jadwal.updateStatus');
    Route::delete('/jadwal/{id}', [JadwalPemeriksaanDokterController::class, 'destroy'])->name('dokter.jadwal.destroy');

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

      Route::get('/riwayatpemeriksaan', [RiwayatpemeriksaanController::class, 'index'])
         ->name('pasien.riwayatpemeriksaan');
});

