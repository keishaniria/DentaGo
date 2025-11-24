<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\dokter\Pemeriksaan;
use App\Models\pasien\Reservasi;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    //
    public function index() {
        $user = Auth::user();
        $pasien = $user->pasien;

        $pemeriksaanTerakhir = null;
        if($pasien) {
            $pemeriksaanTerakhir = Pemeriksaan::where('id_pasien', $pasien->id)
                ->latest()
                ->first();
        }

        $reservasiAktif = null;
        if($pasien) {
           $reservasiAktif = Reservasi::where('id_pasien', $pasien->id)
            ->whereIn('status', ['menunggu', 'proses'])
            ->whereDate('tanggal_reservasi', '>=', now()->toDateString())
            ->orderBy('tanggal_reservasi', 'asc')
            ->orderBy('jam', 'asc')
            ->first();
        }

        $totalReservasi = $pasien ? Reservasi::where('id_pasien', $pasien->id)->count() : 0;

        return view('pasien.dashboard', compact(
            'user',
            'pasien',
            'pemeriksaanTerakhir',
            'reservasiAktif',
            'totalReservasi'
        ));
    }
}
