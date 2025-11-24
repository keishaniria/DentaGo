<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\dokter\Jadwal;
use App\Models\dokter\Pemeriksaan;
use App\Models\pasien\Pasien;

class DashboardController extends Controller
{
    public function index()
    {
        $today = now()->toDateString();

        $data = [
            'pemeriksaan_hari_ini' => Pemeriksaan::whereDate('tanggal_pemeriksaan', $today)->count(),
            'jadwal_hari_ini' => Jadwal::whereDate('tanggal', $today)->count(),
            'total_pasien' => Pasien::count(),

        ];

        return view('dokter.dashboard', compact('data'));
    }
}
