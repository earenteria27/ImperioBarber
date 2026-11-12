<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\Cliente;
use App\Models\Servicio;
use Illuminate\Http\Request;

class CitaController extends Controller
{
    public function index(Request $request)
    {
        $citas = Cita::with(['cliente', 'servicio'])
            ->when($request->user()->isCliente(), function ($query) use ($request) {
                $query->whereHas('cliente', function ($clienteQuery) use ($request) {
                    $clienteQuery->where('user_id', $request->user()->id);
                });
            })
            ->orderBy('fecha')
            ->orderBy('hora')
            ->paginate(10);

        return view('citas.index', compact('citas'));
    }

    public function create(Request $request)
    {
        $clientes = $request->user()->isCliente()
            ? collect()
            : Cliente::orderBy('nombre')->get();
        $servicios = Servicio::orderBy('nombre')->get();

        return view('citas.create', compact('clientes', 'servicios'));
    }

    public function store(Request $request)
    {
        $reglas = [
            'servicio_id' => ['required', 'exists:servicios,id'],
            'fecha' => ['required', 'date', 'after_or_equal:today'],
            'hora' => ['required', 'date_format:H:i'],
            'notas' => ['nullable', 'string', 'max:1000'],
        ];

        if ($request->user()->isCliente()) {
            $datos = $request->validate($reglas);
            $datos['cliente_id'] = $request->user()->ensureClienteProfile()->id;
            $datos['estado'] = 'pendiente';
        } else {
            $datos = $request->validate($reglas + [
                'cliente_id' => ['required', 'exists:clientes,id'],
                'estado' => ['required', 'in:pendiente,confirmada,completada,cancelada'],
            ]);
        }

        Cita::create($datos);

        return redirect()->route('citas.index')
            ->with('success', 'Cita registrada correctamente.');
    }

    public function edit(Cita $cita)
    {
        $clientes = Cliente::orderBy('nombre')->get();
        $servicios = Servicio::orderBy('nombre')->get();

        return view('citas.edit', compact('cita', 'clientes', 'servicios'));
    }

    public function update(Request $request, Cita $cita)
    {
        $datos = $request->validate([
            'cliente_id' => ['required', 'exists:clientes,id'],
            'servicio_id' => ['required', 'exists:servicios,id'],
            'fecha' => ['required', 'date', 'after_or_equal:today'],
            'hora' => ['required', 'date_format:H:i'],
            'estado' => ['required', 'in:pendiente,confirmada,completada,cancelada'],
            'notas' => ['nullable', 'string', 'max:1000'],
        ]);

        $cita->update($datos);

        return redirect()->route('citas.index')
            ->with('success', 'Cita actualizada correctamente.');
    }

    public function destroy(Cita $cita)
    {
        $cita->delete();

        return redirect()->route('citas.index')
            ->with('success', 'Cita eliminada correctamente.');
    }
}
