<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function kelas()
    {
        $kelas = Kelas::get();
        return response()->json([
            "data" => $kelas
        ]);
    }

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

    public function edit_kelas(Request $request, $id)
    {
        $kelas = Kelas::where('id', $id)->first();
        $kelas->update([
            'kelas' => $request->kelas,
            'jurusan' => $request->jurusan
        ]);
        return response()->json([
            "message" => "Berhasil mengedit kelas!"
        ]);
    }


    public function hapus_kelas($id)
    {
        $kelas = Kelas::where('id', $id)->first();
        if (!$kelas) {
            return response()->json([
                "message" => "Kelas tidak ditemukan!"
            ], 404);
        }
        $kelas->delete();
        return response()->json([
            "message" => "Berhasil menghapus kelas!"
        ]);
    }
}
