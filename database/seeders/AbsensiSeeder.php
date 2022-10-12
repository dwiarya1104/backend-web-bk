<?php

namespace Database\Seeders;

use App\Models\Absensi;
use Illuminate\Database\Seeder;

class AbsensiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Absensi::create([
            'siswa_id' => 1,
            'keterangan' => 'Alfa'
        ]);

        Absensi::create([
            'siswa_id' => 2,
            'keterangan' => 'Hadir'
        ]);
    }
}
