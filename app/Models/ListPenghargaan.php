<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListPenghargaan extends Model
{
    use HasFactory;

    protected $fillable = [
        'penghargaan',
        'point'
    ];

    public function prestasi()
    {
        return $this->belongsTo(Prestasi::class);
    }
}
