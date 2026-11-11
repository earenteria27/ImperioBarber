<?php

namespace Tests\Feature;

use App\Enums\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_pantallas_de_login_y_registro_se_muestran(): void
    {
        $this->get('/login')->assertOk();
        $this->get('/registro')->assertOk();
    }

    public function test_usuario_puede_iniciar_sesion_con_credenciales_correctas(): void
    {
        $user = User::factory()->cliente()->create();

        $this->post('/login', ['email' => $user->email, 'password' => 'password'])
            ->assertRedirect(route('dashboard'));

        $this->assertAuthenticatedAs($user);
    }

    public function test_no_inicia_sesion_con_contrasena_incorrecta(): void
    {
        $user = User::factory()->create();

        $this->from('/login')
            ->post('/login', ['email' => $user->email, 'password' => 'incorrecta'])
            ->assertRedirect('/login')
            ->assertSessionHasErrors('email');

        $this->assertGuest();
    }

    public function test_usuario_puede_cerrar_sesion(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)->post('/logout')->assertRedirect(route('home'));

        $this->assertGuest();
    }

    public function test_registro_crea_un_cliente_y_abre_sesion(): void
    {
        $this->post('/registro', [
            'name' => 'Juan Pérez',
            'email' => 'juan@example.com',
            'password' => 'clave1234',
            'password_confirmation' => 'clave1234',
        ])->assertRedirect(route('dashboard'));

        $user = User::where('email', 'juan@example.com')->firstOrFail();

        $this->assertSame(Role::Cliente, $user->role);
        $this->assertAuthenticatedAs($user);
    }

    public function test_registro_publico_no_permite_elegir_rol(): void
    {
        $this->post('/registro', [
            'name' => 'Intruso',
            'email' => 'intruso@example.com',
            'password' => 'clave1234',
            'password_confirmation' => 'clave1234',
            'role' => 'administrador',
        ]);

        $this->assertSame(
            Role::Cliente,
            User::where('email', 'intruso@example.com')->firstOrFail()->role
        );
    }

    public function test_usuario_autenticado_no_ve_login(): void
    {
        $this->actingAs(User::factory()->create())
            ->get('/login')
            ->assertRedirect(route('dashboard'));
    }
}
