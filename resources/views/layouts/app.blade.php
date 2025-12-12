<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SIRA') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-gray-100">

    {{-- Alertas tipo toast --}}
    @if (session('message'))
        <x-alert-toast />
    @endif

    <div class="min-h-screen flex flex-col">

        {{-- NAVBAR --}}
        @include('layouts.navigation')

        {{-- Encabezado dinámico --}}
        @isset($header)
            <header
                class="bg-white shadow-md border-b border-gray-200">
                <div class="max-w-7xl mx-auto py-5 px-4 sm:px-6 lg:px-8 flex items-center justify-between">
                    <h1 class="text-xl font-semibold text-gray-800 tracking-wide">
                        {{ $header }}
                    </h1>

                    {{-- Migas de pan opcionales --}}
                    @yield('breadcrumb')
                </div>
            </header>
        @endisset

        {{-- Contenido principal --}}
        <main class="flex-1">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">

                @hasSection('content')
                    @yield('content')
                @else
                    {{ $slot ?? '' }}
                @endif

            </div>
        </main>

    </div>

</body>
</html>

