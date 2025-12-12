<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UsuarioController;

/*
|--------------------------------------------------------------------------
| Web Routes - Sistema SIRA
|--------------------------------------------------------------------------
*/

// 🌐 Página raíz redirige al login
Route::get('/', function () {
    return redirect('/login');
});

// ===================================================================
// 🔐 RUTAS PROTEGIDAS (solo usuarios autenticados)
// ===================================================================
Route::middleware(['auth'])->group(function () {

    // 🧭 Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // 👤 Perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // ===================================================================
    // 🧩 Módulo de Productos
    // ===================================================================
    
    // 🛡️ RUTAS SOLO PARA ADMIN (PRIMERO - más específicas)
    Route::middleware(['role:admin'])->prefix('productos')->group(function () {
        // Crear
        Route::get('/create', [ProductoController::class, 'create'])->name('productos.create');
        Route::post('/', [ProductoController::class, 'store'])->name('productos.store');
        
        // Movimiento de stock (ANTES de las rutas con {producto})
        Route::post('/{producto}/movimiento', [ProductoController::class, 'movimiento'])
            ->name('productos.movimiento');
        
        // Editar
        Route::get('/{producto}/edit', [ProductoController::class, 'edit'])->name('productos.edit');
        Route::put('/{producto}', [ProductoController::class, 'update'])->name('productos.update');
        
        // Eliminar
        Route::delete('/{producto}', [ProductoController::class, 'destroy'])->name('productos.destroy');
    });

    // 🔍 Rutas de consulta (AL FINAL - todos los usuarios autenticados)
    Route::get('/productos', [ProductoController::class, 'index'])->name('productos.index');
    Route::get('/productos/{producto}', [ProductoController::class, 'show'])->name('productos.show');

    // ===================================================================
    // 🏷️ Módulo de Categorías (solo admin)
    // ===================================================================
    Route::middleware(['role:admin'])->prefix('categorias')->group(function () {
        Route::get('/', [CategoriaController::class, 'index'])->name('categorias.index');
        Route::get('/create', [CategoriaController::class, 'create'])->name('categorias.create');
        Route::post('/', [CategoriaController::class, 'store'])->name('categorias.store');
        Route::get('/{categoria}/edit', [CategoriaController::class, 'edit'])->name('categorias.edit');
        Route::put('/{categoria}', [CategoriaController::class, 'update'])->name('categorias.update');
        Route::delete('/{categoria}', [CategoriaController::class, 'destroy'])->name('categorias.destroy');
    });
    // 👥 Módulo de Usuarios (solo admin)
// ===================================================================
Route::middleware(['role:admin'])->prefix('usuarios')->group(function () {
    Route::get('/', [UsuarioController::class, 'index'])->name('usuarios.index');
    Route::get('/create', [UsuarioController::class, 'create'])->name('usuarios.create');
    Route::post('/', [UsuarioController::class, 'store'])->name('usuarios.store');
    Route::get('/{usuario}/edit', [UsuarioController::class, 'edit'])->name('usuarios.edit');
    Route::put('/{usuario}', [UsuarioController::class, 'update'])->name('usuarios.update');
    Route::delete('/{usuario}', [UsuarioController::class, 'destroy'])->name('usuarios.destroy');
});

    // 🧰 Ruta temporal de depuración
    Route::get('/debug-role', function () {
        $user = auth()->user();
        return response()->json([
            'id'    => $user->id,
            'name'  => $user->name,
            'email' => $user->email,
            'role'  => $user->role,
        ]);
    });
});

// Rutas de autenticación
require __DIR__ . '/auth.php';