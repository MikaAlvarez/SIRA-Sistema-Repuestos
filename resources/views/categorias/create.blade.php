<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-center">
            <h2 class="font-bold text-2xl text-gray-900">
                🏷️ Nueva Categoría
            </h2>
        </div>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">

            {{-- Errores de validación --}}
            @if($errors->any())
                <div class="bg-red-50 border-l-4 border-red-600 text-red-900 px-6 py-4 rounded-lg mb-6 shadow-md">
                    <div class="flex items-start">
                        <svg class="w-6 h-6 text-red-600 mr-3 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                        <div>
                            <p class="font-semibold mb-2">Por favor corrige los siguientes errores:</p>
                            <ul class="list-disc list-inside space-y-1 text-sm">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Formulario con el MISMO redondeo que el botón Categorías --}}
            <div class="bg-white shadow-2xl rounded-lg px-6 py-6 border-t-4 border-red-600">
                
                {{-- Header del formulario CENTRADO --}}
                <div class="text-center mb-8 pb-6 border-b-2 border-gray-100">
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Información de la Categoría</h3>
                    <p class="text-sm text-gray-600">Complete los datos para crear una nueva categoría</p>
                </div>

                <form action="{{ route('categorias.store') }}" method="POST" class="space-y-6">
                    @csrf

                    {{-- Campo Nombre --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-900 mb-2 text-left pl-1">
                            <svg class="w-4 h-4 inline mr-1.5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                            </svg>
                            Nombre de la Categoría
                            <span class="text-red-600">*</span>
                        </label>
                        <input type="text" 
                               name="nombre" 
                               value="{{ old('nombre') }}" 
                               class="block w-full px-4 py-3 rounded-lg border-2 border-gray-300 text-gray-900 placeholder-gray-400 focus:border-red-600 focus:ring-2 focus:ring-red-200 transition-all duration-200" 
                               placeholder="Ej: Filtros, Frenos, Aceites..."
                               required
                               autofocus>
                        <p class="text-xs text-gray-500 mt-2 pl-1 text-left">💡 El nombre debe ser único y descriptivo</p>
                    </div>

                    {{-- Campo Descripción --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-900 mb-2 text-left pl-1">
                            <svg class="w-4 h-4 inline mr-1.5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"/>
                            </svg>
                            Descripción
                            <span class="text-gray-500 text-xs font-normal ml-1">(Opcional)</span>
                        </label>
                        <textarea name="descripcion" 
                                  rows="3"
                                  maxlength="500"
                                  class="block w-full px-4 py-3 rounded-lg border-2 border-gray-300 text-gray-900 placeholder-gray-400 focus:border-red-600 focus:ring-2 focus:ring-red-200 transition-all duration-200 resize-none"
                                  placeholder="Breve descripción de la categoría (máximo 500 caracteres)">{{ old('descripcion') }}</textarea>
                    </div>

                    {{-- Botones COMPACTOS y REDONDEADOS --}}
                    <div class="flex justify-center gap-3 pt-6 border-t-2 border-gray-100">
                        <a href="{{ route('categorias.index') }}" 
                           class="inline-flex items-center gap-2 px-5 py-2 rounded-md bg-gray-100 hover:bg-gray-200 text-gray-900 font-medium transition-all duration-200 border-2 border-gray-200">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                            </svg>
                            Cancelar
                        </a>
                        <button type="submit" 
                                class="inline-flex items-center gap-2 px-5 py-2 rounded-md bg-red-600 text-white font-medium hover:bg-red-700 transition-all duration-200 shadow-md hover:shadow-lg">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Crear Categoría
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>