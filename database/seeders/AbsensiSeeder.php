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
        Absensi::factory()->count(10000)->create();
    }
}
