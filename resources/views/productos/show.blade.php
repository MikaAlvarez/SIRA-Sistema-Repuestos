<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detalle de Producto') }}
        </h2>
    </x-slot>

    <div class="py-10 bg-gray-100 min-h-screen">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Toast --}}
            @if(session('message'))
                <x-alert-toast />
            @endif

            {{-- Tarjeta principal con datos --}}
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div>
                        <h3 class="text-2xl font-semibold mb-1">{{ $producto->nombre }}</h3>
                        <p class="text-sm text-gray-500 mb-2">Código: <span class="font-medium">{{ $producto->codigo }}</span></p>
                        <p class="text-sm text-gray-500">Categoría: <span class="font-medium">{{ $producto->categoria ?? '-' }}</span></p>
                    </div>

                    <div class="flex items-center gap-6">
                        <div class="text-center">
                            <div class="text-xs text-gray-500">Stock actual</div>
                            <div class="text-2xl font-bold">{{ $producto->stock }}</div>
                        </div>

                        <div class="text-center">
                            <div class="text-xs text-gray-500">Precio</div>
                            <div class="text-2xl font-bold">${{ number_format($producto->precio, 2) }}</div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Formulario de movimiento (solo admin) --}}
@if(auth()->user()->role === 'admin')
<div class="bg-white shadow-sm rounded-lg p-6">
    <h4 class="text-lg font-semibold mb-4 text-gray-900">Registrar movimiento de stock</h4>

    <form action="{{ route('productos.movimiento', $producto) }}" method="POST" class="space-y-6">
        @csrf

        <div class="grid grid-cols-2 md:grid-cols-1 gap-2">
            {{-- Tipo --}}
            <div class="flex flex-col">
                <label class="block text-sm font-semibold text-gray-900 mb-2">Tipo</label>
                <select name="tipo" required
                        class="flex-1 rounded-lg border-2 border-gray-300 px-4 py-2.5 text-gray-900 focus:border-red-600 focus:ring-2 focus:ring-red-200 transition">
                    <option value="">Seleccione</option>
                    <option value="entrada">⬆️ Entrada</option>
                    <option value="salida">⬇️ Salida</option>
                </select>
                @error('tipo') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Cantidad --}}
            <div class="flex flex-col">
                <label class="block text-sm font-semibold text-gray-900 mb-2">Cantidad</label>
                <input type="number" name="cantidad" min="1" required
                       class="flex-1 rounded-lg border-2 border-gray-300 px-4 py-2.5 text-gray-900 focus:border-red-600 focus:ring-2 focus:ring-red-200 transition"
                       placeholder="Ej: 10">
                @error('cantidad') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Observación --}}
            <div class="flex flex-col">
                <label class="block text-sm font-semibold text-gray-900 mb-2">Observación</label>
                <input type="text" name="observacion"
                       class="flex-1 rounded-lg border-2 border-gray-300 px-4 py-2.5 text-gray-900 focus:border-red-600 focus:ring-2 focus:ring-red-200 transition"
                       placeholder="Opcional">
            </div>
        </div>

        <div class="flex justify-end gap-3 pt-4 border-t-2 border-gray-100">
            <a href="{{ route('productos.index') }}" 
               class="px-5 py-2 rounded-md bg-gray-100 hover:bg-gray-200 text-gray-900 font-medium transition border-2 border-gray-200">
                ← Volver
            </a>
            <button type="submit" 
                    class="px-5 py-2 rounded-md bg-red-600 text-white hover:bg-red-700 font-medium transition shadow-md">
                ✓ Registrar movimiento
            </button>
        </div>
    </form>
</div>
@endif

            {{-- Movimientos recientes --}}
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <div class="flex items-center justify-between mb-4">
                    <h4 class="text-lg font-semibold">Movimientos recientes</h4>
                    <a href="{{ route('productos.index') }}" class="text-sm text-gray-500 hover:underline">Volver al listado</a>
                </div>

                @if($movimientos->isEmpty())
                    <p class="text-gray-500">No hay movimientos registrados para este producto.</p>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-sm text-gray-700">
                            <thead class="bg-gray-100 text-xs uppercase text-gray-600">
                                <tr>
                                    <th class="p-2 text-left">Fecha</th>
                                    <th class="p-2 text-left">Tipo</th>
                                    <th class="p-2 text-right">Cantidad</th>
                                    <th class="p-2 text-left">Observación</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($movimientos as $m)
                                    <tr class="border-t">
                                        <td class="p-2">{{ $m->created_at->format('d/m/Y H:i') }}</td>
                                        <td class="p-2 capitalize">{{ $m->tipo }}</td>
                                        <td class="p-2 text-right">{{ $m->cantidad }}</td>
                                        <td class="p-2">{{ $m->observacion ?? '-' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
