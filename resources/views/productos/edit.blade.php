<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            ✏️ Editar Producto
        </h2>
    </x-slot>

    <div class="py-10 bg-gray-100 min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            {{-- Mensajes de error --}}
            @if($errors->any())
                <div class="bg-red-100 border border-red-300 text-red-800 px-4 py-3 rounded-lg mb-4 shadow-sm">
                    <ul class="list-disc ml-4 text-sm">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Tarjeta del formulario --}}
            <div class="bg-white shadow-lg rounded-xl p-6 border border-gray-200">

                <form action="{{ route('productos.update', $producto) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    {{-- Código --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">
                            Código del producto *
                        </label>
                        <input 
                            type="text" 
                            name="codigo" 
                            value="{{ old('codigo', $producto->codigo) }}"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-red-600 focus:ring-red-600"
                            required
                        >
                    </div>

                    {{-- Nombre --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">
                            Nombre *
                        </label>
                        <input 
                            type="text" 
                            name="nombre" 
                            value="{{ old('nombre', $producto->nombre) }}"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-red-600 focus:ring-red-600"
                            required
                        >
                    </div>

                    {{-- Categoría --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">
                            Categoría
                        </label>

                        <div class="flex gap-2">
                            <select 
                                name="categoria"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-red-600 focus:ring-red-600"
                            >
                                <option value="">Sin categoría</option>

                                @foreach(\App\Models\Categoria::orderBy('nombre')->get() as $cat)
                                    <option 
                                        value="{{ $cat->nombre }}"
                                        {{ old('categoria', $producto->categoria) == $cat->nombre ? 'selected' : '' }}
                                    >
                                        {{ $cat->nombre }}
                                    </option>
                                @endforeach
                            </select>

                            {{-- Botón nueva categoría --}}
                            <a 
                                href="{{ route('categorias.create') }}"
                                class="px-4 py-2 bg-red-600 text-white rounded-md shadow hover:bg-red-700 transition font-semibold text-sm"
                                title="Crear nueva categoría"
                            >
                                + Nueva
                            </a>
                        </div>
                    </div>

                    {{-- Stock --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">
                            Stock *
                        </label>
                        <input 
                            type="number" 
                            name="stock" 
                            value="{{ old('stock', $producto->stock) }}"
                            min="0"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-red-600 focus:ring-red-600"
                            required
                        >
                    </div>

                    {{-- Precio --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">
                            Precio *
                        </label>
                        <div class="relative">
                            <span class="absolute left-3 top-2 text-gray-500">$</span>
                            <input 
                                type="number" 
                                step="0.01" 
                                name="precio" 
                                value="{{ old('precio', $producto->precio) }}"
                                min="0.01"
                                class="w-full pl-7 rounded-md border-gray-300 shadow-sm focus:border-red-600 focus:ring-red-600"
                                required
                            >
                        </div>
                    </div>

                    {{-- Botones --}}
                    <div class="flex justify-end gap-4 pt-4 border-t border-gray-200">

                        <a 
                            href="{{ route('productos.index') }}" 
                            class="px-4 py-2 rounded-md bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold transition"
                        >
                            Cancelar
                        </a>

                        <button 
                            type="submit"
                            class="px-5 py-2 rounded-md bg-red-600 hover:bg-red-700 text-white font-semibold shadow transition flex items-center gap-2"
                        >
                            💾 Guardar cambios
                        </button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</x-app-layout>
