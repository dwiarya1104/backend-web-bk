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
            return response()->json(['message' => 'Gagal Import Siswa!, Nama Jurusan Jangan Pakai Spasi']);
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
    public function edit_siswa(Request $request, $id)
    {
        $siswa = Siswa::where('id', $id)->first();

        $get_kelas = explode(' ', $request->kelas);
        $kelas = Kelas::where('kelas', $get_kelas[0])->where('jurusan', $get_kelas[1])->first();
        $siswa->update([
            'kelas_id' => $kelas->id
        ]);
    }
}
