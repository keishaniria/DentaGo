<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\pasien\pasien;
use App\Models\pasien\Reservasi;

class JadwalpemeriksaanController extends Controller
{
   public function index() {

      $user = auth()->user();
      $pasien = $user->pasien;

      $reservasi = Reservasi::with('pasien')
         ->where('id_pasien', $pasien->id)
         ->orderBy('tanggal_reservasi', 'desc')
         ->get();

      return view('pasien.jadwalpemeriksaan', compact('reservasi'));
   }

   public function show($id) {
      $user = auth()->user();
      $pasien = $user->pasien;
      
      $reservasi = Reservasi::with('pasien')
         ->where('id_pasien', $pasien->id)
         ->findOrFail($id);

      return view('pasien.detailreservasi', compact('reservasi'));
   }
}
