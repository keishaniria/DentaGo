<?php

namespace App\Models\dokter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'nama_pasien',
        'jam',
        'jenis_pemeriksaan',
        'status',
    ];
}
