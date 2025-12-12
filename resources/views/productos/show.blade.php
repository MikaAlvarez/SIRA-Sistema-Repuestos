<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detalle del Producto') }}
        </h2>
    </x-slot>

    <div class="py-10 bg-gray-100 min-h-screen">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Toast --}}
            @if(session('message'))
                <x-alert-toast />
            @endif

            {{-- Tarjeta principal --}}
            <div class="bg-white shadow-lg sm:rounded-lg p-6 border-t-4 border-red-600">
                <div class="flex flex-col md:flex-row justify-between md:items-center gap-4">

                    <div>
                        <h3 class="text-3xl font-bold text-gray-900">{{ $producto->nombre }}</h3>
                        <p class="text-sm text-gray-600 mt-1">
                            Código: <span class="font-semibold">{{ $producto->codigo }}</span>
                        </p>
                        <p class="text-sm text-gray-600">
                            Categoría: 
                            <span class="font-semibold">
                                {{ $producto->categoria ?? 'Sin categoría' }}
                            </span>
                        </p>
                    </div>

                    <div class="flex gap-10">
                        {{-- Stock --}}
                        <div class="text-center bg-gray-50 px-4 py-2 rounded-lg shadow-sm border">
                            <p class="text-xs text-gray-500 uppercase tracking-wide">Stock</p>
                            <p class="text-3xl font-bold text-gray-900">{{ $producto->stock }}</p>
                        </div>

                        {{-- Precio --}}
                        <div class="text-center bg-gray-50 px-4 py-2 rounded-lg shadow-sm border">
                            <p class="text-xs text-gray-500 uppercase tracking-wide">Precio</p>
                            <p class="text-3xl font-bold text-red-600">
                                ${{ number_format($producto->precio, 2) }}
                            </p>
                        </div>
                    </div>

                </div>
            </div>


            {{-- FORMULARIO DE MOVIMIENTO --}}
            @if(auth()->user()->role === 'admin')
            <div class="bg-white shadow-lg rounded-lg p-6 border-l-4 border-red-600">

                <h4 class="text-lg font-bold mb-4 text-gray-900">Registrar movimiento de stock</h4>

                <form action="{{ route('productos.movimiento', $producto) }}" method="POST" class="space-y-6">
                    @csrf

                    <div class="grid md:grid-cols-3 gap-4">

                        {{-- Tipo --}}
                        <div>
                            <label class="text-sm font-semibold text-gray-900">Tipo</label>
                            <select name="tipo"
                                class="mt-1 w-full rounded-lg border-gray-300 focus:border-red-600 focus:ring-red-200">
                                <option value="">Seleccione</option>
                                <option value="entrada">Entrada</option>
                                <option value="salida">Salida</option>
                            </select>
                            @error('tipo') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                        </div>

                        {{-- Cantidad --}}
                        <div>
                            <label class="text-sm font-semibold text-gray-900">Cantidad</label>
                            <input type="number" name="cantidad" min="1"
                                class="mt-1 w-full rounded-lg border-gray-300 focus:border-red-600 focus:ring-red-200"
                                placeholder="Ej: 10">
                            @error('cantidad') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                        </div>

                        {{-- Observación --}}
                        <div>
                            <label class="text-sm font-semibold text-gray-900">Observación</label>
                            <input type="text" name="observacion"
                                class="mt-1 w-full rounded-lg border-gray-300 focus:border-red-600 focus:ring-red-200"
                                placeholder="Opcional">
                        </div>

                    </div>

                    <div class="flex justify-end gap-3 pt-4 border-t">

                        <a href="{{ route('productos.index') }}"
                           class="px-5 py-2 rounded-md bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium">
                            ← Volver
                        </a>

                        <button type="submit"
                            class="px-5 py-2 rounded-md bg-red-600 text-white hover:bg-red-700 font-medium shadow">
                            Registrar movimiento
                        </button>

                    </div>
                </form>
            </div>
            @endif


            {{-- Movimientos recientes --}}
            <div class="bg-white shadow-lg sm:rounded-lg p-6">
                <div class="flex justify-between items-center mb-4">
                    <h4 class="text-lg font-bold text-gray-900">Movimientos recientes</h4>
                    <a href="{{ route('productos.index') }}"
                       class="text-sm text-red-600 hover:underline">Volver al listado</a>
                </div>

                @if($movimientos->isEmpty())
                    <p class="text-gray-500">No hay movimientos registrados.</p>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-sm">
                            <thead class="bg-gray-100 text-gray-600 uppercase text-xs">
                                <tr>
                                    <th class="p-2 text-left">Fecha</th>
                                    <th class="p-2 text-left">Tipo</th>
                                    <th class="p-2 text-right">Cantidad</th>
                                    <th class="p-2 text-left">Observación</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y">
                                @foreach($movimientos as $m)
                                    <tr class="hover:bg-gray-50">
                                        <td class="p-2">{{ $m->created_at->format('d/m/Y H:i') }}</td>
                                        <td class="p-2 capitalize">
                                            <span class="px-2 py-1 rounded text-xs font-semibold
                                                {{ $m->tipo === 'entrada' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                                {{ $m->tipo }}
                                            </span>
                                        </td>
                                        <td class="p-2 text-right font-medium">{{ $m->cantidad }}</td>
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

