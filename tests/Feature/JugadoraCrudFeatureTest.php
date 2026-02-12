<?php

namespace Tests\Feature;

use App\Models\Jugadora;
use App\Models\Equip;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Gate;
use Tests\TestCase;

class JugadoraCrudFeatureTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // ✅ Autorizar todo para no pelear con policies
        Gate::before(fn () => true);
    }

    public function test_es_pot_llistar_jugadores()
    {
        $u = User::factory()->create();
        $this->actingAs($u);

        Jugadora::factory()->create(['nom' => 'Alexia']);
        Jugadora::factory()->create(['nom' => 'Aitana']);

        $resp = $this->get('/jugadores');

        $resp->assertStatus(200);
        $resp->assertSee('Alexia');
        $resp->assertSee('Aitana');
    }

    public function test_es_pot_crear_una_jugadora()
    {
        $u = User::factory()->create([
            'role' => 'administrador',
            'email_verified_at' => now(),
        ]);
        $this->actingAs($u);

        $equip = Equip::factory()->create();

        $resp = $this->from(route('jugadores.create'))
            ->post('/jugadores', [
                'nom' => 'Alexia Putellas',
                'edat' => 29,
                'posicio' => 'Migcampista',
                'equip_id' => $equip->id,
            ]);

        $resp->assertSessionHasNoErrors();
        $resp->assertRedirect(route('jugadores.index'));

        $this->assertDatabaseHas('jugadores', [
            'nom' => 'Alexia Putellas',
            'edat' => 29,
            'posicio' => 'Migcampista',
            'equip_id' => $equip->id,
        ]);
    }

    public function test_es_pot_actualitzar_una_jugadora()
    {
        $u = User::factory()->create([
            'role' => 'manager',
            'email_verified_at' => now(),
        ]);
        $this->actingAs($u);

        $equip = Equip::factory()->create();
        $jugadora = Jugadora::factory()->create([
            'nom' => 'Alexia',
            'edat' => 28,
            'posicio' => 'Migcampista',
            'equip_id' => $equip->id,
        ]);

        $resp = $this->from(route('jugadores.edit', $jugadora))
            ->put("/jugadores/{$jugadora->id}", [
                'nom' => 'Alexia Putellas',
                'edat' => 29,
                'posicio' => 'Migcampista',
                'equip_id' => $equip->id,
            ]);

        $resp->assertSessionHasNoErrors();
        $resp->assertRedirect(route('jugadores.index'));

        $this->assertDatabaseHas('jugadores', [
            'id' => $jugadora->id,
            'nom' => 'Alexia Putellas',
            'edat' => 29,
        ]);
    }

    public function test_es_pot_esborrar_una_jugadora()
    {
        $u = User::factory()->create([
            'role' => 'administrador',
            'email_verified_at' => now(),
        ]);
        $this->actingAs($u);

        $jugadora = Jugadora::factory()->create();

        $resp = $this->from(route('jugadores.index'))
            ->delete("/jugadores/{$jugadora->id}");

        $resp->assertSessionHasNoErrors();
        $resp->assertRedirect(route('jugadores.index'));

        $this->assertDatabaseMissing('jugadores', [
            'id' => $jugadora->id,
        ]);
    }
}
