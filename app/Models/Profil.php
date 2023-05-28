<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profil extends Model
{
    protected $table = 'profil';
    public $timestamps = false;

    protected $fillable = [
        'id_akun',
        'nama_akun',
        'umur',
        'kode_otp',
        'tanggal_lahir',
        'nomer_hp',
        'jenis_kelamin',
        'your_interested',
        'gambar_profile',
    ];

    public function akun()
    {
        return $this->belongsTo(Akun::class, 'id_akun', 'id_akun');
    }
}