<?php

namespace Tests\Feature;

use App\Enums\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RoleAuthorizationTest extends TestCase
{
    use RefreshDatabase;

    public function test_invitados_son_enviados_al_login(): void
    {
        $this->get('/dashboard')->assertRedirect(route('login'));
        $this->get('/cliente')->assertRedirect(route('login'));
        $this->get('/empleado')->assertRedirect(route('login'));
        $this->get('/admin')->assertRedirect(route('login'));
        $this->get('/admin/usuarios')->assertRedirect(route('login'));
    }

    public function test_dashboard_redirige_al_panel_segun_el_rol(): void
    {
        $this->actingAs(User::factory()->cliente()->create())
            ->get('/dashboard')->assertRedirect(route('panel.cliente'));

        $this->actingAs(User::factory()->empleado()->create())
            ->get('/dashboard')->assertRedirect(route('panel.empleado'));

        $this->actingAs(User::factory()->administrador()->create())
            ->get('/dashboard')->assertRedirect(route('panel.admin'));
    }

    public function test_cliente_solo_accede_a_su_panel(): void
    {
        $this->actingAs(User::factory()->cliente()->create());

        $this->get('/cliente')->assertOk();
        $this->get('/empleado')->assertForbidden();
        $this->get('/admin')->assertForbidden();
        $this->get('/admin/usuarios')->assertForbidden();
    }

    public function test_empleado_accede_a_su_panel_pero_no_a_administracion(): void
    {
        $this->actingAs(User::factory()->empleado()->create());

        $this->get('/empleado')->assertOk();
        $this->get('/cliente')->assertForbidden();
        $this->get('/admin')->assertForbidden();
        $this->get('/admin/usuarios')->assertForbidden();
    }

    public function test_administrador_accede_a_la_administracion(): void
    {
        $this->actingAs(User::factory()->administrador()->create());

        $this->get('/admin')->assertOk();
        $this->get('/admin/usuarios')->assertOk();
        $this->get('/empleado')->assertOk();
        $this->get('/cliente')->assertForbidden();
    }

    public function test_administrador_crea_un_empleado(): void
    {
        $this->actingAs(User::factory()->administrador()->create())
            ->post('/admin/usuarios', [
                'name' => 'Nuevo Barbero',
                'email' => 'barbero@example.com',
                'role' => 'empleado',
                'password' => 'clave1234',
                'password_confirmation' => 'clave1234',
            ])->assertRedirect(route('admin.usuarios.index'));

        $this->assertSame(
            Role::Empleado,
            User::where('email', 'barbero@example.com')->firstOrFail()->role
        );
    }

    public function test_cliente_no_puede_crear_usuarios(): void
    {
        $this->actingAs(User::factory()->cliente()->create())
            ->post('/admin/usuarios', [
                'name' => 'X',
                'email' => 'x@example.com',
                'role' => 'administrador',
                'password' => 'clave1234',
                'password_confirmation' => 'clave1234',
            ])->assertForbidden();

        $this->assertDatabaseMissing('users', ['email' => 'x@example.com']);
    }

    public function test_administrador_puede_cambiar_el_rol_de_otro_usuario(): void
    {
        $admin = User::factory()->administrador()->create();
        $otro = User::factory()->cliente()->create();

        $this->actingAs($admin)->put("/admin/usuarios/{$otro->id}", [
            'name' => $otro->name,
            'email' => $otro->email,
            'role' => 'empleado',
        ])->assertRedirect(route('admin.usuarios.index'));

        $this->assertSame(Role::Empleado, $otro->fresh()->role);
    }

    public function test_administrador_no_puede_cambiarse_su_propio_rol(): void
    {
        $admin = User::factory()->administrador()->create();

        $this->actingAs($admin)->put("/admin/usuarios/{$admin->id}", [
            'name' => $admin->name,
            'email' => $admin->email,
            'role' => 'cliente',
        ])->assertSessionHasErrors('role');

        $this->assertSame(Role::Administrador, $admin->fresh()->role);
    }

    public function test_administrador_no_puede_eliminarse_a_si_mismo(): void
    {
        $admin = User::factory()->administrador()->create();

        $this->actingAs($admin)->delete("/admin/usuarios/{$admin->id}")->assertForbidden();

        $this->assertDatabaseHas('users', ['id' => $admin->id]);
    }

    public function test_administrador_puede_eliminar_a_otro_usuario(): void
    {
        $admin = User::factory()->administrador()->create();
        $otro = User::factory()->cliente()->create();

        $this->actingAs($admin)->delete("/admin/usuarios/{$otro->id}")
            ->assertRedirect(route('admin.usuarios.index'));

        $this->assertDatabaseMissing('users', ['id' => $otro->id]);
    }
}
