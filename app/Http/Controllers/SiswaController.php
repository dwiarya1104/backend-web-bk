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
}
