<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductoController extends Controller
{
    /**
     * NO usar autorización automática de recursos.
     */
    public function __construct()
    {
        // Desactivar autorización automática
    }

    // 📋 Listar productos
    public function index(Request $request)
    {
        $q = $request->input('q');
        $categoria = $request->input('categoria');

        $productos = Producto::query()
            ->when($q, function ($query) use ($q) {
                $query->where('nombre', 'like', "%{$q}%")
                    ->orWhere('codigo', 'like', "%{$q}%");
            })
            ->when($categoria, fn($query) => $query->where('categoria', $categoria))
            ->orderBy('nombre')
            ->paginate(15);

        return view('productos.index', compact('productos'));
    }

    // ➕ Crear producto
    public function create()
    {
        return view('productos.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'codigo' => 'required|string|max:50|unique:productos,codigo',
            'nombre' => 'required|string|max:255',
            'categoria' => 'nullable|string|max:100',
            'stock' => 'required|integer|min:0',
            'precio' => 'required|numeric|min:0.01',
        ]);

        Producto::create($validated);

        return redirect()->route('productos.index')
            ->with('success', 'Producto creado correctamente.');
    }

    // 👁️ Mostrar detalles
    public function show(Producto $producto)
    {
        $movimientos = $producto->movimientos()->latest()->take(20)->get();

        return view('productos.show', compact('producto', 'movimientos'));
    }

    // ✏️ Editar producto
    public function edit(Producto $producto)
    {
        return view('productos.edit', compact('producto'));
    }

    public function update(Request $request, Producto $producto)
    {
        logger('🎯 ProductoController@update ejecutado', [
            'user' => auth()->user()?->only(['id','name','role']),
            'producto_id' => $producto->id,
            'datos' => $request->all(),
        ]);

        $validated = $request->validate([
            'codigo' => 'required|string|max:50|unique:productos,codigo,' . $producto->id,
            'nombre' => 'required|string|max:255',
            'categoria' => 'nullable|string|max:100',
            'stock' => 'required|integer|min:0',
            'precio' => 'required|numeric|min:0.01',
        ]);

        $producto->update($validated);

        logger('✅ Producto actualizado correctamente', ['producto_id' => $producto->id]);

        return redirect()->route('productos.index')
            ->with('success', 'Producto actualizado correctamente.');
    }

    // 🗑️ Eliminar producto
    public function destroy(Producto $producto)
    {
        logger('🎯 ProductoController@destroy ejecutado', [
            'user' => auth()->user()?->only(['id','name','role']),
            'producto_id' => $producto->id,
        ]);

        $producto->delete();

        return redirect()->route('productos.index')
            ->with('success', 'Producto eliminado correctamente.');
    }

    // 🔁 Registrar movimiento de stock
    public function movimiento(Request $request, Producto $producto)
    {
        logger('🎯 ProductoController@movimiento ejecutado', [
            'user' => auth()->user()?->only(['id','name','role']),
            'producto_id' => $producto->id,
            'datos' => $request->all(),
        ]);

        $validated = $request->validate([
            'tipo' => 'required|in:entrada,salida',
            'cantidad' => 'required|integer|min:1',
            'observacion' => 'nullable|string|max:255',
        ]);

        // Calcular nuevo stock
        $nuevoStock = $producto->stock;
        if ($validated['tipo'] === 'entrada') {
            $nuevoStock += $validated['cantidad'];
        } else {
            $nuevoStock -= $validated['cantidad'];
            
            // Validar que no quede stock negativo
            if ($nuevoStock < 0) {
                return back()->withErrors(['cantidad' => 'Stock insuficiente para realizar la salida.']);
            }
        }

        // Actualizar stock
        $producto->update(['stock' => $nuevoStock]);

        // Registrar movimiento
        $producto->movimientos()->create([
            'tipo' => $validated['tipo'],
            'cantidad' => $validated['cantidad'],
            'observacion' => $validated['observacion'] ?? null,
            'user_id' => auth()->id(),
        ]);

        logger('✅ Movimiento registrado correctamente', [
            'producto_id' => $producto->id,
            'nuevo_stock' => $nuevoStock,
        ]);

        return redirect()->route('productos.show', $producto)
            ->with('success', 'Movimiento registrado correctamente. Stock actual: ' . $nuevoStock);
    }
}