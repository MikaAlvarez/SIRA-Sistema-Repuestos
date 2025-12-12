<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-center">
            <h2 class="font-bold text-2xl text-gray-900">
                ✏️ Editar Usuario
            </h2>
        </div>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">

            {{-- Errores de validación --}}
            @if($errors->any())
                <div class="bg-red-50 border-l-4 border-red-600 text-red-900 px-6 py-4 rounded-xl mb-6 shadow-md">
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

            {{-- Formulario --}}
            <div class="bg-white shadow-2xl rounded-lg px-16 py-12 border-t-4 border-red-600">
                
                {{-- Header del formulario --}}
                <div class="text-center mb-8 pb-6 border-b-2 border-gray-100">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-red-100 rounded-full mb-4">
                        <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Editar Usuario: {{ $usuario->name }}</h3>
                    <p class="text-sm text-gray-600">Modifica los datos del usuario</p>
                </div>

                <form action="{{ route('usuarios.update', $usuario) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    {{-- Nombre --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-900 mb-2">
                            Nombre Completo
                            <span class="text-red-600">*</span>
                        </label>
                        <input type="text" 
                               name="name" 
                               value="{{ old('name', $usuario->name) }}" 
                               class="block w-full px-5 py-4 rounded-2xl border-2 border-gray-300 text-gray-900 placeholder-gray-400 focus:border-red-600 focus:ring-4 focus:ring-red-100 transition-all duration-200" 
                               required
                               autofocus>
                    </div>

                    {{-- Email --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-900 mb-2">
                            Correo Electrónico
                            <span class="text-red-600">*</span>
                        </label>
                        <input type="email" 
                               name="email" 
                               value="{{ old('email', $usuario->email) }}" 
                               class="block w-full px-5 py-4 rounded-2xl border-2 border-gray-300 text-gray-900 placeholder-gray-400 focus:border-red-600 focus:ring-4 focus:ring-red-100 transition-all duration-200" 
                               required>
                    </div>

                    {{-- Rol --}}
                    <div>
    <label class="block text-sm font-semibold text-gray-900 mb-2">
        Rol de Usuario
        <span class="text-red-600">*</span>
    </label>
    
    @if($usuario->id === auth()->id())
        {{-- Si es tu propio usuario, mostrar solo lectura --}}
        <div class="block w-full px-5 py-4 rounded-2xl border-2 border-gray-200 bg-gray-50 text-gray-600">
            @if($usuario->role === 'admin')
                👑 Administrador (Acceso completo)
            @else
                👤 Empleado (Solo lectura)
            @endif
        </div>
        <input type="hidden" name="role" value="{{ $usuario->role }}">
        <p class="text-xs text-amber-600 mt-2">⚠️ No puedes cambiar tu propio rol. Pide a otro administrador que lo haga.</p>
    @else
        {{-- Si es otro usuario, mostrar selector --}}
        <select name="role" 
                class="block w-full px-5 py-4 rounded-2xl border-2 border-gray-300 text-gray-900 focus:border-red-600 focus:ring-4 focus:ring-red-100 transition-all duration-200"
                required>
            <option value="empleado" {{ old('role', $usuario->role) == 'empleado' ? 'selected' : '' }}>👤 Empleado (Solo lectura)</option>
            <option value="admin" {{ old('role', $usuario->role) == 'admin' ? 'selected' : '' }}>👑 Administrador (Acceso completo)</option>
        </select>
    @endif
</div>

                    {{-- Contraseña (opcional) --}}
                    <div class="pt-4 border-t-2 border-gray-100">
                        <p class="text-sm font-semibold text-gray-700 mb-4">🔒 Cambiar Contraseña (Opcional)</p>
                        <p class="text-xs text-gray-500 mb-4">Deja estos campos vacíos si no deseas cambiar la contraseña</p>
                        
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-900 mb-2">Nueva Contraseña</label>
                                <input type="password" 
                                       name="password" 
                                       class="block w-full px-5 py-4 rounded-2xl border-2 border-gray-300 text-gray-900 placeholder-gray-400 focus:border-red-600 focus:ring-4 focus:ring-red-100 transition-all duration-200" 
                                       placeholder="Mínimo 8 caracteres (opcional)">
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-900 mb-2">Confirmar Nueva Contraseña</label>
                                <input type="password" 
                                       name="password_confirmation" 
                                       class="block w-full px-5 py-4 rounded-2xl border-2 border-gray-300 text-gray-900 placeholder-gray-400 focus:border-red-600 focus:ring-4 focus:ring-red-100 transition-all duration-200" 
                                       placeholder="Repite la contraseña">
                            </div>
                        </div>
                    </div>

                    {{-- Botones --}}
                    <div class="flex justify-center gap-3 pt-6 border-t-2 border-gray-100">
    <a href="{{ route('usuarios.index') }}" 
       class="inline-flex items-center gap-2 px-5 py-2 rounded-full bg-gray-100 hover:bg-gray-200 text-gray-900 font-medium transition-all duration-200 border-2 border-gray-200">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
        </svg>
        Cancelar
    </a>
    <button type="submit" 
            class="inline-flex items-center gap-2 px-5 py-2 rounded-full bg-red-600 text-white font-medium hover:bg-red-700 transition-all duration-200 shadow-md hover:shadow-lg">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
        </svg>
        Guardar Cambios
    </button>
</div>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>