<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\pasien\pasien;

class ProfilController extends Controller
{
    public function index() {

        $profil = pasien::all();
        return view('pasien.profilesaya', compact('profil'));
    }

    public function show() {
        return view('pasien.editprofil');
    }
}
