<?php

namespace App\Models\dokter;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pasien extends Model
{
    //
    use HasFactory;

    protected $table = 'pasiens';

    protected $fillable = [
        'nama_pasien',
        'jenis_kelamin',
        'tanggal_lahir',
        'no_telepon',
        'alamat',
        'foto_pasien',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
    ];

    // Relasi: satu pasien punya banyak pemeriksaan
    public function pemeriksaan()
    {
        return $this->hasMany(Pemeriksaan::class, 'id_pasien');
    }
}
