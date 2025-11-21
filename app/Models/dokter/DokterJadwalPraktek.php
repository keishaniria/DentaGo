<?php

namespace App\Models\Dokter;

use Illuminate\Database\Eloquent\Model;

class DokterJadwalPraktek extends Model
{
    //
    protected $table = 'dokter_jadwal_praktek';

    protected $fillable = [
        'id_dokter',
        'tanggal',
        'jam_mulai',
        'jam_selesai'
    ];
}
