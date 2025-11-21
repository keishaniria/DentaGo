<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pasien\Pasien;
use App\Models\Pasien\Reservasi;
use App\Models\Dokter\DokterJadwalPraktek;

class ReservasiController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $pasien = $user->pasien;

        // Ambil daftar jadwal dokter yang tersedia
        $jadwalDokter = DokterJadwalPraktek::orderBy('tanggal', 'asc')
            ->orderBy('jam_mulai', 'asc')
            ->get();

        // Ambil daftar reservasi pasien
        $reservasi = Reservasi::where('id_pasien', $pasien->id)
            ->orderBy('tanggal_reservasi', 'desc')
            ->get();

        return view('pasien.reservasi', [
            'pasien' => $pasien,
            'reservasi' => $reservasi,
            'jadwalDokter' => $jadwalDokter
        ]);
    }

    public function store(Request $request)
    {
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
            'status' => 'Menunggu'
        ]);

        return redirect()->route('pasien.jadwalpemeriksaan');
    }

    public function mulai($id)
    {
        $r = Reservasi::findOrFail($id);
        $r->status = 'Proses';
        $r->save();

        return back()->with('success', 'Pemeriksaan telah dimulai');
    }

    public function selesai($id)
    {
        $r = Reservasi::findOrFail($id);
        $r->status = 'Selesai';
        $r->save();

        return back()->with('success', 'Pemeriksaan selesai');
    }

    public function batal($id)
    {
        $r = Reservasi::findOrFail($id);
        
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Anda tidak memiliki akses.');
        }

        $r->status = 'Batal';
        $r->save();

        return back()->with('success', 'Reservasi dibatalkan');
    }
}
