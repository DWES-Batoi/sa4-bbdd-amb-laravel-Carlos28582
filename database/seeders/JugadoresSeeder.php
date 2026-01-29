<?php

namespace Database\Seeders;

use App\Models\Jugadora;
use App\Models\Equip;
use Illuminate\Database\Seeder;

class JugadoresSeeder extends Seeder
{
    public function run(): void
    {
        $barca   = Equip::where('nom', 'Barça Femení')->first();
        $madrid  = Equip::where('nom', 'Real Madrid Femení')->first();
        $atleti  = Equip::where('nom', 'Atlètic de Madrid')->first();

        Jugadora::create([
            'nom' => 'Alexia Putellas',
            'edat' => 29,
            'posicio' => 'Migcampista',
            'equip_id' => $barca->id,
        ]);

        Jugadora::create([
            'nom' => 'Aitana Bonmatí',
            'edat' => 26,
            'posicio' => 'Migcampista',
            'equip_id' => $barca->id,
        ]);

        Jugadora::create([
            'nom' => 'Olga Carmona',
            'edat' => 24,
            'posicio' => 'Defensa',
            'equip_id' => $madrid->id,
        ]);

        Jugadora::create([
            'nom' => 'Esther González',
            'edat' => 31,
            'posicio' => 'Davantera',
            'equip_id' => $atleti->id,
        ]);

        dump('JugadoresSeeder - després de crear:', Jugadora::count());
    }
}
