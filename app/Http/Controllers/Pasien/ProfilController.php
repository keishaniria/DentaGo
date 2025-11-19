<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pasien\Pasien;
use Illuminate\Support\Facades\Auth;

class ProfilController extends Controller
{
    public function index() {
        $user = Auth::user();

        if(!$user->pasien) {
            $user->pasien()->create([
                'nama_pasien' => $user->username,
                'jenis_kelamin' => null,
                'tanggal_lahir' => null,
                'alamat' => null,
                'no_telepon' => null,
                'foto_pasien' => null,
            ]);
        }

        $pasien = $user->pasien;
        return view('pasien.profilesaya', compact('user', 'pasien'));
    }

    public function edit() {
        $user = Auth::user();
        $pasien = $user->pasien;

        return view('pasien.editprofil', compact('user', 'pasien'));
    }

    public function update(Request $request) {
        $user = Auth::user();
        $pasien = $user->pasien;

        $request->validate([
            'foto_pasien' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'nama_pasien' => 'required|string|max:100',
            'tanggal_lahir' => 'nullable|date',
            'jenis_kelamin' => 'nullable|string',
            'alamat' => 'nullable|string',
            'no_telepon' => 'nullable|string|max:15',
        ]);

        if($request->hasFile('foto_pasien')) {
            if($pasien->foto_pasien && \Storage::exists('public/'.$pasien->foto_pasien)) {
                \Storage::delete('public/'.$pasien->foto_pasien);
            }

            $foto = $request->file('foto_pasien')->store('foto_pasien', 'public');
            $pasien->foto_pasien = $foto;
        }

        $pasien->nama_pasien = $request->nama_pasien;
        $pasien->tanggal_lahir = $request->tanggal_lahir;
        $pasien->jenis_kelamin = $request->jenis_kelamin;
        $pasien->alamat = $request->alamat;
        $pasien->no_telepon = $request->no_telepon;

        $pasien->save();

        return redirect()->route('pasien.profilesaya');
    }
}
