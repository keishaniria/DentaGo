<?php

namespace App\Models\Pasien;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
}
