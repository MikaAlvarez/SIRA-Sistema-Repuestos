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