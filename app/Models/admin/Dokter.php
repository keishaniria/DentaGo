<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;

class Dokter extends Model
{
    //
    use HasFactory;

    protected $table = 'dokters'; // nama tabel
    protected $fillable = 
    [
        'id_users',
        'nama_dokter',
        'no_telp',
        // 'password',
        // 'role'
        'foto'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_users');
    }
}
