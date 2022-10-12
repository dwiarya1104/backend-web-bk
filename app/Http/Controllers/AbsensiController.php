<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Pelanggar;
use App\Models\Point;
use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    public function absensi(Request $request)
    {
        $absen = Absensi::create([
            'siswa_id' => $request->siswa_id,
            'keterangan' => $request->ket
        ]);

        if ($absen['keterangan'] == 'Alfa') {
            $pelanggar = Pelanggar::create([
                'siswa_id' => $absen->siswa_id,
                'list_pelanggaran_id' => 31
            ]);
            $cek_siswa = Point::where('siswa_id', $absen->siswa_id)->first();
            if ($cek_siswa) {
                $cek_siswa->update([
                    'point_pelanggaran' => $cek_siswa->point_pelanggaran + 10
                ]);
            } else {
                Point::create([
                    'siswa_id' => $absen->siswa_id,
                    'point_pelanggaran' => 10
                ]);
            }
        }
        if ($absen['keterangan'] == 'Terlambat') {
            $pelanggar = Pelanggar::create([
                'siswa_id' => $absen->siswa_id,
                'list_pelanggaran_id' => 35
            ]);
            $cek_siswa = Point::where('siswa_id', $absen->siswa_id)->first();
            if ($cek_siswa) {
                $cek_siswa->update([
                    'point_pelanggaran' => $cek_siswa->point_pelanggaran + 5
                ]);
            } else {
                Point::create([
                    'siswa_id' => $absen->siswa_id,
                    'point_pelanggaran' => 5
                ]);
            }
        }
        return response()->json([
            "data" => $absen
        ]);
    }
}
