<?php

namespace Database\Seeders;

use App\Models\Kelas;
use Illuminate\Database\Seeder;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Kelas::create([
            'kelas' => '12',
            'jurusan' => 'RPL'
        ]);

        Kelas::create([
            'kelas' => '12',
            'jurusan' => 'AKL 1'
        ]);
    }
}
