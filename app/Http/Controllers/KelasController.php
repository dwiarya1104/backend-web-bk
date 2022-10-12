<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function tambah_kelas(Request $request)
    {
        $kelas = Kelas::create([
            'kelas' => $request->kelas,
            'jurusan' => $request->jurusan
        ]);
        return response()->json([
            "status" => "success",
            "message" => "Berhasil Menambah Kelas",
            "data" => $kelas
        ], 200);
    }
}
