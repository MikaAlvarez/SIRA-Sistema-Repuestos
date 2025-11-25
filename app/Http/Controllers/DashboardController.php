<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Movimiento;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Estadísticas generales
        $totalProductos = Producto::count();
        $totalCategorias = Categoria::count();
        $stockBajo = Producto::where('stock', '<=', 5)->count();
        $valorInventario = Producto::sum(\DB::raw('stock * precio'));

        // Productos con stock bajo (alerta)
        $productosStockBajo = Producto::where('stock', '<=', 5)
            ->orderBy('stock', 'asc')
            ->limit(5)
            ->get();

        // Últimos movimientos (solo si eres admin)
        $ultimosMovimientos = collect();
        if (auth()->user()->role === 'admin') {
            $ultimosMovimientos = Movimiento::with('producto')
                ->latest()
                ->limit(10)
                ->get();
        }

        // Categorías con más productos
        $categoriasMasProductos = Categoria::withCount('productos')
            ->orderBy('productos_count', 'desc')
            ->limit(5)
            ->get();

        return view('dashboard', compact(
            'totalProductos',
            'totalCategorias',
            'stockBajo',
            'valorInventario',
            'productosStockBajo',
            'ultimosMovimientos',
            'categoriasMasProductos'
        ));
    }
}