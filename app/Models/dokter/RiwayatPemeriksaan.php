<?php

namespace App\Models\dokter;

use Illuminate\Database\Eloquent\Model;

class RiwayatPemeriksaan extends Model
{
    //
    protected $table = 'riwayat_pemeriksaan';

    protected $fillable = [
        'id_pemeriksaan',
        'id_pasien',
        'id_dokter',
        'keluhan',
        'diagnosa',
        'tindakan',
        'resep',
        'tanggal_pemeriksaan',
        'foto_kondisi_gigi',
    ];

    protected $casts = [
        'resep' => 'array',
    ];

    public function pasien()
    {
        return $this->belongsTo(Pasien::class, 'id_pasien');
    }
}
