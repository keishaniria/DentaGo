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
        $jadwal = Jadwal::orderBy('jam', 'asc')->get();
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

        if ($jadwal->status === 'Selesai') {
            $jadwal->delete();
            return redirect()->back()->with('success', 'Jadwal berhasil dihapus!');
        }

        return redirect()->back()->with('error', 'Hanya jadwal dengan status "Selesai" yang bisa dihapus.');
    }
}
