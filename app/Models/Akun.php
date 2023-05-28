<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Akun extends Model
{
    protected $table = 'akun';
    protected $primaryKey = 'id_akun';
    public $timestamps = false;

    protected $fillable = [
        'id_akun',
        'email',
        'password',
    ];

    public function profil()
    {
        return $this->hasOne(Profil::class, 'id_akun', 'id_akun');
    }

    public function pekerjaan()
    {
        return $this->hasOne(Pekerjaan::class, 'id_akun', 'id_akun');
    }
}