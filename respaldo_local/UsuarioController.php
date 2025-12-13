<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UsuarioController extends Controller
{
    // 📋 Listar todos los usuarios
    public function index()
    {
        $usuarios = User::orderBy('created_at', 'desc')->get();
        
        return view('usuarios.index', compact('usuarios'));
    }

    // ➕ Mostrar formulario de crear usuario
    public function create()
    {
        return view('usuarios.create');
    }

    // 💾 Guardar nuevo usuario
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => 'required|in:admin,empleado',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
        ]);

        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario creado correctamente.');
    }

    // ✏️ Mostrar formulario de editar usuario
    public function edit(User $usuario)
    {
        return view('usuarios.edit', compact('usuario'));
    }

    // 🔄 Actualizar usuario
public function update(Request $request, User $usuario)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email,' . $usuario->id,
        'role' => 'required|in:admin,empleado',
        'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
    ]);

    // 🛡️ Prevenir que el admin cambie su propio rol
    if ($usuario->id === auth()->id() && $validated['role'] !== auth()->user()->role) {
        return back()->withErrors(['role' => 'No puedes cambiar tu propio rol. Pide a otro administrador que lo haga.']);
    }

    $usuario->name = $validated['name'];
    $usuario->email = $validated['email'];
    $usuario->role = $validated['role'];

    // Solo actualizar contraseña si se proporciona
    if ($request->filled('password')) {
        $usuario->password = Hash::make($validated['password']);
    }

    $usuario->save();

    return redirect()->route('usuarios.index')
        ->with('success', 'Usuario actualizado correctamente.');
}

    // 🗑️ Eliminar usuario
    public function destroy(User $usuario)
    {
        // Prevenir que el admin se elimine a sí mismo
        if ($usuario->id === auth()->id()) {
            return back()->withErrors(['error' => 'No puedes eliminar tu propio usuario.']);
        }

        $usuario->delete();

        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario eliminado correctamente.');
    }
}