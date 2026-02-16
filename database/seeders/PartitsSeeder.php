<?php
namespace Database\Seeders;

use App\Models\Partit;
use App\Models\Estadi;
use App\Models\Equip;
use Illuminate\Database\Seeder;

class PartitsSeeder extends Seeder
{
    public function run(): void
    {
        // Verificar que hi ha suficients equips i estadis
        $numEquips = Equip::count();
        $numEstadis = Estadi::count();

        if ($numEquips < 2) {
            $this->command->error('⚠️  Es necessiten almenys 2 equips per crear partits!');
            return;
        }

        if ($numEstadis < 1) {
            $this->command->error('⚠️  Es necessita almenys 1 estadi per crear partits!');
            return;
        }

        // Crear els 2 partits específics (si existeixen els equips i estadis)
        $campNou = Estadi::where('nom', 'Camp Nou')->first();
        $wanda   = Estadi::where('nom', 'Wanda Metropolitano')->first();
        
        $barca  = Equip::where('nom', 'Barça Femení')->first();
        $madrid = Equip::where('nom', 'Real Madrid Femení')->first();
        $atleti = Equip::where('nom', 'Atlètic de Madrid')->first();

        $partitsCreats = 0;

        if ($campNou && $barca && $madrid) {
            Partit::create([
                'estadi_id' => $campNou->id,
                'equip_local_id' => $barca->id,
                'equip_visitant_id' => $madrid->id,
                'resultat' => '2 - 1',
            ]);
            $partitsCreats++;
            $this->command->info('✅ Partit creat: Barça vs Real Madrid');
        }

        if ($wanda && $atleti && $barca) {
            Partit::create([
                'estadi_id' => $wanda->id,
                'equip_local_id' => $atleti->id,
                'equip_visitant_id' => $barca->id,
                'resultat' => '0 - 3',
            ]);
            $partitsCreats++;
            $this->command->info('✅ Partit creat: Atlètic vs Barça');
        }

        // Crear partits aleatoris fins arribar a 15
        $partitsAleatoris = 15 - $partitsCreats;

        if ($partitsAleatoris > 0) {
            // Crear diferents tipus de partits per varietat
            $distribucio = [
                'normals' => (int) ($partitsAleatoris * 0.6),  // 60% normals
                'empats' => (int) ($partitsAleatoris * 0.2),   // 20% empats
                'victories' => (int) ($partitsAleatoris * 0.2), // 20% victories locals
            ];

            // Ajustar per arribar exactament al total
            $distribucio['normals'] += $partitsAleatoris - array_sum($distribucio);

            // Crear partits normals
            Partit::factory()->count($distribucio['normals'])->create();
            
            // Crear empats
            Partit::factory()->empat()->count($distribucio['empats'])->create();
            
            // Crear victories locals
            Partit::factory()->victoriaLocal()->count($distribucio['victories'])->create();

            $this->command->info("✅ Creats {$partitsAleatoris} partits aleatoris");
        }

        $total = Partit::count();
        $this->command->info("🏟️  Total de partits a la base de dades: {$total}");
    }
}