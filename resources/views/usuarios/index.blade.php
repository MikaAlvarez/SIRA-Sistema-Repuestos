<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-900 leading-tight">
            {{ __('Gestión de Usuarios') }}
        </h2>
    </x-slot>

    <div class="py-10 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Mensajes de éxito/error --}}
            @if(session('success'))
                <div class="bg-green-50 border-l-4 border-green-600 text-green-900 px-6 py-4 rounded-lg shadow-md">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        <p class="font-semibold">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            @if($errors->any())
                <div class="bg-red-50 border-l-4 border-red-600 text-red-900 px-6 py-4 rounded-lg shadow-md">
                    <div class="flex items-start">
                        <svg class="w-6 h-6 text-red-600 mr-3 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                        <div>
                            <p class="font-semibold mb-2">Error:</p>
                            <ul class="list-disc list-inside">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Header con botón crear --}}
            <div class="bg-white shadow-sm rounded-lg p-6 flex justify-between items-center">
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">Usuarios del Sistema</h3>
                    <p class="text-sm text-gray-600 mt-1">Gestiona los usuarios y asigna roles de acceso</p>
                </div>
                <a href="{{ route('usuarios.create') }}"
                   class="inline-flex items-center gap-2 px-5 py-2.5 rounded-md bg-red-600 text-white font-medium hover:bg-red-700 transition shadow-md">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Nuevo Usuario
                </a>
            </div>

            {{-- Tabla de usuarios --}}
            <div class="bg-white shadow-sm rounded-lg p-6">
                @if($usuarios->isEmpty())
                    <div class="text-center py-12 text-gray-500">
                        <svg class="w-16 h-16 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                        <p class="text-lg font-medium">No hay usuarios registrados</p>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-sm text-gray-900 border border-gray-200">
                            <thead class="bg-gray-100 border-b text-gray-800 uppercase text-xs font-semibold">
                                <tr>
                                    <th class="py-3 px-4 text-left">Nombre</th>
                                    <th class="py-3 px-4 text-left">Email</th>
                                    <th class="py-3 px-4 text-center">Rol</th>
                                    <th class="py-3 px-4 text-center">Fecha de Registro</th>
                                    <th class="py-3 px-4 text-center w-48">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach($usuarios as $usuario)
                                    <tr class="hover:bg-gray-50">
                                        <td class="py-3 px-4 font-medium">
                                            {{ $usuario->name }}
                                            @if($usuario->id === auth()->id())
                                                <span class="ml-2 text-xs bg-blue-100 text-blue-800 px-2 py-0.5 rounded-full">Tú</span>
                                            @endif
                                        </td>
                                        <td class="py-3 px-4 text-gray-600">{{ $usuario->email }}</td>
                                        <td class="py-3 px-4 text-center">
                                            @if($usuario->role === 'admin')
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-red-100 text-red-800">
                                                    👑 Admin
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-gray-100 text-gray-800">
                                                    👤 Empleado
                                                </span>
                                            @endif
                                        </td>
                                        <td class="py-3 px-4 text-center text-gray-600">
                                            {{ $usuario->created_at->format('d/m/Y') }}
                                        </td>
                                        <td class="py-3 px-4 text-center space-x-2">
                                            <a href="{{ route('usuarios.edit', $usuario) }}"
                                               class="inline-flex items-center bg-amber-500 hover:bg-amber-600 text-black px-3 py-1 rounded text-xs font-medium shadow-sm">
                                               ✏️ Editar
                                            </a>

                                            @if($usuario->id !== auth()->id())
                                                {{-- Modal de eliminación --}}
                                                <div x-data="{ openModal: false }" class="inline">
                                                    <button @click="openModal = true"
                                                            class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-xs font-medium">
                                                        🗑️ Eliminar
                                                    </button>

                                                    <div x-show="openModal" x-cloak
                                                         class="fixed inset-0 bg-gray-900 bg-opacity-60 flex items-center justify-center z-50">
                                                        <div class="bg-white rounded-lg shadow-lg p-6 max-w-sm w-full text-center">
                                                            <h3 class="text-lg font-semibold text-gray-800 mb-4">¿Eliminar usuario?</h3>
                                                            <p class="text-gray-600 mb-2">Esta acción no se puede deshacer.</p>
                                                            <p class="text-sm text-gray-500 mb-6">Usuario: <strong>{{ $usuario->name }}</strong></p>

                                                            <div class="flex justify-center space-x-4">
                                                                <button @click="openModal = false"
                                                                        class="px-4 py-2 rounded bg-gray-300 hover:bg-gray-400 text-gray-800">
                                                                    Cancelar
                                                                </button>

                                                                <form action="{{ route('usuarios.destroy', $usuario) }}" method="POST">
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
                                            @else
                                                <span class="text-xs text-gray-400 italic"> <br> No puedes eliminarte</span>
                                            @endif
                                        </td>
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