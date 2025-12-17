<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800">
         Gestión de Productos
        </h2>
    </x-slot>

    <div class="py-10 bg-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Toast --}}
            @if(session('message'))
                <x-alert-toast />
            @endif

            {{-- 🔍 BÚSQUEDA + NUEVO PRODUCTO --}}
            <div class="bg-white shadow-md rounded-lg p-6 flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                {{-- Filtros --}}
                <form method="GET" action="{{ route('productos.index') }}" class="flex flex-wrap gap-3 items-center w-full md:w-auto">

                    {{-- Input búsqueda --}}
                    <div class="relative">
                        <span class="absolute left-3 top-2.5 text-gray-400">
                            🔍
                        </span>
                        <input type="text" name="q" value="{{ request('q') }}"
                               class="pl-9 rounded-md border-gray-300 text-sm w-64 focus:border-red-600 focus:ring-red-600"
                               placeholder="Buscar por nombre o código">
                    </div>

                    {{-- Categorías --}}
                    <select name="categoria"
                        class="rounded-md border-gray-300 text-sm focus:border-red-600 focus:ring-red-600">
                        <option value="">Todas las categorías</option>
                        @foreach(\App\Models\Producto::select('categoria')->distinct()->pluck('categoria') as $c)
                            <option value="{{ $c }}" {{ request('categoria') == $c ? 'selected' : '' }}>
                                {{ $c }}
                            </option>
                        @endforeach
                    </select>

                    {{-- Botón buscar --}}
                    <button type="submit"
                        class="bg-red-600 hover:bg-red-700 text-white text-sm px-4 py-2 rounded-md shadow">
                        Buscar
                    </button>
                </form>

                {{-- NUEVO PRODUCTO --}}
                @if(auth()->user()->role === 'admin')
                <a href="{{ route('productos.create') }}"
                   class="inline-flex items-center bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md text-sm shadow">
                    ➕ Nuevo producto
                </a>
                @endif
            </div>

            {{-- 📋 TABLA --}}
            <div class="bg-white shadow-md rounded-lg p-6 overflow-x-auto">

                <table class="min-w-full text-sm text-gray-700 border border-gray-200 rounded-md overflow-hidden">
                    <thead class="bg-gray-100 border-b text-gray-900 uppercase text-xs font-semibold tracking-wide">
                        <tr>
                            <th class="py-3 px-4 text-left">Código</th>
                            <th class="py-3 px-4 text-left">Nombre</th>
                            <th class="py-3 px-4 text-left">Categoría</th>
                            <th class="py-3 px-4 text-center">Stock</th>
                            <th class="py-3 px-4 text-center">Precio</th>
                            <th class="py-3 px-4 text-center w-48">Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($productos as $producto)
                        <tr class="border-b hover:bg-gray-50 transition">
                            <td class="py-2 px-4">{{ $producto->codigo }}</td>

                            <td class="py-2 px-4 font-medium text-gray-900">
                                {{ $producto->nombre }}
                            </td>

                            <td class="py-2 px-4">{{ $producto->categoria ?? '-' }}</td>

                            {{-- Barra de stock --}}
                            <td class="py-2 px-4 text-center">
                                @php
                                    $maxStock = 100;
                                    $pct = min(($producto->stock / $maxStock) * 100, 100);
                                    $color = $producto->stock <= 5
                                        ? 'bg-red-600'
                                        : ($producto->stock <= 20 ? 'bg-yellow-400' : 'bg-green-600');
                                @endphp

                                <div class="flex flex-col items-center">
                                    <div class="w-24 bg-gray-200 rounded-full h-2 mb-1">
                                        <div class="{{ $color }} h-2 rounded-full" style="width: {{ $pct }}%"></div>
                                    </div>
                                    <span class="text-xs text-gray-600">{{ $producto->stock }} unidades</span>
                                </div>
                            </td>

                            <td class="py-2 px-4 text-center font-semibold">
                                ${{ number_format($producto->precio, 2) }}
                            </td>

                            {{-- ACCIONES --}}
                            <td class="py-2 px-4 text-center space-x-2">

                                {{-- Ver --}}
                                <a href="{{ route('productos.show', $producto) }}"
                                   class="inline-flex items-center px-3 py-1 bg-gray-200 hover:bg-gray-300 rounded text-xs">
                                    👁 Ver
                                </a>

                                {{-- Editar --}}
                                <a href="{{ route('productos.edit', $producto) }}"
                                   class="inline-flex items-center px-3 py-1 bg-yellow-400 hover:bg-yellow-500 rounded text-xs">
                                    ✏ Editar
                                </a>

                                {{-- Eliminar --}}
                                <div x-data="{ openModal: false }" class="inline">
                                    <button @click="openModal = true"
                                            class="px-3 py-1 bg-red-600 hover:bg-red-700 text-white rounded text-xs">
                                        🗑 Eliminar
                                    </button>

                                    {{-- Modal --}}
                                    <div x-show="openModal" x-cloak
                                         class="fixed inset-0 bg-gray-900 bg-opacity-60 flex items-center justify-center z-50">
                                        <div class="bg-white rounded-lg shadow-lg p-6 max-w-sm w-full">

                                            <h3 class="text-lg font-semibold text-gray-800 mb-4">
                                                ¿Eliminar producto?
                                            </h3>

                                            <p class="text-gray-600 mb-6">
                                                Esta acción no se puede deshacer.
                                            </p>

                                            <div class="flex justify-center gap-4">

                                                <button @click="openModal = false"
                                                    class="px-4 py-2 bg-gray-300 hover:bg-gray-400 text-gray-800 rounded">
                                                    Cancelar
                                                </button>

                                                <form action="{{ route('productos.destroy', $producto) }}" method="POST">
                                                    @csrf @method('DELETE')
                                                    <button type="submit"
                                                        class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded">
                                                        Eliminar
                                                    </button>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="py-4 text-center text-gray-500">
                                No hay productos registrados.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                {{-- PAGINACIÓN --}}
                <div class="mt-4">
                    {{ $productos->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

