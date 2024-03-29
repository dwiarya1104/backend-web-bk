<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class SiswaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nis' => rand(11111, 99999),
            'nama' => $this->faker->name(),
            'kelas_id' => rand(1, 21),
            'jk' => $this->faker->randomElement(['Laki-laki', 'Perempuan']),
        ];
    }
}
