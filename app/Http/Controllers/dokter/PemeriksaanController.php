<?php

namespace App\Http\Controllers\Dokter;

use App\Models\dokter\RiwayatPemeriksaan;
use App\Http\Controllers\Controller;
use App\Models\dokter\Pemeriksaan;
use App\Models\dokter\Pasien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class PemeriksaanController extends Controller
{
    public function create($id)
    {
        $pasien = Pasien::findOrFail($id);
        return view('dokter.pemeriksaan.create', compact('pasien'));
    }

    public function store(Request $request, $id)
    {
        $request->validate([
            'keluhan' => 'required|string',
            'diagnosa' => 'required|string',
            'tindakan' => 'required|string',
            'nama_obat' => 'nullable|array',
            'dosis' => 'nullable|array',
            'tanggal_pemeriksaan' => 'required|date',
            'foto_kondisi_gigi' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $pemeriksaan = new Pemeriksaan();
        $pemeriksaan->id_pasien = $id;
        $pemeriksaan->keluhan = $request->keluhan;
        $pemeriksaan->diagnosa = $request->diagnosa;
        $pemeriksaan->tindakan = $request->tindakan;

        $resepArray = [];

        if ($request->has('nama_obat') && is_array($request->nama_obat)) {

            foreach ($request->nama_obat as $index => $nama) {
                if ($nama !== null && $nama !== '') {
                    $resepArray[] = [
                        'nama' => $nama,
                        'dosis' => $request->dosis[$index] ?? ''
                    ];
                }
            }
        }

        $pemeriksaan->resep = count($resepArray) > 0
            ? json_encode($resepArray, JSON_UNESCAPED_UNICODE)
            : null;

        $pemeriksaan->tanggal_pemeriksaan = $request->tanggal_pemeriksaan;

        if ($request->hasFile('foto_kondisi_gigi')) {
            $pemeriksaan->foto_kondisi_gigi = $request->file('foto_kondisi_gigi')
                ->store('foto_gigi', 'public');
        }

        $pemeriksaan->id_dokter = 1;

        $pemeriksaan->save();

        RiwayatPemeriksaan::create([
            'id_pemeriksaan'      => $pemeriksaan->id,
            'id_pasien'           => $pemeriksaan->id_pasien,
            'id_dokter'           => 1,
            'keluhan'             => $pemeriksaan->keluhan,
            'diagnosa'            => $pemeriksaan->diagnosa,
            'tindakan'            => $pemeriksaan->tindakan,
            'resep'               => $pemeriksaan->resep,
            'tanggal_pemeriksaan' => $pemeriksaan->tanggal_pemeriksaan,
            'foto_kondisi_gigi'   => $pemeriksaan->foto_kondisi_gigi,
        ]);

        return redirect()
            ->route('dokter.pasien.show', $id)
            ->with('success', 'Data pemeriksaan berhasil ditambahkan ke riwayat pemeriksaan pasien!');
    }


    public function edit($id)
    {
        $pemeriksaan = Pemeriksaan::findOrFail($id);

        return view('dokter.pemeriksaan.edit', compact('pemeriksaan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'keluhan' => 'required|string',
            'diagnosa' => 'required|string',
            'tindakan' => 'required|string',
            'nama_obat' => 'nullable|array',
            'dosis' => 'nullable|array',
            'tanggal_pemeriksaan' => 'required|date',
            'foto_kondisi_gigi' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $pemeriksaan = Pemeriksaan::findOrFail($id);

        $pemeriksaan->keluhan = $request->keluhan;
        $pemeriksaan->diagnosa = $request->diagnosa;
        $pemeriksaan->tindakan = $request->tindakan;

        $resepArray = [];

        if ($request->has('nama_obat') && is_array($request->nama_obat)) {
            foreach ($request->nama_obat as $index => $nama) {
                if ($nama !== null && $nama !== '') {
                    $resepArray[] = [
                        'nama' => $nama,
                        'dosis' => $request->dosis[$index] ?? ''
                    ];
                }
            }
        }

        $pemeriksaan->resep = count($resepArray) > 0
            ? json_encode($resepArray, JSON_UNESCAPED_UNICODE)
            : null;

        $pemeriksaan->tanggal_pemeriksaan = $request->tanggal_pemeriksaan;

        if ($request->hasFile('foto_kondisi_gigi')) {
            // Hapus foto lama kalau ada
            if ($pemeriksaan->foto_kondisi_gigi && Storage::disk('public')->exists($pemeriksaan->foto_kondisi_gigi)) {
                Storage::disk('public')->delete($pemeriksaan->foto_kondisi_gigi);
            }

            // Simpan file baru
            $pemeriksaan->foto_kondisi_gigi = $request->file('foto_kondisi_gigi')
                ->store('foto_gigi', 'public');
        }

        $pemeriksaan->save();

        RiwayatPemeriksaan::updateOrCreate(
            ['id_pemeriksaan' => $pemeriksaan->id],
            [
                'id_pasien'           => $pemeriksaan->id_pasien,
                'id_dokter'           => $pemeriksaan->id_dokter,
                'keluhan'             => $pemeriksaan->keluhan,
                'diagnosa'            => $pemeriksaan->diagnosa,
                'tindakan'            => $pemeriksaan->tindakan,
                'resep'               => $pemeriksaan->resep,
                'tanggal_pemeriksaan' => $pemeriksaan->tanggal_pemeriksaan,
                'foto_kondisi_gigi'   => $pemeriksaan->foto_kondisi_gigi,
            ]
        );

        return redirect()
            ->route('dokter.pasien.show', $pemeriksaan->id_pasien)
            ->with('success', 'Data pemeriksaan pasien berhasil diperbarui!');
    }
}