<?php

namespace Tests\Feature;

use App\Models\Cita;
use App\Models\Cliente;
use App\Models\Servicio;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CitaTest extends TestCase
{
    use RefreshDatabase;

    private User $clienteUsuario;

    protected function setUp(): void
    {
        parent::setUp();

        $this->clienteUsuario = User::factory()->cliente()->create();
        $this->actingAs($this->clienteUsuario);
    }

    public function test_usuario_puede_crear_una_cita(): void
    {
        $cliente = $this->clienteUsuario->ensureClienteProfile();
        $otroCliente = Cliente::create([
            'nombre' => 'Otro cliente',
            'telefono' => '3001234567',
            'email' => 'otro@example.com',
        ]);
        $servicio = Servicio::create([
            'nombre' => 'Corte clásico',
            'descripcion' => 'Corte con acabado premium',
            'precio' => 35000,
            'duracion_minutos' => 45,
        ]);

        $response = $this->post('/citas', [
            'cliente_id' => $otroCliente->id,
            'servicio_id' => $servicio->id,
            'fecha' => now()->addDay()->format('Y-m-d'),
            'hora' => '10:30',
            'estado' => 'confirmada',
            'notas' => 'Cliente solicita corte clásico.',
        ]);

        $response->assertRedirect('/citas');

        $this->assertDatabaseHas('citas', [
            'cliente_id' => $cliente->id,
            'servicio_id' => $servicio->id,
            'estado' => 'pendiente',
        ]);
    }

    public function test_cliente_solo_ve_sus_citas_y_no_puede_modificarlas(): void
    {
        $miCliente = $this->clienteUsuario->ensureClienteProfile();
        $otroCliente = Cliente::create([
            'nombre' => 'Cliente privado',
            'telefono' => '3109876543',
            'email' => 'privado@example.com',
        ]);
        $servicio = Servicio::create([
            'nombre' => 'Afeitado premium',
            'descripcion' => 'Afeitado con toalla caliente',
            'precio' => 25000,
            'duracion_minutos' => 30,
        ]);
        $miCita = Cita::create([
            'cliente_id' => $miCliente->id,
            'servicio_id' => $servicio->id,
            'fecha' => now()->addDay()->format('Y-m-d'),
            'hora' => '09:00',
            'estado' => 'pendiente',
        ]);
        $citaAjena = Cita::create([
            'cliente_id' => $otroCliente->id,
            'servicio_id' => $servicio->id,
            'fecha' => now()->addDay()->format('Y-m-d'),
            'hora' => '10:00',
            'estado' => 'pendiente',
        ]);

        $this->get('/citas')
            ->assertOk()
            ->assertSee($miCliente->nombre)
            ->assertDontSee($otroCliente->nombre)
            ->assertDontSee(route('citas.edit', $miCita));

        $this->put(route('citas.update', $miCita), [
            'servicio_id' => $servicio->id,
            'fecha' => now()->addDays(2)->format('Y-m-d'),
            'hora' => '11:00',
            'estado' => 'confirmada',
        ])->assertForbidden();

        $this->delete(route('citas.destroy', $citaAjena))->assertForbidden();
        $this->get(route('clientes.index'))->assertForbidden();
    }

    public function test_usuario_puede_actualizar_una_cita(): void
    {
        $this->actingAs(User::factory()->empleado()->create());

        $cliente = Cliente::create([
            'nombre' => 'Carlos Ruiz',
            'telefono' => '3109876543',
            'email' => 'carlos@example.com',
            'notas' => 'Frecuente.',
        ]);
        $servicio = Servicio::create([
            'nombre' => 'Afeitado premium',
            'descripcion' => 'Afeitado con toalla caliente',
            'precio' => 25000,
            'duracion_minutos' => 30,
        ]);
        $cita = Cita::create([
            'cliente_id' => $cliente->id,
            'servicio_id' => $servicio->id,
            'fecha' => now()->addDay()->format('Y-m-d'),
            'hora' => '09:00',
            'estado' => 'pendiente',
            'notas' => 'Sin cambios',
        ]);

        $response = $this->put("/citas/{$cita->id}", [
            'cliente_id' => $cliente->id,
            'servicio_id' => $servicio->id,
            'fecha' => now()->addDays(2)->format('Y-m-d'),
            'hora' => '11:00',
            'estado' => 'confirmada',
            'notas' => 'Cita confirmada por el cliente.',
        ]);

        $response->assertRedirect('/citas');
        $this->assertDatabaseHas('citas', [
            'id' => $cita->id,
            'estado' => 'confirmada',
            'hora' => '11:00',
        ]);
    }
}
