<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'siswa_id',
        'list_penghargaan_id'
    ];

    public function siswas()
    {
        return $this->hasMany(Siswa::class);
    }

    public function list_penghargaans()
    {
        return $this->hasMany(ListPenghargaan::class);
    }
}
