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
        return $this->hasOne(Kelas::class, 'id');
    }

    public function absensi()
    {
        return $this->belongsTo(Absensi::class);
    }

    public function pelanggar()
    {
        return $this->belongsTo(Pelanggar::class);
    }

    public function point()
    {
        return $this->belongsTo(Point::class);
    }

    public function prestasi()
    {
        return $this->belongsTo(Prestasi::class);
    }
}
