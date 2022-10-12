<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListPelanggaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'kategori',
        'pelanggaran',
        'point'
    ];

    public function pelanggar()
    {
        return $this->belongsTo(Pelanggar::class);
    }
}
