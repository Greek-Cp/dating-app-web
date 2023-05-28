<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailAkun extends Model
{
    protected $table = 'detail_akun';
    protected $primaryKey = 'id_detail_akun';
    public $timestamps = false;

    protected $fillable = [
        'id_detail_akun',
        'id_akun',
        'id_akun_disukai',
        'id_akun_favorit',
    ];

    public function akun()
    {
        return $this->belongsTo(Akun::class, 'id_akun', 'id_akun');
    }

    public function akunDisukai()
    {
        return $this->belongsTo(Akun::class, 'id_akun_disukai', 'id_akun');
    }

    public function akunFavorit()
    {
        return $this->belongsTo(Akun::class, 'id_akun_favorit', 'id_akun');
    }
}