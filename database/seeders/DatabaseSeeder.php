<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->administrador()->create([
            'name' => 'Administrador Imperio',
            'email' => 'admin@imperiobarber.test',
        ]);

        User::factory()->empleado()->create([
            'name' => 'Barbero Imperio',
            'email' => 'empleado@imperiobarber.test',
        ]);

        User::factory()->cliente()->create([
            'name' => 'Cliente Imperio',
            'email' => 'cliente@imperiobarber.test',
        ]);
    }
}
