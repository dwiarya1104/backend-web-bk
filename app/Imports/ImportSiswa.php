<?php

namespace App\Imports;

use App\Models\Kelas;
use App\Models\Siswa;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ImportSiswa implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // $get = explode(' ', $row['kelas']);
        $kelas = Kelas::where('kelas', $row['kelas'])->where('jurusan', $row['jurusan'])->first();

        return new Siswa([
            'nis' => $row['nis'],
            'nama' => $row['nama_siswa'],
            'jk' => $row['jenis_kelamin'],
            'kelas_id' => $kelas->id,
        ]);
    }
}
