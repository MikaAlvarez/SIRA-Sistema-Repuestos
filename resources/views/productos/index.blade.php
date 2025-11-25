<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Listado de Productos') }}
        </h2>
    </x-slot>

    <div class="py-10 bg-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- ✅ Toast de mensajes de sesión (reutiliza <x-alert-toast /> en app.blade.php) --}}
            @if(session('message'))
                <x-alert-toast />
            @endif

            {{-- 🔍 Filtro y búsqueda --}}
            <div class="bg-white shadow-sm sm:rounded-lg p-6 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <form method="GET" action="{{ route('productos.index') }}" class="flex flex-wrap gap-3 items-center w-full md:w-auto">
                    <input type="text" name="q" value="{{ request('q') }}" placeholder="Buscar por nombre o código"
                        class="rounded-md border-gray-300 text-sm focus:border-green-500 focus:ring-green-500 w-64">

                    <select name="categoria" class="rounded-md border-gray-300 text-sm focus:border-green-500 focus:ring-green-500">
                        <option value="">Todas las categorías</option>
                        @php
                            $categorias = \App\Models\Producto::select('categoria')->distinct()->pluck('categoria');
                        @endphp
                        @foreach($categorias as $c)
                            <option value="{{ $c }}" {{ request('categoria') == $c ? 'selected' : '' }}>
                                {{ $c }}
                            </option>
                        @endforeach
                    </select>

                    <button type="submit"
                        class="bg-green-600 hover:bg-green-700 text-black text-sm px-4 py-2 rounded-md shadow">
                        Buscar
                    </button>
                </form>

                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('productos.create') }}"
                        class="bg-blue-600 hover:bg-blue-700 text-black text-sm px-4 py-2 rounded-md shadow">
                        + Nuevo producto
                    </a>
                @endif
            </div>

            {{-- 📋 Tabla de productos --}}
            <div class="bg-white shadow-sm sm:rounded-lg p-6 overflow-x-auto">
                <table class="min-w-full text-sm text-gray-700 border border-gray-200">
                    <thead class="bg-gray-100 border-b text-gray-800 uppercase text-xs font-semibold">
                        <tr>
                            <th class="py-3 px-4 text-left">Código</th>
                            <th class="py-3 px-4 text-left">Nombre</th>
                            <th class="py-3 px-4 text-left">Categoría</th>
                            <th class="py-3 px-4 text-center">Stock</th>
                            <th class="py-3 px-4 text-center">Precio</th>
                            <th class="py-3 px-4 text-center w-40">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($productos as $producto)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="py-2 px-4">{{ $producto->codigo }}</td>
                                <td class="py-2 px-4 font-medium text-gray-900">{{ $producto->nombre }}</td>
                                <td class="py-2 px-4">{{ $producto->categoria ?? '-' }}</td>

                                {{-- 🔢 STOCK con barra de progreso y color dinámico --}}
                                <td class="py-2 px-4 text-center align-middle">
                                    @php
                                        $maxStock = 100;
                                        $porcentaje = min(($producto->stock / $maxStock) * 100, 100);

                                        if ($producto->stock <= 5) {
                                            $color = 'bg-red-500';
                                            $label = 'Bajo stock';
                                        } elseif ($producto->stock <= 20) {
                                            $color = 'bg-yellow-400';
                                            $label = 'Normal';
                                        } else {
                                            $color = 'bg-green-500';
                                            $label = 'En stock';
                                        }
                                    @endphp

                                    <div class="flex flex-col items-center justify-center">
                                        <div class="w-full bg-gray-200 rounded-full h-2.5 mb-1">
                                            <div class="{{ $color }} h-2.5 rounded-full" style="width: {{ $porcentaje }}%"></div>
                                        </div>
                                        <span class="text-xs text-gray-600">{{ $producto->stock }} unidades</span>
                                        <div class="text-xs font-medium {{ $producto->stock <= 5 ? 'text-red-600' : ($producto->stock <= 20 ? 'text-yellow-600' : 'text-green-600') }}">
                                            {{ $label }}
                                        </div>
                                    </div>
                                </td>

                                <td class="py-2 px-4 text-center">${{ number_format($producto->precio, 2) }}</td>

                                {{-- ⚙️ ACCIONES --}}
                                <td class="py-2 px-4 text-center space-x-2">
                                    <a href="{{ route('productos.show', $producto) }}"
                                       class="inline-flex items-center bg-emerald-600 hover:bg-emerald-700 text-black px-3 py-1 rounded text-xs shadow-sm">
                                       👁️ Ver
                                    </a>

                                    <a href="{{ route('productos.edit', $producto) }}"
                                       class="inline-flex items-center bg-amber-500 hover:bg-amber-600 text-black px-3 py-1 rounded text-xs shadow-sm">
                                       ✏️ Editar
                                    </a>

                                    {{-- 🗑️ Botón y modal de eliminación --}}
                                    <div x-data="{ openModal: false }" class="inline">
                                        <button
                                            @click="openModal = true"
                                            class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-xs">
                                            Eliminar
                                        </button>

                                        <!-- Modal de confirmación -->
                                        <div
                                            x-show="openModal"
                                            x-cloak
                                            class="fixed inset-0 bg-gray-900 bg-opacity-60 flex items-center justify-center z-50">
                                            <div class="bg-white rounded-lg shadow-lg p-6 max-w-sm w-full text-center">
                                                <h3 class="text-lg font-semibold text-gray-800 mb-4">¿Eliminar producto?</h3>
                                                <p class="text-gray-600 mb-6">Esta acción no se puede deshacer.</p>

                                                <div class="flex justify-center space-x-4">
                                                    <button @click="openModal = false"
                                                        class="px-4 py-2 rounded bg-gray-300 hover:bg-gray-400 text-gray-800">
                                                        Cancelar
                                                    </button>

                                                    <form action="{{ route('productos.destroy', $producto) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="px-4 py-2 rounded bg-red-600 hover:bg-red-700 text-white">
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
                                <td colspan="6" class="text-center py-4 text-gray-500">
                                    No hay productos registrados.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                {{-- 📄 Paginación --}}
                <div class="mt-4">
                    {{ $productos->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
