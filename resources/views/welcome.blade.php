<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Sistema Integral de Repuestos Automotores') }}</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
    <body class="bg-gray-100 text-gray-900 flex p-6 lg:p-8 items-center lg:justify-center min-h-screen flex-col">
        
        <header class="w-full lg:max-w-4xl max-w-full text-sm mb-6">
            @if (Route::has('login'))
                <nav class="flex items-center justify-end gap-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" 
                           class="inline-block px-5 py-1.5 border border-gray-300 hover:border-red-600 text-gray-800 rounded-md text-sm">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" 
                           class="inline-block px-5 py-1.5 text-gray-800 border border-transparent hover:border-gray-300 rounded-md text-sm">
                            Iniciar Sesión
                        </a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" 
                               class="inline-block px-5 py-1.5 border border-gray-300 hover:border-red-600 text-gray-800 rounded-md text-sm">
                                Registrarse
                            </a>
                        @endif
                    @endauth
                </nav>
            @endif
        </header>

        <div class="flex items-center justify-center w-full">
            <main class="max-w-4xl w-full">
                <div class="bg-white shadow-xl rounded-xl p-8 lg:p-20 border-t-4 border-red-600">
                    
                    {{-- Logo SIRA --}}
                    <div class="flex items-center justify-center mb-8">
                        <div class="bg-red-600 rounded-full p-8 shadow-2xl">
                            <span class="text-6xl font-extrabold text-white">IF</span>
                        </div>
                    </div>

                    <h1 class="text-3xl font-bold text-center text-gray-900 mb-2">
                        Sistema Integral de Repuestos Automotores
                    </h1>
                    
                    <p class="text-center text-gray-600 mb-8">
                        Italfiat Repuestos
                    </p>

                    <div class="grid md:grid-cols-2 gap-6">
                        <div class="bg-gray-50 p-6 rounded-lg border border-gray-200">
                            <h2 class="text-lg font-semibold text-gray-900 mb-2">📦 Gestión de Productos</h2>
                            <p class="text-sm text-gray-600">Control completo de tu inventario de repuestos automotores.</p>
                        </div>

                        <div class="bg-gray-50 p-6 rounded-lg border border-gray-200">
                            <h2 class="text-lg font-semibold text-gray-900 mb-2">🏷️ Categorías</h2>
                            <p class="text-sm text-gray-600">Organiza tus productos de manera eficiente.</p>
                        </div>

                        <div class="bg-gray-50 p-6 rounded-lg border border-gray-200">
                            <h2 class="text-lg font-semibold text-gray-900 mb-2">👥 Usuarios</h2>
                            <p class="text-sm text-gray-600">Administra roles y permisos de tu equipo.</p>
                        </div>

                        <div class="bg-gray-50 p-6 rounded-lg border border-gray-200">
                            <h2 class="text-lg font-semibold text-gray-900 mb-2">📊 Reportes</h2>
                            <p class="text-sm text-gray-600">Visualiza estadísticas y movimientos en tiempo real.</p>
                        </div>
                    </div>

                    <div class="mt-8 text-center">
                        <a href="{{ route('login') }}" 
                           class="inline-block px-8 py-3 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-lg shadow-lg">
                            Acceder al Sistema
                        </a>
                    </div>

                </div>
            </main>
        </div>

    </body>
</html>