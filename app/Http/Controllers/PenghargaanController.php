<?php

namespace App\Http\Controllers;

use App\Models\ListPenghargaan;
use App\Models\Point;
use App\Models\Prestasi;
use Illuminate\Http\Request;

class PenghargaanController extends Controller
{
    public function top_penghargaan()
    {
        $top_penghargaan = Point::with('siswas')
            ->orderBy('point_penghargaan', 'DESC')
            ->get();

        $data = [];
        foreach ($top_penghargaan->take(10) as $value) {
            foreach ($value->siswas as  $values) {
                $datas['id'] = $value->id;
                $datas['nama'] = $values->nama;
                $datas['kelas'] = $values->kelas->kelas;
                $datas['jurusan'] = $values->kelas->jurusan;
                $datas['point'] = $value->point_penghargaan;
                $data[] = $datas;
            }
        }
        return response()->json([
            "status" =>  "success",
            "message" =>  "Get data penghargaan successfully",
            "data" => $data
        ]);
    }

    public function list_penghargaan()
    {
        $list_penghargaan = ListPenghargaan::get();
        return response()->json([
            "status" => "success",
            "message" => "Get data penghargaan successfully",
            "data" => $list_penghargaan
        ]);
    }

    public function tambah_penghargaan(Request $request)
    {
        $prestasi = Prestasi::create([
            'siswa_id' => $request->siswa_id,
            'list_penghargaan_id' => $request->list_penghargaan_id,
        ]);

        $get_point = ListPenghargaan::select('point')
            ->where('id', $request->list_penghargaan_id)
            ->first();

        $cek_point = Point::where('siswa_id', $request->siswa_id)->first();

        if ($cek_point) {
            Point::where('siswa_id', $prestasi->siswa_id)->update([
                'point_penghargaan' => $cek_point->point_penghargaan + $get_point->point
            ]);
            return response()->json([
                "data" => $prestasi
            ]);
        } else {
            Point::where('siswa_id', $prestasi->siswa_id)->create([
                'siswa_id' => $request->siswa_id,
                'point_penghargaan' => $get_point->point
            ]);
        }
        return response()->json([
            "data" => $prestasi
        ]);
    }
}
