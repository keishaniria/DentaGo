<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\pasien\Pasien;
use App\Models\dokter\Jadwal;
use App\Models\pasien\Reservasi;
use App\Models\admin\Dokter;
use App\Models\Dokter\DokterJadwalPraktek;

class ReservasiController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $pasien = $user->pasien;

        if (!$pasien) {
            return redirect()->route('pasien.profilesaya')
                ->with('error', 'Silakan lengkapi data pasien terlebih dahulu.');
        }

         // Ambil jadwal dokter yang tidak lewat dari hari ini atau hari ini yang sudah dibuat oleh dokter
        $today = now()->toDateString();

        $jadwalDokter = DokterJadwalPraktek::whereDate('tanggal', '>=', $today)
            ->orderBy('tanggal', 'asc')
            ->orderBy('jam_mulai', 'asc')
            ->get();

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
            'jam' => 'required|date_format:H:i',
            'id_dokter' => 'required|exists:dokters,id',
        ]);

        $user = auth()->user();
        $pasien = $user->pasien;

        if (!$pasien->alamat || !$pasien->no_telepon) {
            return redirect()->route('pasien.reservasi')
                ->with('error', 'Silahkan lengkapi profil terlebih dahulu sebelum melakukan reservasi.');
        }

        Reservasi::create([
            'id_pasien' => $pasien->id,
            'id_dokter' => $request->id_dokter,
            'tanggal_reservasi' => $request->tanggal_reservasi,
            'jam' => $request->jam,
            'status' => 'Menunggu'
        ]);

        return redirect()->route('pasien.jadwalpemeriksaan')->with('success', 'Reservasi berhasil!');
    }

    /**public function mulai($id)
    {
        $r = Reservasi::findOrFail($id);
        $r->status = 'Proses';
        $r->save();

        Jadwal::updateOrCreate(
            ['id_reservasi' => $r->id],
            [
                'id_pasien' => $r->id_pasien,
                'id_dokter' => $r->id_dokter,
                'tanggal' => $r->tanggal_reservasi,
                'jam' => $r->jam,
                'jenis_pemeriksaan' => null,
                'status' => 'Proses',
            ]
        );

        return back()->with('success', 'Pemeriksaan telah dimulai');
    }


    public function selesai($id)
    {
        $r = Reservasi::findOrFail($id);
        $r->status = 'Selesai';
        $r->save();

        Jadwal::updateOrCreate(
            ['id_reservasi' => $r->id],
            [
                'id_pasien' => $r->id_pasien,
                'id_dokter' => $r->id_dokter,
                'tanggal' => $r->tanggal_reservasi,
                'jam' => $r->jam,
                'jenis_pemeriksaan' => null,
                'status' => 'Selesai',
            ]
        );

        return back()->with('success', 'Pemeriksaan telah dimulai');
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
    }**/
}
