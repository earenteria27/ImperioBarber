<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ClienteController extends Controller
{
    // Mostrar todos los clientes (con filtros y paginación)
    public function index(Request $request)
    {
        $clientes = Cliente::query()
            ->when($request->filled('buscar'), function ($q) use ($request) {
                $buscar = $request->buscar;
                $q->where(function ($sub) use ($buscar) {
                    $sub->where('nombre', 'like', "%{$buscar}%")
                        ->orWhere('telefono', 'like', "%{$buscar}%")
                        ->orWhere('email', 'like', "%{$buscar}%");
                });
            })
            ->orderBy('nombre')
            ->paginate(5)
            ->withQueryString();

        return view('clientes.index', compact('clientes'));
    }
    // Mostrar formulario para crear
    public function create()
    {
        return view('clientes.create');
    }

    // Guardar un nuevo cliente
    public function store(Request $request)
    {
        $datos = $request->validate([
            'nombre' => 'required|string|max:255',
            'telefono' => ['required', 'string', 'regex:/^[0-9]{7,15}$/', 'unique:clientes,telefono'],
            'email' => 'nullable|email|unique:clientes,email',
            'notas' => 'nullable|string',
        ], $this->mensajes());

        Cliente::create($datos);

        return redirect()->route('clientes.index')
            ->with('success', 'Cliente registrado correctamente.');
    }

    // Mostrar un cliente
    public function show(Cliente $cliente)
    {
        return view('clientes.show', compact('cliente'));
    }

    // Mostrar formulario para editar
    public function edit(Cliente $cliente)
    {
        return view('clientes.edit', compact('cliente'));
    }

    // Actualizar un cliente
    public function update(Request $request, Cliente $cliente)
    {
        $datos = $request->validate([
            'nombre' => 'required|string|max:255',
            'telefono' => [
                'required',
                'string',
                'regex:/^[0-9]{7,15}$/',
                Rule::unique('clientes', 'telefono')->ignore($cliente->id),
            ],
            'email' => [
                'nullable',
                'email',
                Rule::unique('clientes', 'email')->ignore($cliente->id),
            ],
            'notas' => 'nullable|string',
        ], $this->mensajes());

        $cliente->update($datos);

        return redirect()->route('clientes.index')
            ->with('success', 'Cliente actualizado correctamente.');
    }

    // Eliminar un cliente
    public function destroy(Cliente $cliente)
    {
        $cliente->delete();

        return redirect()->route('clientes.index')
            ->with('success', 'Cliente eliminado correctamente.');
    }

    // Mensajes de error en español para teléfono (RF-01)
    private function mensajes(): array
    {
        return [
            'telefono.required' => 'El teléfono es obligatorio.',
            'telefono.regex' => 'El teléfono solo puede tener números (entre 7 y 15 dígitos).',
            'telefono.unique' => 'Ya existe un cliente con este teléfono.',
        ];
    }
}
