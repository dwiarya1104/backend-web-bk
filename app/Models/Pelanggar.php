<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggar extends Model
{
    use HasFactory;

    protected $fillable = [
        'siswa_id',
        'list_pelanggaran_id'
    ];

    public function siswas()
    {
        return $this->hasMany(Siswa::class);
    }

    public function list_pelanggarans()
    {
        return $this->hasMany(ListPelanggaran::class);
    }
}
