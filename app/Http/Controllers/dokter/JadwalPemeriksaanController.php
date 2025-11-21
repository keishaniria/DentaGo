<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\Dokter\Jadwal;
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
        $jadwal->status = $request->status;
        $jadwal->save();

        return redirect()->back()->with('success', 'Status jadwal berhasil diperbarui!');
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
