<?php

namespace Database\Factories;

use App\Models\Jugadora;
use App\Models\Equip;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Jugadora>
 */
class JugadoraFactory extends Factory
{
    protected $model = Jugadora::class;

    public function definition(): array
    {
        return [
            'nom' => $this->faker->name(),
            'edat' => $this->faker->numberBetween(16, 40),
            'posicio' => $this->faker->randomElement([
                'Portera',
                'Defensa',
                'Migcampista',
                'Davantera',
            ]),
            'equip_id' => Equip::inRandomOrder()->first()->id,
        ];
    }
}
