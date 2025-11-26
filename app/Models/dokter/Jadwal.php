<?php

namespace App\Models\dokter;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pasien\Pasien;
use App\Models\Pasien\Reservasi;
use App\Models\User;

class Jadwal extends Model
{
    //
    use HasFactory;

    protected $table = 'jadwals';

    protected $fillable = [
        'id_pasien',
        'id_dokter',
        'id_reservasi',
        'tanggal',
        'jam',
        'jam_mulai',
        'jam_selesai',
        'status',
    ];

    public function pasien()
    {
        return $this->belongsTo(Pasien::class, 'id_pasien', 'id');
    }

    public function dokter()
    {
        return $this->belongsTo(User::class, 'id_dokter', 'id');
    }
    public function reservasi()
    {
        return $this->belongsTo(Reservasi::class, 'id_reservasi', 'id');
    }
}
