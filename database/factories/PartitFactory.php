<?php

namespace Database\Factories;

use App\Models\Partit;
use App\Models\Estadi;
use App\Models\Equip;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Partit>
 */
class PartitFactory extends Factory
{
    /**
     * Model associat a la factory
     *
     * @var string
     */
    protected $model = Partit::class;

    /**
     * Estat per defecte
     */
    public function definition(): array
    {
        return [
            'estadi_id' => Estadi::inRandomOrder()->first()->id,
            'equip_local_id' => Equip::inRandomOrder()->first()->id,
            'equip_visitant_id' => Equip::inRandomOrder()->first()->id,
            'resultat' => $this->faker->numberBetween(0, 5)
                        . ' - ' .
                        $this->faker->numberBetween(0, 5),
        ];
    }
}
