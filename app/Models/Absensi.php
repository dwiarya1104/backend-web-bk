<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;

    protected $fillable = [
        'siswa_id',
        'keterangan'
    ];

    public function siswas()
    {
        return $this->hasMany(Siswa::class, 'id', 'siswa_id');
    }
}
