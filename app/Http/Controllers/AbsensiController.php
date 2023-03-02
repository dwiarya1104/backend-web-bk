<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Kelas;
use App\Models\Pelanggar;
use App\Models\Point;
use App\Models\Siswa;
use Carbon\Carbon;
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
            ->orderBy('nama', 'ASC')
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
                        $datas['jk'] = $values->jk;
                        $kehadiran = Absensi::where('siswa_id', $values->id)->get();
                        $tes = [];
                        foreach ($kehadiran as $key => $kh) {
                            if ($kh->keterangan == "Alfa") {
                                $tester = [
                                    'A' => true,
                                    'H' => false,
                                    'S' => false,
                                    'T' => false,
                                    'I' => false
                                ];
                            }
                            if ($kh->keterangan == "Hadir") {
                                $tester = [
                                    'A' => false,
                                    'H' => true,
                                    'S' => false,
                                    'T' => false,
                                    'I' => false
                                ];
                            }
                            if ($kh->keterangan == "Sakit") {
                                $tester = [
                                    'A' => false,
                                    'H' => false,
                                    'S' => true,
                                    'T' => false,
                                    'I' => false
                                ];
                            }
                            if ($kh->keterangan == "Terlambat") {
                                $tester = [
                                    'A' => false,
                                    'H' => false,
                                    'S' => false,
                                    'T' => true,
                                    'I' => false
                                ];
                            }
                            if ($kh->keterangan == "Izin") {
                                $tester = [
                                    'A' => false,
                                    'H' => true,
                                    'S' => false,
                                    'T' => false,
                                    'I' => true
                                ];
                            }
                            $tes[] = $tester;
                            $datas['days'] = $tes;
                        }
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
                        $datas['jk'] = $values->jk;
                        $kehadiran = Absensi::where('siswa_id', $values->id)->get();
                        $tes = [];
                        foreach ($kehadiran as $key => $kh) {
                            if ($kh->keterangan == "Alfa") {
                                $tester = [
                                    'A' => true,
                                    'H' => false,
                                    'S' => false,
                                    'T' => false,
                                    'I' => false
                                ];
                            }

                            if ($kh->keterangan == "Hadir") {
                                $tester = [
                                    'A' => false,
                                    'H' => true,
                                    'S' => false,
                                    'T' => false,
                                    'I' => false
                                ];
                            }
                            if ($kh->keterangan == "Sakit") {
                                $tester = [
                                    'A' => false,
                                    'H' => false,
                                    'S' => true,
                                    'T' => false,
                                    'I' => false
                                ];
                            }
                            if ($kh->keterangan == "Terlambat") {
                                $tester = [
                                    'A' => false,
                                    'H' => false,
                                    'S' => false,
                                    'T' => true,
                                    'I' => false
                                ];
                            }
                            if ($kh->keterangan == "Izin") {
                                $tester = [
                                    'A' => false,
                                    'H' => true,
                                    'S' => false,
                                    'T' => false,
                                    'I' => true
                                ];
                            }
                            $tes[] = $tester;
                            $datas['days'] = $tes;
                        }
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
            ->orderBy('nama', 'ASC')
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
                    $datas['jk'] = $values->jk;
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
                            ->count(),

                        'I' => $value->where('siswa_id', $values->id)
                            ->where('keterangan', 'Izin')
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
            ->orderBy('nama', 'ASC')
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
                        $datas['jk'] = $values->jk;
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
                                ->count(),

                            'I' => $value->where('siswa_id', $values->id)
                                ->where('keterangan', 'Izin')
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
                        $datas['jk'] = $values->jk;
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
                                ->count(),

                            'I' => $value->where('siswa_id', $values->id)
                                ->where('keterangan', 'Izin')
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

    public function total_absen_sehari()
    {
        $absensi = Absensi::orderByRaw("FIELD(keterangan,'Hadir','Izin','Sakit','Terlambat','Alfa')")
            ->groupBy('keterangan')
            ->get();
        $data = [];
        foreach ($absensi as $key => $value) {
            $datas['keterangan'] = $value->keterangan;
            if ($value->keterangan == "Hadir") {
                $datas['siswa'] = $value->where('keterangan', 'Hadir')
                    ->whereDate('created_at', date('Y-m-d'))
                    ->count();
            }
            if ($value->keterangan == "Izin") {
                $datas['siswa'] = $value->where('keterangan', 'Izin')
                    ->whereDate('created_at', date('Y-m-d'))
                    ->count();
            }
            if ($value->keterangan == "Sakit") {
                $datas['siswa'] = $value->where('keterangan', 'Sakit')
                    ->whereDate('created_at', date('Y-m-d'))
                    ->count();
            }
            if ($value->keterangan == "Terlambat") {
                $datas['siswa'] = $value->where('keterangan', 'Terlambat')
                    ->whereDate('created_at', date('Y-m-d'))
                    ->count();
            }
            if ($value->keterangan == "Alfa") {
                $datas['siswa'] = $value->where('keterangan', 'Alfa')
                    ->whereDate('created_at', date('Y-m-d'))
                    ->count();
            }
            $date = Carbon::now()->locale('id');
            $date->settings(['formatFunction' => 'translatedFormat']);
            $datas['tanggal'] = $date->format('j F Y');
            $data[] = $datas;
        }

        return response()->json([
            "status" => "success",
            "message" => "Get today presents datas successfully",
            "data" => $data
        ]);
    }
}
