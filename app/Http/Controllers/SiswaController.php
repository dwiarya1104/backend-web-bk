<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function tes()
    {
        $p = Siswa::get();
        return response()->json([
            $p
        ]);
    }
}
