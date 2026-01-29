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
        $campNou = Estadi::where('nom', 'Camp Nou')->first();
        $wanda   = Estadi::where('nom', 'Wanda Metropolitano')->first();

        $barca  = Equip::where('nom', 'Barça Femení')->first();
        $madrid = Equip::where('nom', 'Real Madrid Femení')->first();
        $atleti = Equip::where('nom', 'Atlètic de Madrid')->first();

        Partit::create([
            'estadi_id' => $campNou->id,
            'equip_local_id' => $barca->id,
            'equip_visitant_id' => $madrid->id,
            'resultat' => '2 - 1',
        ]);

        Partit::create([
            'estadi_id' => $wanda->id,
            'equip_local_id' => $atleti->id,
            'equip_visitant_id' => $barca->id,
            'resultat' => '0 - 3',
        ]);

        dump('PartitsSeeder - després de crear:', Partit::count());
    }
}
