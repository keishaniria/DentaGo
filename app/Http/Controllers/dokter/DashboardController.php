<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\dokter\Jadwal;
use App\Models\dokter\Pemeriksaan;
use App\Models\pasien\Pasien;
use App\Models\pasien\Reservasi;

class DashboardController extends Controller
{
    public function index()
    {
        $today = now()->toDateString();

        $data = [
            'pasien_hari_ini' => Pemeriksaan::whereDate('tanggal_pemeriksaan', $today)->count(),
            'jadwal_hari_ini' => Jadwal::whereDate('tanggal', $today)->count(),
            'total_pasien' => Pasien::count(),

        ];

        return view('dokter.dashboard', compact('data'));
    }
}
