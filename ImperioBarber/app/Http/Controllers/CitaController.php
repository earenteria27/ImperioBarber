<?php

namespace App\Http\Controllers;

use App\Enums\Role;
use App\Models\Cita;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CitaController extends Controller
{
    // Listar citas (con filtros y paginación). Cada rol ve lo suyo.
    public function index(Request $request)
    {
        $user = $request->user();

        $citas = Cita::query()
            ->select('citas.*')
            ->join('franjas', 'franjas.id', '=', 'citas.franja_id')
            ->with(['cliente', 'barbero', 'servicio', 'franja'])
            ->when($user->isEmpleado(), fn($q) => $q->where('citas.barbero_id', $user->id))
            ->when($user->isCliente(), fn($q) => $q->where('citas.cliente_id', $user->id))
            ->when($request->filled('fecha'), fn($q) => $q->where('franjas.fecha', $request->fecha))
            ->when($request->filled('estado'), fn($q) => $q->where('citas.estado', $request->estado))
            ->when($request->filled('barbero_id'), fn($q) => $q->where('citas.barbero_id', $request->barbero_id))
            ->orderBy('franjas.fecha')
            ->orderBy('franjas.hora_inicio')
            ->paginate(5)
            ->withQueryString();

        return view('citas.index', [
            'citas' => $citas,
            'barberos' => User::where('role', Role::Empleado->value)->orderBy('name')->get(),
        ]);
    }

    // Confirmar una cita pendiente
    public function confirmar(Request $request, Cita $cita): RedirectResponse
    {
        $this->autorizarGestion($request, $cita);

        if ($cita->estado !== 'pendiente') {
            return back()->withErrors(['estado' => 'Solo se pueden confirmar citas pendientes.']);
        }

        $cita->update(['estado' => 'confirmada']);

        return redirect()->route('citas.index')
            ->with('success', 'Cita confirmada correctamente.');
    }

    // Cancelar una cita y liberar su franja
    public function cancelar(Request $request, Cita $cita): RedirectResponse
    {
        $this->autorizarGestion($request, $cita);

        if ($cita->estado === 'cancelada') {
            return back()->withErrors(['estado' => 'Esta cita ya está cancelada.']);
        }

        DB::transaction(function () use ($cita) {
            $cita->update(['estado' => 'cancelada']);
            $cita->franja->update(['estado' => 'disponible']);
        });

        return redirect()->route('citas.index')
            ->with('success', 'Cita cancelada correctamente. El horario quedó disponible.');
    }

    // Solo el administrador, o el barbero dueño de la cita, pueden cambiar su estado
    private function autorizarGestion(Request $request, Cita $cita): void
    {
        $user = $request->user();

        abort_unless(
            $user->isAdmin() || ($user->isEmpleado() && $cita->barbero_id === $user->id),
            403,
            'No tienes permiso para gestionar esta cita.'
        );
    }
}
