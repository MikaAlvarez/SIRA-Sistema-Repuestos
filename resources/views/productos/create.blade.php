<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Nuevo Producto
        </h2>
    </x-slot>

    <div class="py-10 bg-gray-100 min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            {{-- ❗ Errores de validación --}}
            @if($errors->any())
                <div class="bg-red-50 border border-red-300 text-red-700 px-4 py-3 rounded-lg shadow mb-5">
                    <ul class="list-disc list-inside text-sm">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- 📦 Card del formulario --}}
            <div class="bg-white shadow-lg rounded-lg p-8 border-t-4 border-red-600">

                <form action="{{ route('productos.store') }}" method="POST" class="space-y-6">
                    @csrf

                    {{-- Código --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700">Código *</label>
                        <input 
                            type="text" 
                            name="codigo"
                            value="{{ old('codigo') }}"
                            placeholder="Ej: REP001"
                            required
                            class="input-red"
                        >
                        <p class="form-hint">Debe ser único para cada producto.</p>
                    </div>

                    {{-- Nombre --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700">Nombre *</label>
                        <input 
                            type="text"
                            name="nombre"
                            value="{{ old('nombre') }}"
                            placeholder="Ej: Filtro de aceite Fiat"
                            required
                            class="input-red"
                        >
                    </div>

                    {{-- Categoría --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700">Categoría</label>

                        <div class="flex gap-3">
                            <select 
                                name="categoria"
                                class="input-red w-full"
                            >
                                <option value="">Seleccione una categoría</option>

                                @foreach(\App\Models\Categoria::orderBy('nombre')->get() as $cat)
                                    <option value="{{ $cat->nombre }}" {{ old('categoria') == $cat->nombre ? 'selected' : '' }}>
                                        {{ $cat->nombre }}
                                    </option>
                                @endforeach
                            </select>

                            {{-- Botón Nueva Categoría --}}
                            <a href="{{ route('categorias.create') }}"
                                class="px-4 py-2 bg-red-600 text-white rounded-lg shadow hover:bg-red-700 transition">
                                Nueva
                            </a>
                        </div>

                        <p class="form-hint">Opcional – puedes usar una existente o crear una nueva.</p>
                    </div>

                    {{-- Stock y Precio --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <div>
                            <label class="block text-sm font-semibold text-gray-700">Stock Inicial *</label>
                            <input 
                                type="number"
                                name="stock"
                                min="0"
                                value="{{ old('stock', 0) }}"
                                required
                                class="input-red"
                            >
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700">Precio *</label>

                            <div class="relative">
                                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500">$</span>

                                <input 
                                    type="number"
                                    step="0.01"
                                    min="0.01"
                                    name="precio"
                                    value="{{ old('precio', 0) }}"
                                    placeholder="0.00"
                                    required
                                    class="input-red pl-7"
                                >
                            </div>
                        </div>

                    </div>

                    {{-- Botones --}}
                    <div class="flex justify-end gap-4 pt-6 border-t">

                        <a href="{{ route('productos.index') }}"
                            class="btn-secondary">
                            Cancelar
                        </a>

                        <button type="submit"
                            class="btn-primary-red">
                            Crear Producto
                        </button>
                    </div>

                </form>

            </div>

        </div>
    </div>
</x-app-layout>
