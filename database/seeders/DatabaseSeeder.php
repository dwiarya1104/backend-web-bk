<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            UserSeeder::class,
            KelasSeeder::class,
            SiswaSeeder::class,
            PointSeeder::class,
            ListPelanggaranSeeder::class,
            ListPenghargaanSeeder::class,
            PelanggarSeeder::class,
            PrestasiSeeder::class,
            AbsensiSeeder::class
        ]);
    }
}
