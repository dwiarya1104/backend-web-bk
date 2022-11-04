<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Kelas;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KelasController extends Controller
{
    public function kelas()
    {
        $kelas = Kelas::get();
        $tes = Absensi::select(
            DB::raw("YEAR(created_at) as year")
        )
            ->orderBy('created_at', 'ASC')
            ->groupBy('year')
            ->get();

        return response()->json([
            "data" => $kelas,
            "tes" => $tes
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
