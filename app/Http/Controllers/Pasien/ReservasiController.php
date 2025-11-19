<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pasien\Pasien;
use App\Models\Pasien\Reservasi;

class ReservasiController extends Controller
{
    public function index() {
        $user = auth()->user();
        $pasien = $user->pasien;

        $reservasi = Reservasi::where('id_pasien', $pasien->id)->orderBy('tanggal_reservasi', 'desc')->get();

        return view('pasien.reservasi', [
            'pasien' => $pasien,
            'reservasi' => $reservasi
        ]);
    }

    public function store(Request $request) {
        $request->validate([
            'tanggal_reservasi' => 'required|date', 
            'jam' => 'required',
            'status' => 'nullable|string|in:menunggu,proses,selesai,batal'
        ]);

        $user = auth()->user();
        $pasien = $user->pasien;

        Reservasi::create([
            'id_pasien' => $pasien->id,
            'tanggal_reservasi' => $request->tanggal_reservasi,
            'jam' => $request->jam,
            'status' => 'menunggu'
        ]);

        return redirect()->route('pasien.jadwalpemeriksaan');
    }
}
