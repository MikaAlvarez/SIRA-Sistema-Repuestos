<x-guest-layout>

        <div class="bg-white shadow-lg rounded-xl p-8 w-full max-w-md border-t-4 border-red-600">

            <!-- Título -->
            <h2 class="text-2xl font-bold text-gray-800 text-center mb-6">
                Iniciar Sesión
            </h2>

            <!-- Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email -->
                <div>
                    <x-input-label for="email" :value="__('Ingrese su usuario')" class="font-semibold text-gray-700"/>
                    <x-text-input id="email"
                        class="block mt-1 w-full border-gray-300 focus:border-red-600 focus:ring-red-600"
                        type="email" name="email" :value="old('email')" required autofocus />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Ingrese su contraseña')" class="font-semibold text-gray-700"/>
                    <x-text-input id="password"
                        class="block mt-1 w-full border-gray-300 focus:border-red-600 focus:ring-red-600"
                        type="password" name="password" required />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember -->
                <div class="flex items-center mt-4">
                    <input id="remember_me" type="checkbox"
                        class="rounded border-gray-300 text-red-600 shadow-sm focus:ring-red-500"
                        name="remember">
                    <label for="remember_me" class="ms-2 text-sm text-gray-600">
                        Recordar mi usuario
                    </label>
                </div>

                <!-- Acciones -->
                <div class="flex items-center justify-between mt-6">



                    <button type="submit"
                        class="px-8 py-2 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-lg shadow">
                        Acceder
                    </button>
                </div>
            </form>
        </div>    

</x-guest-layout>
