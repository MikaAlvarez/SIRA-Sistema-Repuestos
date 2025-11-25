<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Producto;

class ProductoSeeder extends Seeder
{
    public function run(): void
{
    // Desactivamos las restricciones de clave foránea temporalmente
    \DB::statement('SET FOREIGN_KEY_CHECKS=0;');

    // Borramos los datos manualmente (sin truncar)
    \App\Models\StockMovimiento::query()->delete();
    \App\Models\Producto::query()->delete();

    // Reactivamos las restricciones
    \DB::statement('SET FOREIGN_KEY_CHECKS=1;');

    // Ahora creamos los productos de prueba
    \App\Models\Producto::create([
        'codigo' => 'P001',
        'nombre' => 'Filtro de aceite',
        'categoria' => 'Filtros',
        'stock' => 30,
        'precio' => 4500.00,
    ]);

    \App\Models\Producto::create([
        'codigo' => 'P002',
        'nombre' => 'Bujía NGK',
        'categoria' => 'Encendido',
        'stock' => 50,
        'precio' => 2500.00,
    ]);

    \App\Models\Producto::create([
        'codigo' => 'P003',
        'nombre' => 'Aceite sintético 5W30',
        'categoria' => 'Lubricantes',
        'stock' => 20,
        'precio' => 9500.00,
    ]);

    \App\Models\Producto::create([
        'codigo' => 'P004',
        'nombre' => 'Pastillas de freno',
        'categoria' => 'Frenos',
        'stock' => 15,
        'precio' => 7800.00,
    ]);
}
}