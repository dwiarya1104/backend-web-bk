<?php

namespace App\Http\Controllers;

use App\Imports\ImportSiswa;
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
            $data[] = $datas;
        }
        return response()->json([
            "data" => $data
        ]);
    }
}
