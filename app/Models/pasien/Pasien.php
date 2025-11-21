<?php

namespace App\Models\Pasien;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\dokter\Pemeriksaan;
use App\Models\pasien\Reservasi;

class Pasien extends Model
{
    use HasFactory;
    
    protected $table = 'pasien';
    protected $fillable = [
        'id_user',
        'nama_pasien',
        'jenis_kelamin',
        'tanggal_lahir',
        'alamat',
        'no_telepon',
        'foto_pasien',
    ];

    public function user() {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function pemeriksaan() {
        return $this->hasMany(Pemeriksaan::class, 'id_pasien');
    }

    public function reservasi(){
        return $this->hasMany(Reservasi::class, 'id_pasien');
    }
}
