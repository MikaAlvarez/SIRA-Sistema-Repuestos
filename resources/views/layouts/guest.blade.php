<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased bg-gray-100">

    <div class="min-h-screen flex flex-col justify-center items-center py-8">

        {{-- TARJETA DEL LOGIN/REGISTER --}}
        <div class="w-full sm:max-w-md bg-white shadow-lg rounded-lg overflow-hidden">

            {{-- ENCABEZADO ROJO (dentro del recuadro) --}}
            <div class="bg-gray-200 py-6 px-6 text-center border-b-4 border-red-600">

                <h1 class="text-2xl font-bold text-red-700">
                    Sistema Integral de Repuestos Automotores
                </h1>

            </div>

            {{-- CONTENIDO (formulario) --}}
            <div class="px-6 py-8">
                {{ $slot }}
            </div>

        </div>
    </div>

</body>
</html>
