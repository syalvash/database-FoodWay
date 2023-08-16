<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Resto extends Authenticatable
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'resto';
    protected $fillable = [
        'email',
        'password',
        'nama_pemilik',
        'no_ktp',
        'no_hp',
        'nama_outlet',
        'no_telp_outlet',
        'alamat',
        'no_rek',
        'bank',
    ];

    protected $hidden = [];
}
