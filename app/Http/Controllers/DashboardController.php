<?php

namespace App\Http\Controllers;

use App\Enums\Role;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke(Request $request): RedirectResponse
    {
        $route = match ($request->user()->role) {
            Role::Administrador => 'panel.admin',
            Role::Empleado => 'panel.empleado',
            default => 'panel.cliente',
        };

        return redirect()->route($route);
    }
}
