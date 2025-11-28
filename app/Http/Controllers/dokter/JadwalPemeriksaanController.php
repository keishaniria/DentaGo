<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\Dokter\Jadwal;
use App\Models\Pasien\Reservasi;
use Illuminate\Http\Request;

class JadwalPemeriksaanController extends Controller
{
    //
    public function index()
    {
        $dokter = auth()->user()->dokter; 

        $jadwal = Jadwal::with('pasien')
            ->where('id_dokter', $dokter->id)
            ->orderBy('jam', 'asc')
            ->get();

        return view('dokter.jadwal.index', compact('jadwal'));
    }

    public function updateStatus(Request $request, $id)
    {
        $jadwal = Jadwal::findOrFail($id);

        $jadwal->status = $request->status;
        $jadwal->save();

        if ($jadwal->id_reservasi) {
            $reservasi = Reservasi::find($jadwal->id_reservasi);
            if ($reservasi) {
                $reservasi->status = $request->status;
                $reservasi->save();
            }
        }

        return back()->with('success', 'Status berhasil diubah!');
    }

    public function destroy($id)
    {
        $jadwal = Jadwal::findOrFail($id);

        if (strtolower($jadwal->status) !== 'selesai') {
            return redirect()->back();
        }

        $jadwal->delete();
        return redirect()->back()->with('success', 'Jadwal pemeriksaan pasien dengan status Selesai berhasil dihapus!');
    }
}
