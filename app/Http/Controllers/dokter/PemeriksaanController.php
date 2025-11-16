<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\Dokter\Pemeriksaan;
use App\Models\Dokter\Pasien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class PemeriksaanController extends Controller
{
    public function create($id_pasien)
    {
        $pasien = Pasien::findOrFail($id_pasien);
        return view('dokter.pemeriksaan.create', compact('pasien'));
    }

    public function store(Request $request, $id)
    {
        $request->validate([
            'keluhan' => 'required|string',
            'diagnosa' => 'required|string',
            'tindakan' => 'required|string',
            'nama_obat' => 'array',
            'dosis' => 'array',
            'tanggal_pemeriksaan' => 'required|date',
            'foto_kondisi_gigi' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $pemeriksaan = new Pemeriksaan();
        $pemeriksaan->id_pasien = $id;
        $pemeriksaan->keluhan = $request->keluhan;
        $pemeriksaan->diagnosa = $request->diagnosa;
        $pemeriksaan->tindakan = $request->tindakan;

        if ($request->nama_obat) {
            $resepArray = [];
            foreach ($request->nama_obat as $index => $nama) {
                $resepArray[] = [
                    'nama' => $nama,
                    'dosis' => $request->dosis[$index] ?? ''
                ];
            }
            $pemeriksaan->resep = json_encode($resepArray);
        }

        $pemeriksaan->tanggal_pemeriksaan = $request->tanggal_pemeriksaan;

        if ($request->hasFile('foto_kondisi_gigi')) {
            $file = $request->file('foto_kondisi_gigi');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/foto_gigi', $filename);
            $pemeriksaan->foto_kondisi_gigi = $filename;
        }

        $pemeriksaan->save();

        return redirect()
            ->route('dokter.pasien.show', $id)
            ->with('success', 'Data pemeriksaan berhasil disimpan!');
    }


    public function edit($id)
    {
        $dummyPemeriksaan = [
            'id' => 1,
            'keluhan' => 'Demam',
            'diagnosa' => 'Flu',
            'tindakan' => 'Istirahat',
            'tanggal_pemeriksaan' => '2025-01-10',
            'foto_kondisi_gigi' => null,
            'resep' => [
                ['nama' => 'Paracetamol', 'dosis' => '500mg']
            ]
        ];

        $pemeriksaan = json_decode(json_encode($dummyPemeriksaan));

        return view('dokter.pemeriksaan.edit', compact('pemeriksaan'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'keluhan' => 'required|string',
            'diagnosa' => 'required|string',
            'tindakan' => 'required|string',
            'nama_obat' => 'array',
            'dosis' => 'array',
            'tanggal_pemeriksaan' => 'required|date',
            'foto_kondisi_gigi' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $pemeriksaan = Pemeriksaan::findOrFail($id);

        $pemeriksaan->keluhan = $request->keluhan;
        $pemeriksaan->diagnosa = $request->diagnosa;
        $pemeriksaan->tindakan = $request->tindakan;

        if ($request->nama_obat) {
            $resepArray = [];
            foreach ($request->nama_obat as $index => $nama) {
                $resepArray[] = [
                    'nama' => $nama,
                    'dosis' => $request->dosis[$index] ?? ''
                ];
            }
            $pemeriksaan->resep = json_encode($resepArray);
        }

        $pemeriksaan->tanggal_pemeriksaan = $request->tanggal_pemeriksaan;

        if ($request->hasFile('foto_kondisi_gigi')) {
            if (
                $pemeriksaan->foto_kondisi_gigi &&
                Storage::exists('public/foto_gigi/' . $pemeriksaan->foto_kondisi_gigi)
            ) {
                Storage::delete('public/foto_gigi/' . $pemeriksaan->foto_kondisi_gigi);
            }

            $file = $request->file('foto_kondisi_gigi');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/foto_gigi', $filename);
            $pemeriksaan->foto_kondisi_gigi = $filename;
        }

        $pemeriksaan->save();

        return redirect()
            ->route('dokter.pasien.show', $pemeriksaan->id_pasien)
            ->with('success', 'Data pemeriksaan berhasil diperbarui!');
    }

    
}
