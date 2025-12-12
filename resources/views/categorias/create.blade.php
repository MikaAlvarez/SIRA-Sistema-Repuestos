<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-center">
            <h2 class="font-bold text-2xl text-gray-900">
                🏷️ Nueva Categoría
            </h2>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-100 min-h-screen">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">

            {{-- Errores de validación --}}
            @if($errors->any())
                <div class="bg-red-50 border-l-4 border-red-600 text-red-900 px-6 py-4 rounded-lg mb-6 shadow-md">
                    <div class="flex items-start">
                        <svg class="w-6 h-6 text-red-600 mr-3 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                        <div>
                            <p class="font-semibold mb-2">Por favor corrige lo siguiente:</p>
                            <ul class="list-disc list-inside space-y-1 text-sm">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Formulario principal --}}
            <div class="bg-white shadow-xl rounded-lg px-6 py-8 border-t-4 border-red-600">

                <div class="text-center mb-8">
                    <h3 class="text-xl font-bold text-gray-900 mb-1">Información de la Categoría</h3>
                    <p class="text-sm text-gray-600">Complete los datos para crear una nueva categoría</p>
                </div>

                <form action="{{ route('categorias.store') }}" method="POST" class="space-y-6">
                    @csrf

                    {{-- Campo Nombre --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-900 mb-1">
                            Nombre de la Categoría <span class="text-red-600">*</span>
                        </label>
                        <input type="text"
                               name="nombre"
                               value="{{ old('nombre') }}"
                               class="block w-full px-4 py-3 rounded-lg border-2 border-gray-300 focus:border-red-600 focus:ring-2 focus:ring-red-200 transition"
                               placeholder="Ej: Frenos, Aceites, Filtros..."
                               required>
                        <p class="text-xs text-gray-500 mt-1">El nombre debe ser único y descriptivo.</p>
                    </div>

                    {{-- Campo Descripción --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-900 mb-1">
                            Descripción <span class="text-gray-500 text-xs">(Opcional)</span>
                        </label>
                        <textarea name="descripcion"
                                  rows="3"
                                  maxlength="500"
                                  class="block w-full px-4 py-3 rounded-lg border-2 border-gray-300 focus:border-red-600 focus:ring-2 focus:ring-red-200 transition resize-none"
                                  placeholder="Breve descripción de la categoría">{{ old('descripcion') }}</textarea>
                    </div>

                    {{-- Botones --}}
                    <div class="flex justify-center gap-3 pt-4 border-t">
                        <a href="{{ route('categorias.index') }}"
                           class="inline-flex items-center gap-2 px-5 py-2 rounded-md bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium transition border border-gray-300">
                            ← Cancelar
                        </a>

                        <button type="submit"
                                class="inline-flex items-center gap-2 px-5 py-2 rounded-md bg-red-600 text-white font-medium hover:bg-red-700 transition shadow">
                            Crear Categoría
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>
