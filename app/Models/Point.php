<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
    use HasFactory;

    protected $fillable = [
        'siswa_id',
        'point_pelanggaran',
        'point_penghargaan'
    ];

    public function siswas()
    {
        return $this->hasMany(Siswa::class, 'id');
    }
}
