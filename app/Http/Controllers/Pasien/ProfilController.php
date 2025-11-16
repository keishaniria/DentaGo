<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfilController extends Controller
{
    public function index() {
        return view('pasien.profilesaya');
    }

    public function edit() {
        return view('pasien.editprofil');
    }
}
