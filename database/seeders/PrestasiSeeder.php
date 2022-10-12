<?php

namespace Database\Seeders;

use App\Models\Prestasi;
use Illuminate\Database\Seeder;

class PrestasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Prestasi::create([
            'siswa_id' => 1,
            'list_penghargaan_id' => 1
        ]);

        Prestasi::create([
            'siswa_id' => 2,
            'list_penghargaan_id' => 2
        ]);
    }
}
