<?php

namespace App\Http\Controllers;

use App\Enums\Role;
use App\Models\Franja;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class FranjaController extends Controller
{
    // Listar franjas (con filtros y paginación)
    public function index(Request $request)
    {
        $franjas = Franja::with('barbero')
            ->when($request->filled('barbero_id'), function ($q) use ($request) {
                $q->where('barbero_id', $request->barbero_id);
            })
            ->when($request->filled('fecha'), function ($q) use ($request) {
                $q->whereDate('fecha', $request->fecha);
            })
            ->when($request->filled('estado'), function ($q) use ($request) {
                $q->where('estado', $request->estado);
            })
            ->orderBy('fecha')
            ->orderBy('hora_inicio')
            ->paginate(5)
            ->withQueryString();

        return view('franjas.index', [
            'franjas' => $franjas,
            'barberos' => $this->barberos(false),
        ]);
    }

    // Formulario para crear
    public function create()
    {
        return view('franjas.create', [
            'barberos' => $this->barberos(),
        ]);
    }

    // Guardar una nueva franja
    public function store(Request $request)
    {
        $datos = $request->validate([
            'barbero_id' => ['required', $this->reglaBarbero()],
            'fecha' => ['required', 'date', 'after_or_equal:today'],
            'hora_inicio' => [
                'required',
                'date_format:H:i',
                Rule::unique('franjas', 'hora_inicio')->where(function ($q) use ($request) {
                    $q->where('barbero_id', $request->barbero_id)
                        ->where('fecha', $request->fecha);
                }),
            ],
            'hora_fin' => ['required', 'date_format:H:i', 'after:hora_inicio'],
        ], $this->mensajes());

        Franja::create($datos);

        return redirect()->route('franjas.index')
            ->with('success', 'Franja registrada correctamente.');
    }

    // Formulario para editar
    public function edit(Franja $franja)
    {
        return view('franjas.edit', [
            'franja' => $franja,
            'barberos' => $this->barberos(false),
        ]);
    }

    // Actualizar una franja
    public function update(Request $request, Franja $franja)
    {
        $datos = $request->validate([
            'barbero_id' => ['required', Rule::exists('users', 'id')->where('role', Role::Empleado->value)],
            'fecha' => ['required', 'date'],
            'hora_inicio' => [
                'required',
                'date_format:H:i',
                Rule::unique('franjas', 'hora_inicio')
                    ->where(function ($q) use ($request) {
                        $q->where('barbero_id', $request->barbero_id)
                            ->where('fecha', $request->fecha);
                    })
                    ->ignore($franja->id),
            ],
            'hora_fin' => ['required', 'date_format:H:i', 'after:hora_inicio'],
            'estado' => ['required', Rule::in(['disponible', 'ocupada'])],
        ], $this->mensajes());

        $franja->update($datos);

        return redirect()->route('franjas.index')
            ->with('success', 'Franja actualizada correctamente.');
    }

    // Eliminar una franja
    public function destroy(Franja $franja)
    {
        $franja->delete();

        return redirect()->route('franjas.index')
            ->with('success', 'Franja eliminada correctamente.');
    }

    // Barberos = usuarios con rol empleado (por defecto solo los activos)
    private function barberos(bool $soloActivos = true)
    {
        return User::where('role', Role::Empleado->value)
            ->when($soloActivos, fn($q) => $q->where('activo', true))
            ->orderBy('name')
            ->get();
    }

    // Un barbero válido es un empleado activo
    private function reglaBarbero()
    {
        return Rule::exists('users', 'id')->where(function ($q) {
            $q->where('role', Role::Empleado->value)->where('activo', true);
        });
    }

    private function mensajes(): array
    {
        return [
            'barbero_id.required' => 'Selecciona un barbero.',
            'barbero_id.exists' => 'El barbero seleccionado no es válido o está desactivado.',
            'fecha.required' => 'La fecha es obligatoria.',
            'fecha.date' => 'Ingresa una fecha válida.',
            'fecha.after_or_equal' => 'La fecha no puede ser anterior a hoy.',
            'hora_inicio.required' => 'La hora de inicio es obligatoria.',
            'hora_inicio.date_format' => 'Ingresa una hora válida.',
            'hora_inicio.unique' => 'Ya existe una franja para ese barbero, fecha y hora de inicio.',
            'hora_fin.required' => 'La hora de fin es obligatoria.',
            'hora_fin.date_format' => 'Ingresa una hora válida.',
            'hora_fin.after' => 'La hora de fin debe ser posterior a la hora de inicio.',
            'estado.in' => 'El estado debe ser disponible u ocupada.',
        ];
    }
}
