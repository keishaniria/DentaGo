<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\pasien\pasien;
use App\Models\pasien\reservasi;

class JadwalpemeriksaanController extends Controller
{
    public function index() {
        $reservasi = Reservasi::with('pasien')->get();
        return view('pasien.jadwalpemeriksaan', compact('reservasi'));
    }
    
    public function show($id) {
        $reservasi = Reservasi::with('pasien')->findOrFail($id);
        return view('pasien.detailreservasi', compact('reservasi'));
    }
}
