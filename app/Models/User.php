<?php

namespace App\Models;

use App\Enums\Role;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'telefono',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'role' => Role::class,
        ];
    }

    public function cliente(): HasOne
    {
        return $this->hasOne(Cliente::class);
    }

    public function ensureClienteProfile(): Cliente
    {
        $cliente = $this->cliente()->first()
            ?? Cliente::firstOrNew(['email' => $this->email]);

        $cliente->user_id = $this->id;
        $cliente->nombre = $cliente->nombre ?: $this->name;
        $cliente->telefono = $cliente->telefono ?? $this->telefono;
        $cliente->email = $this->email;
        $cliente->save();

        return $cliente;
    }

    public function hasRole(Role|string ...$roles): bool
    {
        foreach ($roles as $role) {
            $value = $role instanceof Role ? $role->value : $role;

            if ($this->role?->value === $value) {
                return true;
            }
        }

        return false;
    }

    public function isAdmin(): bool
    {
        return $this->hasRole(Role::Administrador);
    }

    public function isEmpleado(): bool
    {
        return $this->hasRole(Role::Empleado);
    }

    public function isCliente(): bool
    {
        return $this->hasRole(Role::Cliente);
    }
}
