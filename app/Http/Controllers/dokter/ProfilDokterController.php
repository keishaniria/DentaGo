<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfilDokterController extends Controller
{
    //
    public function index()
    {
        $user = Auth::user(); 

        return view('dokter.profil.index', compact('user'));
    }
}
