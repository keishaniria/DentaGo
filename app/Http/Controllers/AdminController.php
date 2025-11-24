<?php

namespace App\Http\Controllers;

use App\Models\admin\Dokter;
use App\Models\dokter\Pasien;
use App\Models\dokter\Pemeriksaan;
use Illuminate\Http\Request;
use App\Models\Pasien\Reservasi;

class AdminController extends Controller
{
    //
    public function index()
    {
        $statusReservasi = [
            'Menunggu' => Reservasi::where('status', 'Menunggu')->count(),
            'Proses' => Reservasi::where('status', 'Proses')->count(),
            'Selesai' => Reservasi::where('status', 'Selesai')->count(),
            'Batal' => Reservasi::where('status', 'Batal')->count(),
        ];
        $today = now()->toDateString();

        $data = [
            'total_pasien' => Pasien::count(),
            'total_dokter' => Dokter::count(),
            'pasien_hari_ini' => Pemeriksaan::whereDate('tanggal_pemeriksaan', $today)->count(),
            'total_pemeriksaan' => Pemeriksaan::count(),
            'status_pasien' => $statusReservasi,

        ];

        return view('admin.dashboard', compact('data'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Menunggu,Proses,Selesai,Batal',
        ]);

        $reservasi = Reservasi::findOrFail($id);
        $reservasi->status = $request->status;
        $reservasi->save();

        return back()->with('success', 'Status reservasi berhasil diperbarui.');
    }

}
