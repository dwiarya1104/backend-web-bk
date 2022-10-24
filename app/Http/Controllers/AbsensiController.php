<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Kelas;
use App\Models\Pelanggar;
use App\Models\Point;
use App\Models\Siswa;
use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    public function tambah_absensi(Request $request)
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

    public function absen_perbulan($month, $tahun_awal, $tahun_akhir, $kelas, $jurusan)
    {
        $kls = Kelas::where('kelas', $kelas)
            ->where('jurusan', $jurusan)
            ->first();

        $siswa = Siswa::with('kelas', 'absensi')
            ->where('kelas_id', $kls->id)
            ->get();

        $data = [];
        foreach ($siswa as $key => $siswas) {
            $bulan_indo  = array(
                '',
                'januari',
                'februari',
                'maret',
                'april',
                'mei',
                'juni',
                'juli',
                'agustus',
                'september',
                'oktober',
                'november',
                'desember'
            );
            $nomor_bulan = array_search($month, $bulan_indo);
            if ($nomor_bulan <= 6) {
                $absensi = Absensi::with('siswas')
                    ->where('siswa_id', $siswas->id)
                    ->whereMonth('created_at', $nomor_bulan)
                    ->whereYear('created_at', $tahun_akhir)
                    ->groupBy('siswa_id')
                    ->get();
                foreach ($absensi as $value) {
                    foreach ($value->siswas as $values) {
                        $datas['id'] = $value->id;
                        $datas['nis'] = $values->nis;
                        $datas['nama'] = $values->nama;
                        $datas['kelas'] = $values->kelas->kelas . '-' . $values->kelas->jurusan;
                        $datas['keterangan'] = [
                            'A' => $value->where('siswa_id', $values->id)
                                ->where('keterangan', 'Alfa')
                                ->whereMonth('created_at', $nomor_bulan)
                                ->whereYear('created_at', $tahun_akhir)
                                ->count(),

                            'H' => $value->where('siswa_id', $values->id)
                                ->where('keterangan', 'Hadir')
                                ->whereMonth('created_at', $nomor_bulan)
                                ->whereYear('created_at', $tahun_akhir)
                                ->count(),

                            'S' => $value->where('siswa_id', $values->id)
                                ->where('keterangan', 'Sakit')
                                ->whereMonth('created_at', $nomor_bulan)
                                ->whereYear('created_at', $tahun_akhir)
                                ->count(),

                            'T' => $value->where('siswa_id', $values->id)
                                ->where('keterangan', 'Terlambat')
                                ->whereMonth('created_at', $nomor_bulan)
                                ->whereYear('created_at', $tahun_akhir)
                                ->count(),

                        ];
                        $data[] = $datas;
                    }
                }
            }
            if ($nomor_bulan >= 7 && $nomor_bulan <= 12) {
                $absensi = Absensi::with('siswas')
                    ->where('siswa_id', $siswas->id)
                    ->whereMonth('created_at', $nomor_bulan)
                    ->whereYear('created_at', $tahun_awal)
                    ->groupBy('siswa_id')
                    ->get();
                foreach ($absensi as $value) {
                    foreach ($value->siswas as $values) {
                        $datas['id'] = $value->id;
                        $datas['nis'] = $values->nis;
                        $datas['nama'] = $values->nama;
                        $datas['kelas'] = $values->kelas->kelas . '-' . $values->kelas->jurusan;
                        $datas['keterangan'] = [
                            'A' => $value->where('siswa_id', $values->id)
                                ->where('keterangan', 'Alfa')
                                ->whereMonth('created_at', $nomor_bulan)
                                ->whereYear('created_at', $tahun_awal)
                                ->count(),

                            'H' => $value->where('siswa_id', $values->id)
                                ->where('keterangan', 'Hadir')
                                ->whereMonth('created_at', $nomor_bulan)
                                ->whereYear('created_at', $tahun_awal)
                                ->count(),

                            'S' => $value->where('siswa_id', $values->id)
                                ->where('keterangan', 'Sakit')
                                ->whereMonth('created_at', $nomor_bulan)
                                ->whereYear('created_at', $tahun_awal)
                                ->count(),

                            'T' => $value->where('siswa_id', $values->id)
                                ->where('keterangan', 'Terlambat')
                                ->whereMonth('created_at', $nomor_bulan)
                                ->whereYear('created_at', $tahun_awal)
                                ->count(),

                        ];
                        $data[] = $datas;
                    }
                }
            }
        }

        return response()->json([
            'data' => $data,
            'message' => 'Rekapan absen bulan' . ' ' . ucfirst($month) . ' ' . 'tahun ajaran' . ' ' . $tahun_awal . '/' . $tahun_akhir
        ]);
    }

    public function absen_pertahun($year, $kelas, $jurusan)
    {
        $kls = Kelas::where('kelas', $kelas)
            ->where('jurusan', $jurusan)
            ->first();

        $siswa = Siswa::with('kelas', 'absensi')
            ->where('kelas_id', $kls->id)
            ->get();

        $data = [];
        foreach ($siswa as $siswas) {
            $absensi = Absensi::with('siswas')
                ->where('siswa_id', $siswas->id)
                ->whereYear('created_at', $year)
                ->groupBy('siswa_id')
                ->get();
            foreach ($absensi as  $value) {
                foreach ($value->siswas as  $values) {
                    $datas['id'] = $value->id;
                    $datas['nis'] = $values->nis;
                    $datas['nama'] = $values->nama;
                    $datas['kelas'] = $values->kelas->kelas . '-' . $values->kelas->jurusan;
                    $datas['keterangan'] = [
                        'A' => $value->where('siswa_id', $values->id)
                            ->where('keterangan', 'Alfa')
                            ->whereYear('created_at', $year)
                            ->count(),

                        'H' => $value->where('siswa_id', $values->id)
                            ->where('keterangan', 'Hadir')
                            ->whereYear('created_at', $year)
                            ->count(),

                        'S' => $value->where('siswa_id', $values->id)
                            ->where('keterangan', 'Sakit')
                            ->whereYear('created_at', $year)
                            ->count(),

                        'T' => $value->where('siswa_id', $values->id)
                            ->where('keterangan', 'Terlambat')
                            ->whereYear('created_at', $year)
                            ->count()
                    ];
                    $data[] = $datas;
                }
            }
        }
        return response()->json([
            'data' => $data,
            'message' => 'Rekapan absensi tahun' . ' ' . $year
        ]);
    }

    public function absen_persemester($semester, $tahun_awal, $tahun_akhir, $kelas, $jurusan)
    {
        $kls = Kelas::where('kelas', $kelas)
            ->where('jurusan', $jurusan)
            ->first();

        $siswa = Siswa::with('kelas',  'absensi')
            ->where('kelas_id', $kls->id)
            ->get();

        if ($semester == 'ganjil') {
            $data = [];
            foreach ($siswa as $siswas) {
                $start = date('Y-m-d', strtotime($tahun_awal . '-07-01'));
                $end = date('Y-m-d', strtotime($tahun_akhir . '-01-01'));
                $absensi = Absensi::with('siswas')
                    ->where('siswa_id', $siswas->id)
                    ->whereYear('created_at', $tahun_awal)
                    ->whereBetween('created_at', [$start, $end])
                    ->groupBy('siswa_id')
                    ->get();
                // dd($absensi);
                foreach ($absensi as  $value) {
                    foreach ($value->siswas as  $values) {
                        $datas['id'] = $value->id;
                        $datas['nis'] = $values->nis;
                        $datas['nama'] = $values->nama;
                        $datas['kelas'] = $values->kelas->kelas . '-' . $values->kelas->jurusan;
                        $datas['keterangan'] = [
                            'A' => $value->where('siswa_id', $values->id)
                                ->where('keterangan', 'Alfa')
                                ->whereYear('created_at', $tahun_awal)
                                ->whereBetween('created_at', [$start, $end])
                                ->count(),

                            'H' => $value->where('siswa_id', $values->id)
                                ->where('keterangan', 'Hadir')
                                ->whereYear('created_at', $tahun_awal)
                                ->whereBetween('created_at', [$start, $end])
                                ->count(),

                            'S' => $value->where('siswa_id', $values->id)
                                ->where('keterangan', 'Sakit')
                                ->whereYear('created_at', $tahun_awal)
                                ->whereBetween('created_at', [$start, $end])
                                ->count(),

                            'T' => $value->where('siswa_id', $values->id)
                                ->where('keterangan', 'Terlambat')
                                ->whereYear('created_at', $tahun_awal)
                                ->whereBetween('created_at', [$start, $end])
                                ->count()
                        ];
                        $data[] = $datas;
                    }
                }
            }
        }

        if ($semester == 'genap') {
            $data = [];
            foreach ($siswa as $siswas) {
                $start = date('Y-m-d', strtotime($tahun_akhir . '-01-01'));
                $end = date('Y-m-d', strtotime($tahun_akhir . '-07-01'));
                $absensi = Absensi::with('siswas')
                    ->where('siswa_id', $siswas->id)
                    ->whereYear('created_at', $tahun_akhir)
                    ->whereBetween('created_at', [$start, $end])
                    ->groupBy('siswa_id')
                    ->get();
                foreach ($absensi as  $value) {
                    foreach ($value->siswas as  $values) {
                        $datas['id'] = $value->id;
                        $datas['nis'] = $values->nis;
                        $datas['nama'] = $values->nama;
                        $datas['kelas'] = $values->kelas->kelas . '-' . $values->kelas->jurusan;
                        $datas['keterangan'] = [
                            'A' => $value->where('siswa_id', $values->id)
                                ->where('keterangan', 'Alfa')
                                ->whereYear('created_at', $tahun_akhir)
                                ->whereBetween('created_at', [$start, $end])
                                ->count(),

                            'H' => $value->where('siswa_id', $values->id)
                                ->where('keterangan', 'Hadir')
                                ->whereYear('created_at', $tahun_akhir)
                                ->whereBetween('created_at', [$start, $end])
                                ->count(),

                            'S' => $value->where('siswa_id', $values->id)
                                ->where('keterangan', 'Sakit')
                                ->whereYear('created_at', $tahun_akhir)
                                ->whereBetween('created_at', [$start, $end])
                                ->count(),

                            'T' => $value->where('siswa_id', $values->id)
                                ->where('keterangan', 'Terlambat')
                                ->whereYear('created_at', $tahun_akhir)
                                ->whereBetween('created_at', [$start, $end])
                                ->count()
                        ];
                        $data[] = $datas;
                    }
                }
            }
        }

        return response()->json([
            'data' => $data,
            $start, $end,
            'message' => 'Rekapan Semester' . ' ' . $semester . ' ' . 'tahun ajaran'  . ' ' . $tahun_awal . '/' . $tahun_akhir
        ]);
    }
}
