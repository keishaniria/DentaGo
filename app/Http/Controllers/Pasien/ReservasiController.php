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
        $user = auth()->user();
        $pasien = $user->pasien;

        if (!$pasien->alamat || !$pasien->no_telepon) {
            return redirect()->route('pasien.reservasi') 
                     ->with('error', 'Silahkan lengkapi profil terlebih dahulu sebelum melakukan reservasi.');
        }
        
        $request->validate([
            'tanggal_reservasi' => 'required|date', 
            'jam' => 'required|date_format:H:i|after_or_equal:07:00|before_or_equal:16:00',
            'status' => 'nullable|string|in:menunggu,proses,selesai,batal'
        ]);

        Reservasi::create([
            'id_pasien' => $pasien->id,
            'tanggal_reservasi' => $request->tanggal_reservasi,
            'jam' => $request->jam,
            'status' => 'menunggu'
        ]);

       return redirect()->route('pasien.jadwalpemeriksaan')->with('success', 'Reservasi berhasil!');
    }
}
