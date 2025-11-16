<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RiwayatpemeriksaanController extends Controller
{
    public function index() {
        return view('pasien.riwayatpemeriksaan');
    }
}
