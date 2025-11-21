<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pasien\Reservasi;

class AdminController extends Controller
{
    //
    public function index()
    {
        $reservasi = Reservasi::with(['pasien', 'dokter'])
            ->orderBy('tanggal_reservasi', 'desc')
            ->get();

        return view('admin.layout.dashboard', compact('reservasi'));
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
