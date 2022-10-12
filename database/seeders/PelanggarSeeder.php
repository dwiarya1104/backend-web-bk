<?php

namespace Database\Seeders;

use App\Models\Pelanggar;
use Illuminate\Database\Seeder;

class PelanggarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pelanggar::create([
            'siswa_id' => 1,
            'list_pelanggaran_id' => 31
        ]);

        Pelanggar::create([
            'siswa_id' => 2,
            'list_pelanggaran_id' => 35
        ]);
    }
}
