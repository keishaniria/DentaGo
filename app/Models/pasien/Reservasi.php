<?php

namespace App\Models\Pasien;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\dokter\Jadwal;
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

    protected static function booted()
    {
        static::created(function ($reservasi) {

            Jadwal::create([
                'id_pasien' => $reservasi->id_pasien,
                'id_dokter' => null,
                'tanggal' => $reservasi->tanggal_reservasi,
                'jam' => $reservasi->jam,
                'jenis_pemeriksaan' => null,
                'status' => 'Menunggu',
            ]);

        });
    }

    public function pasien() 
    {
        return $this->belongsTo(Pasien::class, 'id_pasien', 'id');
    }

    public function dokter()
    {
        return $this->belongsTo(Doktergigi::class, 'id_dokter', 'id');
    }

}
