<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            Gestión de Categorías
        </h2>
    </x-slot>

    <div class="py-10 bg-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Mensajes --}}
            @if(session('success'))
                <div class="bg-green-50 border-l-4 border-green-600 text-green-800 px-4 py-3 rounded shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="bg-red-50 border-l-4 border-red-600 px-4 py-3 rounded shadow-sm text-red-700">
                    <ul class="list-disc list-inside text-sm">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Encabezado + botón --}}
            <div class="bg-white shadow-sm sm:rounded-lg p-6 flex justify-between items-center border-l-4 border-red-600">
                <div>
                    <h3 class="text-lg font-semibold text-gray-800">Categorías de Productos</h3>
                    <p class="text-sm text-gray-500">Administra y organiza tus categorías</p>
                </div>

                <a href="{{ route('categorias.create') }}"
                   class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md shadow flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M12 4v16m8-8H4" />
                    </svg>
                    Nueva Categoría
                </a>
            </div>

            {{-- Tabla --}}
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                @if($categorias->isEmpty())
                    <div class="text-center py-10 text-gray-500">
                        <svg class="w-16 h-16 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor"
                             viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                        </svg>

                        <p class="text-lg font-semibold">No hay categorías registradas</p>
                        <p class="text-sm">Puedes crear una desde el botón superior derecho.</p>
                    </div>
                @else

                    <div class="overflow-x-auto">
                        <table class="min-w-full text-sm text-gray-700 border rounded-lg overflow-hidden">
                            <thead class="bg-gray-100 text-gray-800 uppercase text-xs font-semibold">
                                <tr>
                                    <th class="py-3 px-4 text-left">Nombre</th>
                                    <th class="py-3 px-4 text-left">Descripción</th>
                                    <th class="py-3 px-4 text-center">Productos</th>
                                    <th class="py-3 px-4 text-center w-40">Acciones</th>
                                </tr>
                            </thead>

                            <tbody class="divide-y">
                                @foreach($categorias as $categoria)
                                    <tr class="hover:bg-gray-50 transition">
                                        <td class="py-2 px-4 font-medium text-gray-900">
                                            {{ $categoria->nombre }}
                                        </td>

                                        <td class="py-2 px-4 text-gray-600">
                                            {{ $categoria->descripcion ?? '-' }}
                                        </td>

                                        <td class="py-2 px-4 text-center">
                                            <span class="inline-flex items-center px-3 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-700">
                                                {{ $categoria->productos_count }} producto(s)
                                            </span>
                                        </td>

                                        <td class="py-2 px-4 text-center space-x-2">

                                            {{-- Editar --}}
                                            <a href="{{ route('categorias.edit', $categoria) }}"
                                               class="inline-flex items-center bg-yellow-400 hover:bg-yellow-500 text-gray-900 px-3 py-1 rounded text-xs shadow-sm">
                                                ✏️ Editar
                                            </a>

                                            {{-- Eliminar con modal --}}
                                            <div x-data="{ openModal: false }" class="inline">

                                                <button @click="openModal = true"
                                                        class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-xs shadow">
                                                    🗑️ Eliminar
                                                </button>

                                                <div x-show="openModal" x-cloak
                                                     class="fixed inset-0 bg-gray-900 bg-opacity-60 flex items-center justify-center z-50">
                                                    <div class="bg-white rounded-lg shadow-lg p-6 max-w-sm w-full">

                                                        <h3 class="text-lg font-semibold text-gray-800 mb-4">
                                                            ¿Eliminar categoría?
                                                        </h3>

                                                        <p class="text-gray-600 mb-1">
                                                            Esta acción no se puede deshacer.
                                                        </p>

                                                        @if($categoria->productos_count > 0)
                                                            <p class="text-sm text-red-600 mb-4">
                                                                ⚠️ Tiene {{ $categoria->productos_count }} producto(s) asociado(s)
                                                            </p>
                                                        @endif

                                                        <div class="flex justify-between mt-4">
                                                            <button @click="openModal = false"
                                                                    class="px-4 py-2 rounded bg-gray-300 hover:bg-gray-400 text-gray-800">
                                                                Cancelar
                                                            </button>

                                                            <form method="POST" action="{{ route('categorias.destroy', $categoria) }}">
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
                                @endforeach
                            </tbody>
                        </table>

                        <div class="mt-4">
                            {{ $categorias->links() }}
                        </div>

                @endif
            </div>
        </div>
    </div>
</x-app-layout>
