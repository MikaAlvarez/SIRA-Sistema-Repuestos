<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Categoría') }}
        </h2>
    </x-slot>

    <div class="py-10 bg-gray-100 min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            {{-- Errores de validación --}}
            @if($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded mb-6 shadow-sm">
                    <ul class="list-disc list-inside text-sm">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Formulario --}}
            <div class="bg-white shadow-md sm:rounded-lg p-6 border-l-4 border-red-600">
                <h3 class="text-lg font-semibold text-gray-800 mb-6">Modificar datos de la categoría</h3>

                <form action="{{ route('categorias.update', $categoria) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    {{-- Nombre --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nombre *</label>
                        <input type="text" name="nombre"
                            value="{{ old('nombre', $categoria->nombre) }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm
                                   focus:border-red-600 focus:ring-red-600"
                            required>
                        <p class="text-xs text-gray-500 mt-1">Debe ser único y descriptivo.</p>
                    </div>

                    {{-- Descripción --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Descripción</label>
                        <textarea name="descripcion" rows="3"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm
                                   focus:border-red-600 focus:ring-red-600">{{ old('descripcion', $categoria->descripcion) }}</textarea>
                    </div>

                    {{-- Botones --}}
                    <div class="flex justify-end gap-3 pt-6 border-t">
                        <a href="{{ route('categorias.index') }}"
                           class="px-4 py-2 rounded-md bg-gray-200 hover:bg-gray-300
                                  text-gray-800 font-medium transition">
                            Cancelar
                        </a>

                        <button type="submit"
                            class="px-5 py-2 rounded-md bg-red-600 text-white hover:bg-red-700
                                   font-medium shadow-md transition">
                            Guardar Cambios
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>
