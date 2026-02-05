<?php

namespace Tests\Unit;

use App\Models\Jugadora;
use App\Models\Equip;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class JugadoraModelTest extends TestCase
{
    use RefreshDatabase;

    public function test_fillable_funciona_correctament()
    {
        $equip = Equip::factory()->create();
        $jugadora = Jugadora::create([
            
            'nom' => 'Aitana',
            'edat' => 24,
            'posicio' => 'Migcampista',
            'equip_id' => $equip->id,
        ]);

        $this->assertEquals('Aitana', $jugadora->nom);
        $this->assertEquals(24, $jugadora->edat);
    }

    public function test_una_jugadora_pertany_a_un_equip()
    {
        $equip = Equip::factory()->create(['nom' => 'FC Barcelona']);
        $jugadora = Jugadora::factory()->create([
            'equip_id' => $equip->id,
        ]);

        $this->assertInstanceOf(Equip::class, $jugadora->equip);
        $this->assertEquals('FC Barcelona', $jugadora->equip->nom);
    }
}
