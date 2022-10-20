<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $fillable = [
        'nis',
        'nama',
        'kelas_id'
    ];

    public function kelas()
    {
        return $this->hasOne(Kelas::class, 'id', 'kelas_id');
    }

    public function absensi()
    {
        return $this->belongsTo(Absensi::class, 'id');
    }

    public function pelanggar()
    {
        return $this->belongsTo(Pelanggar::class, 'id');
    }

    public function point()
    {
        return $this->belongsTo(Point::class, 'id');
    }

    public function prestasi()
    {
        return $this->belongsTo(Prestasi::class, 'id');
    }
}
