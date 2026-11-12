<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PublicLandingTest extends TestCase
{
    use RefreshDatabase;

    public function test_inicio_publico_muestra_la_galeria_y_no_los_enlaces_de_gestion(): void
    {
        $this->get('/')
            ->assertOk()
            ->assertSee('Galería de servicios y estilos')
            ->assertSee('Corte fade moderno')
            ->assertSee('VideoBarber.mp4')
            ->assertSee('Cortes definidos, barba impecable y atención a cada detalle.')
            ->assertSee('Iniciar sesión')
            ->assertSee('Registrarse')
            ->assertDontSee(route('servicios.index'));
    }

    public function test_la_vista_de_galeria_muestra_el_video_de_barberia(): void
    {
        $this->get(route('galeria'))
            ->assertOk()
            ->assertSee('VideoBarber.mp4')
            ->assertSee('Barba con carácter');
    }

    public function test_los_cruds_requieren_iniciar_sesion(): void
    {
        $this->get(route('servicios.index'))->assertRedirect(route('login'));
        $this->get(route('clientes.index'))->assertRedirect(route('login'));
        $this->get(route('citas.index'))->assertRedirect(route('login'));
        $this->get(route('servicios.pdf'))->assertRedirect(route('login'));
    }

    public function test_empleado_autenticado_puede_abrir_los_cruds(): void
    {
        $this->actingAs(User::factory()->empleado()->create());

        $this->get(route('servicios.index'))->assertOk();
        $this->get(route('clientes.index'))->assertOk();
        $this->get(route('citas.index'))->assertOk();
    }
}
