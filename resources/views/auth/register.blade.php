<x-guest-layout>
    
        <div class="bg-white shadow-lg rounded-xl p-8 w-full max-w-md border-t-4 border-red-600">

            <h2 class="text-2xl font-bold text-gray-800 text-center mb-6">
                Crear Cuenta
            </h2>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Nombre -->
                <div>
                    <x-input-label for="name" :value="__('Nombre Completo')" class="font-semibold text-gray-700" />
                    <x-text-input id="name" class="block mt-1 w-full border-gray-300 focus:border-red-600 focus:ring-red-600"
                        type="text" name="name" :value="old('name')" required />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email -->
                <div class="mt-4">
                    <x-input-label for="email" :value="__('Email')" class="font-semibold text-gray-700" />
                    <x-text-input id="email" class="block mt-1 w-full border-gray-300 focus:border-red-600 focus:ring-red-600"
                        type="email" name="email" :value="old('email')" required />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Contraseña -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Contraseña')" class="font-semibold text-gray-700" />
                    <x-text-input id="password"
                        class="block mt-1 w-full border-gray-300 focus:border-red-600 focus:ring-red-600"
                        type="password" name="password" required />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm -->
                <div class="mt-4">
                    <x-input-label for="password_confirmation" :value="__('Confirmar Contraseña')" class="font-semibold text-gray-700" />
                    <x-text-input id="password_confirmation"
                        class="block mt-1 w-full border-gray-300 focus:border-red-600 focus:ring-red-600"
                        type="password" name="password_confirmation" required />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <div class="flex items-center justify-between mt-6">
                    <a href="{{ route('login') }}" class="text-sm text-gray-600 hover:text-red-600">
                        ¿Ya tiene una cuenta?
                    </a>

                    <button type="submit"
                        class="px-5 py-2 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-lg shadow">
                        Registrarse
                    </button>
                </div>

            </form>
        </div>
    
</x-guest-layout>
