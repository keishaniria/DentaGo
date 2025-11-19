<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Dokter extends Model
{
    //
    use HasFactory;

    protected $table = 'users'; // nama tabel
    protected $fillable = 
    [
        'username', 
        'email', 
        'no_telp',
        'password',
        'role'
    ];
}
