<?php

namespace App\Http\Controllers;

use App\Models\Servicio;
use Illuminate\Http\Request;

class ServicioController extends Controller
{
    // Mostrar todos los servicios (con filtros y paginación)
    public function index(Request $request)
    {
        $servicios = Servicio::query()
            ->when($request->filled('buscar'), function ($q) use ($request) {
                $q->where('nombre', 'like', '%' . $request->buscar . '%');
            })
            ->when($request->filled('precio_min'), function ($q) use ($request) {
                $q->where('precio', '>=', $request->precio_min);
            })
            ->when($request->filled('precio_max'), function ($q) use ($request) {
                $q->where('precio', '<=', $request->precio_max);
            })
            ->orderBy('nombre')
            ->paginate(5)
            ->withQueryString();

        return view('servicios.index', compact('servicios'));
    }

    // Mostrar formulario para crear
    public function create()
    {
        return view('servicios.create');
    }

    // Guardar un nuevo servicio
    public function store(Request $request)
    {
        $datos = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric|min:0',
            'duracion_minutos' => 'required|integer|min:1',
        ]);

        Servicio::create($datos);

        return redirect()->route('servicios.index')
            ->with('success', 'Servicio registrado correctamente.');
    }

    // Mostrar un servicio
    public function show(Servicio $servicio)
    {
        return view('servicios.show', compact('servicio'));
    }

    // Mostrar formulario para editar
    public function edit(Servicio $servicio)
    {
        return view('servicios.edit', compact('servicio'));
    }

    // Actualizar un servicio
    public function update(Request $request, Servicio $servicio)
    {
        $datos = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric|min:0',
            'duracion_minutos' => 'required|integer|min:1',
        ]);

        $servicio->update($datos);

        return redirect()->route('servicios.index')
            ->with('success', 'Servicio actualizado correctamente.');
    }

    // Eliminar un servicio
    public function destroy(Servicio $servicio)
    {
        $servicio->delete();

        return redirect()->route('servicios.index')
            ->with('success', 'Servicio eliminado correctamente.');
    }
}
