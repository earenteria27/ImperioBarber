<?php

namespace App\Enums;

enum Role: string
{
    case Cliente = 'cliente';
    case Empleado = 'empleado';
    case Administrador = 'administrador';

    public function label(): string
    {
        return match ($this) {
            self::Cliente => 'Cliente',
            self::Empleado => 'Empleado',
            self::Administrador => 'Administrador',
        };
    }

    public static function values(): array
    {
        return array_map(fn (self $role) => $role->value, self::cases());
    }
}
