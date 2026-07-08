<?php

namespace Tests\Feature;

use App\Models\Equipo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EquipoTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function muestra_el_listado_de_equipos(): void
    {
        Equipo::factory()->create(['nombre' => 'Laptop Dell 05']);

        $response = $this->get(route('equipos.index'));

        $response->assertStatus(200);
        $response->assertSee('Laptop Dell 05');
    }

    /** @test */
    public function puede_registrar_un_equipo(): void
    {
        $datos = [
            'nombre'    => 'Router TP-Link AC1200',
            'tipo'      => 'Router',
            'marca'     => 'TP-Link',
            'estado'    => 'disponible',
            'ubicacion' => 'Sala de Servidores',
        ];

        $response = $this->post(route('equipos.store'), $datos);

        $response->assertRedirect(route('equipos.index'));
        $this->assertDatabaseHas('equipos', ['nombre' => 'Router TP-Link AC1200']);
    }

    /** @test */
    public function no_permite_registrar_un_equipo_sin_nombre(): void
    {
        $response = $this->post(route('equipos.store'), [
            'nombre' => '',
            'tipo'   => 'Laptop',
            'estado' => 'disponible',
        ]);

        $response->assertSessionHasErrors('nombre');
        $this->assertDatabaseCount('equipos', 0);
    }

    /** @test */
    public function puede_actualizar_un_equipo(): void
    {
        $equipo = Equipo::factory()->create(['estado' => 'disponible']);

        $response = $this->put(route('equipos.update', $equipo), [
            'nombre'    => $equipo->nombre,
            'tipo'      => $equipo->tipo,
            'marca'     => $equipo->marca,
            'estado'    => 'mantenimiento',
            'ubicacion' => $equipo->ubicacion,
        ]);

        $response->assertRedirect(route('equipos.index'));
        $this->assertDatabaseHas('equipos', ['id' => $equipo->id, 'estado' => 'mantenimiento']);
    }

    /** @test */
    public function puede_eliminar_un_equipo(): void
    {
        $equipo = Equipo::factory()->create();

        $response = $this->delete(route('equipos.destroy', $equipo));

        $response->assertRedirect(route('equipos.index'));
        $this->assertDatabaseMissing('equipos', ['id' => $equipo->id]);
    }
}