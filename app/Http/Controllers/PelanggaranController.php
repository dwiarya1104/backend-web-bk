<?php

namespace App\Http\Controllers;

use App\Models\ListPelanggaran;
use App\Models\Pelanggar;
use App\Models\Point;
use Illuminate\Http\Request;

class PelanggaranController extends Controller
{
    public function top_pelanggar()
    {
        $top_pelanggar = Point::with('siswas')
            ->orderBy('point_pelanggaran', 'DESC')
            ->get();

        $data = [];
        foreach ($top_pelanggar->take(10) as $value) {
            foreach ($value->siswas as $values) {
                $datas['id'] = $value->id;
                $datas['nama'] = $values->nama;
                $datas['kelas'] = $values->kelas->kelas;
                $datas['jurusan'] = $values->kelas->jurusan;
                $datas['point'] = $value->point_pelanggaran;
                $data[] = $datas;
            }
        }
        return response()->json([
            "status" =>  "success",
            "message" =>  "Get data pelanggar successfully",
            "data" => $data
        ]);
    }

    public function list_pelanggaran()
    {
        $list_pelanggaran = ListPelanggaran::get();
        return response()->json([
            "status" => "success",
            "message" =>  "Get data pelanggaran successfully",
            "data" => $list_pelanggaran
        ]);
    }

    public function tambah_pelanggar(Request $request)
    {
        $pelanggar = Pelanggar::create([
            'siswa_id' => $request->siswa_id,
            'list_pelanggaran_id' => $request->list_pelanggaran_id,
        ]);

        $get_point = ListPelanggaran::select('point')->where('id', $request->list_pelanggaran_id)->first();
        $cek_point = Point::where('siswa_id', $request->siswa_id)->first();

        if ($cek_point) {
            Point::where('siswa_id', $pelanggar->siswa_id)->update([
                'point_pelanggaran' => $cek_point->point_pelanggaran + $get_point->point
            ]);
            return response()->json([
                "data" => $pelanggar
            ]);
        } else {
            $tes = Point::where('siswa_id', $pelanggar->siswa_id)->create([
                'siswa_id' => $request->siswa_id,
                'point_pelanggaran' => $get_point->point
            ]);
        }
        return response()->json([
            "data" => $pelanggar
        ]);
    }
}
