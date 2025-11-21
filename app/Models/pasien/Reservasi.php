<?php

namespace App\Models\Pasien;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reservasi extends Model
{
    use HasFactory;

    protected $table = 'reservasi';
    protected $fillable = [
        'id_pasien',
        'id_dokter',
        'tanggal_reservasi',
        'jam',
        'status',
    ];

    public function pasien() 
    {
        return $this->belongsTo(Pasien::class, 'id_pasien', 'id');
    }

    public function dokter()
    {
        return $this->belongsTo(Doktergigi::class, 'id_dokter', 'id');
    }

}
