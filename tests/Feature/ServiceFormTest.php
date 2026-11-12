<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ServiceFormTest extends TestCase
{
    use RefreshDatabase;

    public function test_el_formulario_de_creacion_carga_correctamente()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/servicios/create');

        $response->assertStatus(200);
    }

    public function test_un_usuario_puede_enviar_el_formulario_y_guardar_el_registro()
    {
        $user = User::factory()->create();

        // Con esto le decimos a Laravel que nos muestre cualquier error de validación en crudo
        $this->withoutExceptionHandling();

        $datosFormulario = [
            'nombre' => 'Corte Clásico',
            'precio' => 25000,
            'descripcion' => 'Corte tradicional',
            'duracion_minutos' => 30 
        ];

        $response = $this->actingAs($user)->post('/servicios', $datosFormulario);

        $response->assertRedirect('/servicios');

        $this->assertDatabaseHas('servicios', [
            'nombre' => 'Corte Clásico',
            'precio' => 25000
        ]);
    }
}