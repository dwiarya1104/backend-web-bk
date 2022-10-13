<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AbsensiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'siswa_id' => rand(1, 756),
            'keterangan' => $this->faker->randomElement(['Alfa', 'Hadir', 'Sakit', 'Terlambat']),
        ];
    }
}
