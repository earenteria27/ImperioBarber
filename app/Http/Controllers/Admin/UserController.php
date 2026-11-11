<?php

namespace App\Http\Controllers\Admin;

use App\Enums\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(): View
    {
        Gate::authorize('viewAny', User::class);

        return view('admin.users.index', [
            'users' => User::orderBy('name')->paginate(10),
        ]);
    }

    public function create(): View
    {
        Gate::authorize('create', User::class);

        return view('admin.users.create', ['roles' => Role::cases()]);
    }

    public function store(StoreUserRequest $request): RedirectResponse
    {
        $user = new User($request->safe()->except('role'));
        $user->role = Role::from($request->validated('role'));
        $user->save();

        return redirect()->route('admin.usuarios.index')
            ->with('status', 'Usuario creado correctamente.');
    }

    public function edit(User $user): View
    {
        Gate::authorize('update', $user);

        return view('admin.users.edit', [
            'user' => $user,
            'roles' => Role::cases(),
        ]);
    }

    public function update(UpdateUserRequest $request, User $user): RedirectResponse
    {
        $newRole = Role::from($request->validated('role'));

        if ($user->is($request->user()) && $newRole !== $user->role) {
            return back()
                ->withErrors(['role' => 'No puedes cambiar tu propio rol.'])
                ->withInput();
        }

        $user->fill($request->safe()->except(['role', 'password']));

        if ($request->filled('password')) {
            $user->password = $request->validated('password');
        }

        $user->role = $newRole;
        $user->save();

        return redirect()->route('admin.usuarios.index')
            ->with('status', 'Usuario actualizado correctamente.');
    }

    public function destroy(User $user): RedirectResponse
    {
        Gate::authorize('delete', $user);

        $user->delete();

        return redirect()->route('admin.usuarios.index')
            ->with('status', 'Usuario eliminado correctamente.');
    }
}
