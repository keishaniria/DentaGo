<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pasien\Reservasi;
use App\Models\Dokter\DokterJadwalPraktek;

class JamPraktekController extends Controller
{
    //
     public function index()
    {
        $jadwalPraktek = DokterJadwalPraktek::where('id_dokter', auth()->id())
            ->orderBy('tanggal', 'asc')
            ->orderBy('jam_mulai', 'asc')
            ->get();

        $reservasi = Reservasi::where('id_dokter', auth()->id())
            ->with('pasien')
            ->orderBy('tanggal', 'asc')
            ->orderBy('jam', 'asc')
            ->get();

        return view('dokter.jadwal.index', compact('jadwalPraktek', 'reservasi'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required|after:jam_mulai',
        ]);

        DokterJadwalPraktek::create([
            'id_dokter' => auth()->user()->dokter->id,
            'tanggal' => $request->tanggal,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
        ]);

        return redirect()->back()->with('success', 'Jam praktek berhasil ditambahkan!');
    }
}
