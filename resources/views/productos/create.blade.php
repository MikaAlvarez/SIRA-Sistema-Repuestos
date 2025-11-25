<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Nuevo Producto') }}
        </h2>
    </x-slot>

    <div class="py-10 bg-gray-100 min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            {{-- Errores de validación --}}
            @if($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded mb-4">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Formulario --}}
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('productos.store') }}" method="POST" class="space-y-4">
                    @csrf

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Código *</label>
                        <input type="text" name="codigo" value="{{ old('codigo') }}" 
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500" 
                               placeholder="Ej: REP001"
                               required>
                        <p class="text-xs text-gray-500 mt-1">Código único del producto</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nombre *</label>
                        <input type="text" name="nombre" value="{{ old('nombre') }}" 
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500" 
                               placeholder="Ej: Filtro de aceite Fiat"
                               required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Categoría</label>
                        <div class="flex gap-2">
                            <select name="categoria"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                                <option value="">Seleccione una categoría</option>
                                @foreach(\App\Models\Categoria::orderBy('nombre')->get() as $cat)
                                    <option value="{{ $cat->nombre }}" {{ old('categoria') == $cat->nombre ? 'selected' : '' }}>
                                        {{ $cat->nombre }}
                                    </option>
                                @endforeach
                            </select>
                            <a href="{{ route('categorias.create') }}" 
                               class="mt-1 px-4 py-2 bg-blue-600 text-blackrounded-md hover:bg-blue-700 whitespace-nowrap"
                               title="Crear nueva categoría">
                                + Nueva
                            </a>
                        </div>
                        <p class="text-xs text-gray-500 mt-1">Opcional - Selecciona o crea una nueva categoría</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Stock Inicial *</label>
                            <input type="number" name="stock" value="{{ old('stock', 0) }}" 
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500" 
                                   min="0" 
                                   required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Precio *</label>
                            <div class="relative mt-1">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">$</span>
                                <input type="number" step="0.01" name="precio" value="{{ old('precio', 0) }}" 
                                       class="block w-full pl-7 rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500" 
                                       min="0.01"
                                       placeholder="0.00"
                                       required>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end gap-3 pt-4 border-t">
                        <a href="{{ route('productos.index') }}" 
                           class="px-4 py-2 rounded bg-gray-200 hover:bg-gray-300 text-gray-700">
                            Cancelar
                        </a>
                        <button type="submit" 
                                class="px-4 py-2 rounded bg-green-600 text-black hover:bg-green-700 flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                            Crear Producto
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>