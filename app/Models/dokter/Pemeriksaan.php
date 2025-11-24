<?php

namespace App\Models\dokter;

use App\Models\admin\Dokter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
use App\Models\Pasien\Pasien;

class Pemeriksaan extends Model
{
    //
    use HasFactory;

    protected $fillable = [
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

    public function dokter()
    {
        return $this->belongsTo(Dokter::class, 'id_dokter');
    }

    public function getJenisPemeriksaanAttribute()
    {
        return $this->tindakan ?? '-';
    }
}
