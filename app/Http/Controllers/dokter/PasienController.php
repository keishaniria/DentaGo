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
        $pasien = [
            [
                'id' => 1,
                'nama_pasien' => 'Dwi Rahma',
                'jenis_kelamin' => 'Perempuan',
                'tanggal_lahir' => '1998-07-10',
                'no_telepon' => '081234567890',
                'alamat' => 'Jl. Melati No. 12, Bandung',
                'foto_pasien' => 'default.jpg',
            ],
            [
                'id' => 2,
                'nama_pasien' => 'Farhan Yusuf',
                'jenis_kelamin' => 'Laki-laki',
                'tanggal_lahir' => '1995-04-22',
                'no_telepon' => '082233445566',
                'alamat' => 'Jl. Melati No. 44, Bandung',
                'foto_pasien' => 'default.jpg',
            ],
        ];

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
