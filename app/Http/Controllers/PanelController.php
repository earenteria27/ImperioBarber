<?php

namespace App\Http\Controllers;

use App\Enums\Role;
use App\Models\User;
use Illuminate\View\View;

class PanelController extends Controller
{
    public function cliente(): View
    {
        return view('panel.cliente');
    }

    public function empleado(): View
    {
        return view('panel.empleado');
    }

    public function admin(): View
    {
        $totales = [];
        foreach (Role::cases() as $role) {
            $totales[$role->label()] = User::where('role', $role->value)->count();
        }

        return view('panel.admin', ['totales' => $totales]);
    }
}
