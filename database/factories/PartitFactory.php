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
     * Definició dels atributs per defecte
     */
    public function definition(): array
    {
        // Obtenir tots els IDs d'equips disponibles
        $equipsIds = Equip::pluck('id')->toArray();
        
        // Seleccionar dos equips diferents
        $equipLocalId = $this->faker->randomElement($equipsIds);
        $equipsRestants = array_diff($equipsIds, [$equipLocalId]);
        $equipVisitantId = $this->faker->randomElement($equipsRestants);

        // Generar gols realistes (més probabilitat de resultats baixos)
        $golsLocal = $this->faker->numberBetween(0, 4);
        $golsVisitant = $this->faker->numberBetween(0, 4);

        return [
            'estadi_id' => Estadi::inRandomOrder()->first()->id,
            'equip_local_id' => $equipLocalId,
            'equip_visitant_id' => $equipVisitantId,
            'resultat' => "{$golsLocal} - {$golsVisitant}",
        ];
    }

    /**
     * Partit amb molts gols
     */
    public function altsPuntuacio(): static
    {
        return $this->state(function (array $attributes) {
            $golsLocal = $this->faker->numberBetween(3, 7);
            $golsVisitant = $this->faker->numberBetween(3, 7);
            
            return [
                'resultat' => "{$golsLocal} - {$golsVisitant}",
            ];
        });
    }

    /**
     * Empat
     */
    public function empat(): static
    {
        return $this->state(function (array $attributes) {
            $gols = $this->faker->numberBetween(0, 3);
            
            return [
                'resultat' => "{$gols} - {$gols}",
            ];
        });
    }

    /**
     * Victoria local
     */
    public function victoriaLocal(): static
    {
        return $this->state(function (array $attributes) {
            $golsLocal = $this->faker->numberBetween(2, 5);
            $golsVisitant = $this->faker->numberBetween(0, $golsLocal - 1);
            
            return [
                'resultat' => "{$golsLocal} - {$golsVisitant}",
            ];
        });
    }
}