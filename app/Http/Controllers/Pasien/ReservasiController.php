<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pasien\Pasien;
use App\Models\Pasien\Reservasi;

class ReservasiController extends Controller
{
    //
    public function index() {
        return view('pasien.reservasi');
    }

    public function store(Request $request) {

        $request->validate([
            'nama_pasien' => 'required|string|max:100',
            'alamat' => 'required|string',
            'tanggal_reservasi' => 'required|date',
            'jam' => 'required',
            'no_telepon' => 'required|string|max:20'      
        ]);

        $pasien = Pasien::create([
            'nama_pasien' => $request->nama_pasien,
            'alamat' => $request->alamat,
            'no_telepon' => $request->no_telepon
        ]);

        Reservasi::create([
            'id_pasien' => $pasien->id,
            'tanggal_reservasi' => $request->tanggal_reservasi,
            'jam' => $request->jam,
            'status' => 'menunggu'
        ]);

        return redirect()->route('pasien.jadwalpemeriksaan');
    }
}
