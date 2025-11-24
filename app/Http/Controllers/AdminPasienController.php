<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pasien\Reservasi;
use App\Models\Dokter\DokterJadwalPraktek;

class AdminPasienController extends Controller
{
    //
    public function index()
    {
        $today = now()->toDateString();

        $reservasi = Reservasi::with('pasien')
            ->whereDate('created_at', $today)
            ->where('status', '!=', 'Batal')
            ->get();

        return view('admin.pasien.index', compact('reservasi'));
    }


    public function cancel($id)
    {
        $reservasi = Reservasi::findOrFail($id);

        $reservasi->status = 'Batal';
        $reservasi->save();

        return redirect()->back()->with('success', 'Reservasi berhasil dibatalkan.');
    }

}
