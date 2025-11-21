<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\Dokter\Pasien;
use Illuminate\Http\Request;

class PasienController extends Controller
{
    //
    public function index()
    {
        $pasien = Pasien::orderBy('nama_pasien', 'asc')->get();

        return view('dokter.pasien.index', compact('pasien'));
    }

    public function show($id)
    {
        $pasien = Pasien::with('riwayatPemeriksaan')->findOrFail($id);

        return view('dokter.pasien.show', [
            'pasien' => $pasien,
            'pemeriksaan' => $pasien->riwayatPemeriksaan
        ]);
    }
}
