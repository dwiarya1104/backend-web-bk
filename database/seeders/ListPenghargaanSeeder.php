<?php

namespace Database\Seeders;

use App\Models\ListPenghargaan;
use Illuminate\Database\Seeder;

class ListPenghargaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ListPenghargaan::create([
            'penghargaan' => 'Menjadi petugas upacara tingkat sekolah',
            'point' => 5
        ]);

        ListPenghargaan::create([
            'penghargaan' => 'Menjadi pengurus kelas dan menjalankan tugas dengan baik',
            'point' => 5
        ]);

        ListPenghargaan::create([
            'penghargaan' => 'Melaksanakan tugas kebersihan sekolah',
            'point' => 10
        ]);

        ListPenghargaan::create([
            'penghargaan' => 'Menjadi petugas pengibar bendera tingkat wilayah',
            'point' => 10
        ]);

        ListPenghargaan::create([
            'penghargaan' => 'Menjadi ketua kelas dan bertugas dengan baik',
            'point' => 10
        ]);

        ListPenghargaan::create([
            'penghargaan' => 'Membawa nama baik sekolah tingkat kecamatan',
            'point' => 10
        ]);

        ListPenghargaan::create([
            'penghargaan' => 'Menjadi petugas pengibar bendera tingkat provinsi dan nasional',
            'point' => 20
        ]);

        ListPenghargaan::create([
            'penghargaan' => 'Menjadi pengurus OSIS dan bertugas dengan baik',
            'point' => 20
        ]);

        ListPenghargaan::create([
            'penghargaan' => 'Membawa nama baik sekolah di tingkat wilayah bidang akademik atau non bidang akademik',
            'point' => 20
        ]);

        ListPenghargaan::create([
            'penghargaan' => 'Membawa nama baik sekolah di tingkat provinsi bidang akademik atau non akademik',
            'point' => 20
        ]);

        ListPenghargaan::create([
            'penghargaan' => 'Membawa nama baik sekolah di tingkat nasional bidang akademik atau non bidang akademik',
            'point' => 25
        ]);

        ListPenghargaan::create([
            'penghargaan' => 'Membawa nama baik sekolah di tingkat internasional bidang akademik atau non akademik',
            'point' => 25
        ]);
    }
}
