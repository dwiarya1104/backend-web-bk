<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\ListPelanggaran;
use App\Models\Pelanggar;
use App\Models\Point;
use App\Models\Siswa;
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
    public function point_persiswa($nis)
    {
        $siswa = Siswa::with('point', 'pelanggar', 'prestasi')->where('nis', $nis)->first();
        if (!$siswa) {
            return response()->json([
                'message' => 'Siswa tidak ditemukan'
            ], 404);
        }
        $pelanggar = Pelanggar::where('siswa_id', $siswa->id)->get();
        $data = [];
        foreach ($pelanggar as $value) {
            $get_point = ListPelanggaran::where('id', $value->list_pelanggaran_id)->first();
            $total_pelanggaran = Point::where('siswa_id', $value->siswa_id)->sum('point_pelanggaran');
            $total_penghargaan = Point::where('siswa_id', $value->siswa_id)->sum('point_penghargaan');
            $total_seluruh = $total_pelanggaran - $total_penghargaan;
            $datas['id'] = $value->id;
            $datas['nis'] = $nis;
            $datas['nama'] = $siswa->nama;
            $datas['kelas'] = $siswa->kelas->kelas . ' ' . $siswa->kelas->jurusan;
            $datas['rekap'] = [
                'tanggal' => $value->created_at->format('d-m-Y'),
                'jenis' => $get_point->id,
                'pelanggaran' => $get_point->pelanggaran,
                'point' => $get_point->point
            ];
            $datas['kumulatif'] = [
                'point_pelanggaran' => $total_pelanggaran,
                'point_penghargaan' => $total_penghargaan,
                'total' => $total_seluruh
            ];
            if ($total_seluruh == 0) {
                $datas['tindakan'] = null;
            }
            if ($total_seluruh > 0 && $total_seluruh <= 75) {
                $datas['tindakan'] = 'Teguran/Pembinaan';
            }
            if ($total_seluruh >= 76 && $total_seluruh <= 100) {
                $datas['tindakan'] = 'SP1';
            }
            if ($total_seluruh >= 101 && $total_seluruh <= 200) {
                $datas['tindakan'] = 'SP2';
            }
            if ($total_seluruh >= 201 && $total_seluruh <= 300) {
                $datas['tindakan'] = 'SP3';
            }
            if ($total_seluruh > 300) {
                $datas['tindakan'] = 'DO/Dikeluarkan';
            }
            $data[] = $datas;
        }
        return response()->json([
            'data' => $data,
        ]);
    }

    public function point_perkelas($kelas, $jurusan)
    {
        $kelas = Kelas::where('kelas', $kelas)
            ->where('jurusan', $jurusan)
            ->first();

        $siswa = Siswa::with('kelas',  'absensi')
            ->where('kelas_id', $kelas->id)
            ->orderBy('nama', 'ASC')
            ->get();

        $data = [];
        foreach ($siswa as $key => $value) {
            $pelanggar = Pelanggar::where('siswa_id', $value->id)
                ->groupBy('siswa_id')
                ->get();
            foreach ($pelanggar as $p) {
                $total_pelanggaran = Point::where('siswa_id', $p->siswa_id)->sum('point_pelanggaran');
                $total_penghargaan = Point::where('siswa_id', $p->siswa_id)->sum('point_penghargaan');
                $total_seluruh = $total_pelanggaran - $total_penghargaan;
                $datas['nama'] = $value->nama;
                $datas['jk'] = $value->jk;
                $datas['kumulatif'] = $total_seluruh;
                if ($total_seluruh == 0) {
                    $datas['tindakan'] = null;
                }
                if ($total_seluruh > 0 && $total_seluruh <= 75) {
                    $datas['tindakan'] = 'Teguran/Pembinaan';
                }
                if ($total_seluruh >= 76 && $total_seluruh <= 100) {
                    $datas['tindakan'] = 'SP1';
                }
                if ($total_seluruh >= 101 && $total_seluruh <= 200) {
                    $datas['tindakan'] = 'SP2';
                }
                if ($total_seluruh >= 201 && $total_seluruh <= 300) {
                    $datas['tindakan'] = 'SP3';
                }
                if ($total_seluruh > 300) {
                    $datas['tindakan'] = 'DO/Dikeluarkan';
                }
                $data[] = $datas;
            }
        }
        return response()->json(['data' => $data]);
    }
}
