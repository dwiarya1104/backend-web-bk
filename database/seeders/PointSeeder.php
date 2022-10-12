<?php

namespace Database\Seeders;

use App\Models\Point;
use Illuminate\Database\Seeder;

class PointSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Point::create([
            'siswa_id' => 1,
            'point_pelanggaran' => 10,
            'point_penghargaan' => 10
        ]);

        Point::create([
            'siswa_id' => 2,
            'point_pelanggaran' => 5,
            'point_penghargaan' => 5
        ]);
    }
}
