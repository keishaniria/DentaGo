<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\dokter\Pemeriksaan;

class RiwayatpemeriksaanController extends Controller
{
    public function index() {
       $user = Auth::user();
       $riwayat = $user->pasien ? $user->pasien->pemeriksaan()->latest()->get() : [];

       return view('pasien.riwayatpemeriksaan', compact('riwayat'));
    }

    public function show($id) {
        $pemeriksaan = Pemeriksaan::findOrFail($id);
        return view('pasien.detailpemeriksaan', compact('pemeriksaan'));
    }
}
