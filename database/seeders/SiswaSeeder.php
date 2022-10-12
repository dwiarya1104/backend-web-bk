<?php

namespace Database\Seeders;

use App\Models\Siswa;
use Illuminate\Database\Seeder;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Siswa::create([
            'nis' => '12069',
            'nama' => 'Achmad Dhani',
            'kelas_id' => 1
        ]);

        Siswa::create([
            'nis' => '12070',
            'nama' => 'Dwi Arya Putra',
            'kelas_id' => 2
        ]);
    }
}
