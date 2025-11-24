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
        $jadwal = Jadwal::with('pasien')
            ->orderBy('jam', 'asc')
            ->get();

        return view('dokter.jadwal.index', compact('jadwal'));
    }

    public function updateStatus(Request $request, $id)
    {
        $jadwal = Jadwal::findOrFail($id);

        // Update status di jadwal
        $jadwal->status = $request->status;
        $jadwal->save();

        // Update reservasi juga
        if ($jadwal->id_reservasi) {
            $reservasi = Reservasi::find($jadwal->id_reservasi);
            if ($reservasi) {
                $reservasi->status = $request->status;
                $reservasi->save(); // ← ini MEMICU event updated() → jadwal ikut update otomatis
            }
        }

        return back()->with('success', 'Status berhasil diubah!');
    }

    public function destroy($id)
    {
        $jadwal = Jadwal::findOrFail($id);

        if ($jadwal->status !== 'Selesai') {
            return redirect()->back();
        }

        $jadwal->delete();
        return redirect()->back()->with('success', 'Jadwal pemeriksaan pasien dengan status Selesai berhasil dihapus!');
    }
}
