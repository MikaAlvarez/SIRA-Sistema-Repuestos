<x-app-layout>
    <div class="min-h-screen flex items-center justify-center bg-gray-100 px-4">
        <div class="bg-white shadow-lg rounded-xl p-8 max-w-md w-full text-center">

            <h1 class="text-2xl font-bold text-red-600 mb-4">
                Acceso no autorizado
            </h1>

            <p class="text-gray-600 mb-6">
                No tenés permisos para realizar esta acción.
                Si creés que se trata de un error, comunicate con un administrador.
            </p>

            <a href="{{ route('productos.index') }}"
               class="inline-block px-6 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition font-semibold">
                Volver a productos
            </a>

        </div>
    </div>
</x-app-layout>
