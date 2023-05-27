<?php

namespace App\Http\Controllers;

use App\Imports\ImportSiswa;
use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class SiswaController extends Controller
{
    public function import(Request $request)
    {
        try {
            Excel::import(
                new ImportSiswa,
                $request->file('file')->store('files')
            );
            return response()->json(['message' => 'Berhasil Import Siswa!']);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Gagal Import Siswa!, Nama Jurusan Jangan Pakai Spasi', 'error' => $th]);
        }
    }

    public function data_siswa()
    {
        $siswa = Siswa::get();
        $data = [];
        foreach ($siswa as $value) {
            $datas['id'] = $value->id;
            $datas['nis'] = $value->nis;
            $datas['nama'] = $value->nama;
            $datas['kelas'] = $value->kelas->kelas . ' ' . $value->kelas->jurusan;
            $datas['jenis_kelamin'] = $value->jk;
            $data[] = $datas;
        }
        return response()->json([
            "data" => $data
        ]);
    }
    public function data_siswa_perkelas($kelas, $jurusan)
    {
        $data_kelas = Kelas::where(['jurusan' => $jurusan, 'kelas' => $kelas])->first();
        $siswas = Siswa::where('kelas_id', $data_kelas->id)->orderBy('nama', 'ASC')->get();

        return response()->json([
            'kelas' => $kelas,
            'jurusan' => $jurusan,
            "data" => $siswas
        ]);
    }
    public function tambah_siswa(Request $request)
    {
        $data_kelas = Kelas::where(['jurusan' => $request->jurusan, 'kelas' => $request->kelas])->first();

        $siswa = Siswa::create([
            'nis' => $request->nis,
            'nama' => $request->nama,
            'kelas_id' => $data_kelas->id,
            'jk' => $request->jk
        ]);
        return response()->json([
            "status" => "success",
            "message" => "Berhasil Menambah siswa",
            "data" => $siswa
        ], 200);
    }
    public function edit_siswa(Request $request, $id)
    {
        $siswa = Siswa::where('id', $id)->first();

        $siswa->update([
            'nis' => $request->nis,
            'nama' => $request->nama,
            'jk' => $request->jk
        ]);

        return response()->json([
            "status" => "success",
            "message" => "Berhasil mengubah data siswa",
            "data" => $siswa
        ], 200);
    }

    public function hapus_siswa($id)
    {
        $siswa = Siswa::where('id', $id)->first();
        if (!$siswa) {
            return response()->json([
                "status" => "failed",
                "message" => "Siswa tidak ditemukan!"
            ], 404);
        }
        $siswa->delete();
        return response()->json([
            "message" => "Berhasil menghapus siswa",
            "status" => "success"
        ]);
    }

    public function hapus_selected_siswa(Request $request)
    {
        // $ids = [248, 634];
        $destroy = Siswa::destroy($request->destroy);

        if ($destroy) {
            return response()->json([
                "status" => "success",
                "message" => "Berhasil menghapus data siswa",
                'data' => $request
            ]);
        } else {
            return response()->json([
                "status" => "failed",
                "message" => "Gagal menghapus data siswa",
                'data' => $request
            ]);
        }
    }
}
