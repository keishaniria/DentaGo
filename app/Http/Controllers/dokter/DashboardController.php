<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function index()
    {
        $data = [
            'pasien_hari_ini' => 12,
            'jadwal_hari_ini' => 5,
            'reservasi_menunggu' => 3,
        ];

        return view('dokter.dashboard', compact('data'));
    }
}
