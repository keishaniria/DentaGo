<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Doktergigi extends Model
{
    //
    protected $table = 'dokter_gigi';
    protected $fillable = [
       'nama_dokter',
       'no_telepon',
       'foto_dokter',
    ];

    public function user()
    {
        return $this->belongsTo(user::class, 'id_user', 'id');
    }

}
