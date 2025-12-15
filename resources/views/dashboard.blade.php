
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        </h2>
    </x-slot>

    <div class="py-10 bg-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- 🔴 Mensaje de bienvenida --}}
            <div class="bg-gradient-to-r from-red-600 to-red-700 shadow-xl rounded-xl p-7 text-white">
                <h3 class="text-2xl font-extrabold mb-1">
                    ¡Hola, {{ auth()->user()->name }}! 👋
                </h3>

                <p class="text-red-100 text-sm tracking-wide">
                    Sistema Integral de Repuestos Automotores
                </p>

                <p class="text-sm mt-2">
                    Rol: 
                    <span class="font-semibold text-white px-2 py-0.5 rounded bg-red-800/40">
                        {{ auth()->user()->role === 'admin' ? '👑 Administrador' : '👤 Empleado' }}
                    </span>
                </p>
            </div>

            {{-- 🔴 Tarjetas principales --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

                {{-- Total Productos --}}
                <div class="bg-white shadow-md hover:shadow-lg transition rounded-xl p-6 border-t-4 border-red-600">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500 uppercase font-semibold tracking-wide">Total Productos</p>
                            <p class="text-3xl font-extrabold text-gray-900 mt-2">
                                {{ $totalProductos }}
                            </p>
                        </div>

                        <div class="bg-red-100 p-3 rounded-full shadow">
                            <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                            </svg>
                        </div>
                    </div>
                </div>

                {{-- Categorías --}}
                <div class="bg-white shadow-md hover:shadow-lg transition rounded-xl p-6 border-t-4 border-gray-800">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500 uppercase font-semibold tracking-wide">Categorías</p>
                            <p class="text-3xl font-extrabold text-gray-900 mt-2">
                                {{ $totalCategorias }}
                            </p>
                        </div>

                        <div class="bg-gray-200 p-3 rounded-full shadow">
                            <svg class="w-8 h-8 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                {{-- Stock bajo --}}
                <div class="bg-white shadow-md hover:shadow-lg transition rounded-xl p-6 border-t-4 border-yellow-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500 uppercase font-semibold tracking-wide">Stock Bajo</p>
                            <p class="text-3xl font-extrabold text-red-600 mt-2">
                                {{ $stockBajo }}
                            </p>
                            <p class="text-xs text-gray-500 mt-1">
                                ≤ 5 unidades
                            </p>
                        </div>

                        <div class="bg-yellow-100 p-3 rounded-full shadow">
                            <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                {{-- Valor inventario --}}
                @if(auth()->user()->role === 'admin')
                <div class="bg-white shadow-md hover:shadow-lg transition rounded-xl p-6 border-t-4 border-green-600">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500 uppercase font-semibold tracking-wide">Valor de Inventario</p>
                            <p class="text-3xl font-extrabold text-green-700 mt-2">
                                ${{ number_format($valorInventario, 0, ',', '.') }}
                            </p>
                        </div>

                        <div class="bg-green-100 p-3 rounded-full shadow">
                            <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    </div>
                </div>
            @endif
            </div>

            {{-- 🔴 Dos columnas --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                {{-- Productos con stock bajo --}}
                <div class="bg-white shadow-md hover:shadow-lg transition rounded-xl p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-bold text-gray-900">⚠ Productos con Stock Bajo</h3>
                        <a href="{{ route('productos.index') }}" class="text-sm text-red-600 hover:underline font-semibold">Ver todos</a>
                    </div>

                    @if($productosStockBajo->isEmpty())
                        <p class="text-gray-500 text-center py-4">No hay productos con stock bajo</p>
                    @else
                        <div class="space-y-3">
                            @foreach($productosStockBajo as $producto)
                                <div class="flex items-center justify-between p-3 bg-red-50 rounded-lg border border-red-200 shadow-sm">
                                    <div>
                                        <p class="font-semibold text-gray-900">{{ $producto->nombre }}</p>
                                        <p class="text-xs text-gray-500">{{ $producto->codigo }}</p>
                                    </div>
                                    <span class="px-3 py-1 bg-red-600 text-white rounded-full text-sm font-bold shadow">
                                        {{ $producto->stock }} unid.
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                {{-- Categorías con más productos --}}
                <div class="bg-white shadow-md hover:shadow-lg transition rounded-xl p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-bold text-gray-900">🏷 Categorías Principales</h3>
                        @if(auth()->user()->role === 'admin')
                            <a href="{{ route('categorias.index') }}" class="text-sm text-red-600 hover:underline font-semibold">Ver todas</a>
                        @endif
                    </div>

                    @if($categoriasMasProductos->isEmpty())
                        <p class="text-gray-500 text-center py-4">No hay categorías registradas</p>
                    @else
                        <div class="space-y-3">
                            @foreach($categoriasMasProductos as $categoria)
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="font-semibold text-gray-900">{{ $categoria->nombre }}</p>
                                    </div>
                                    <div class="flex items-center gap-3">
                                        <div class="w-32 bg-gray-200 rounded-full h-2 overflow-hidden">
                                            <div class="bg-red-600 h-2 rounded-full"
                                                 style="width: {{ $totalProductos > 0 ? ($categoria->productos_count / $totalProductos * 100) : 0 }}%">
                                            </div>
                                        </div>
                                        <span class="text-sm font-bold text-gray-700">
                                            {{ $categoria->productos_count }}
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

            </div>


            {{-- Últimos movimientos --}}
            @if(auth()->user()->role === 'admin' && $ultimosMovimientos->isNotEmpty())
                <div class="bg-white shadow-md hover:shadow-lg transition rounded-xl p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">📋 Últimos Movimientos</h3>

                    <div class="overflow-x-auto">
                        <table class="min-w-full text-sm rounded-lg overflow-hidden">
                            <thead class="bg-gray-100 text-xs uppercase text-gray-600">
                                <tr>
                                    <th class="p-2 text-left">Fecha</th>
                                    <th class="p-2 text-left">Producto</th>
                                    <th class="p-2 text-center">Tipo</th>
                                    <th class="p-2 text-right">Cantidad</th>
                                    <th class="p-2 text-left">Observación</th>
                                </tr>
                            </thead>

                            <tbody class="divide-y">
                                @foreach($ultimosMovimientos as $mov)
                                    <tr class="hover:bg-gray-50 transition">
                                        <td class="p-2">{{ $mov->created_at->format('d/m H:i') }}</td>
                                        <td class="p-2 font-semibold text-gray-800">{{ $mov->producto->nombre ?? '-' }}</td>

                                        <td class="p-2 text-center">
                                            <span class="px-2 py-1 rounded-full text-xs font-bold
                                                {{ $mov->tipo === 'entrada'
                                                    ? 'bg-green-100 text-green-700'
                                                    : 'bg-red-100 text-red-700' }}">
                                                {{ $mov->tipo === 'entrada' ? '⬆ Entrada' : '⬇ Salida' }}
                                            </span>
                                        </td>

                                        <td class="p-2 text-right font-bold">{{ $mov->cantidad }}</td>
                                        <td class="p-2 text-gray-600 text-xs">{{ $mov->observacion ?? '-' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
