<nav x-data="{ open: false }" class="bg-white border-b-4 border-red-600 shadow-lg">
    <!-- TOP BAR -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">

            <!-- LOGO + NOMBRE -->
            <div class="flex-shrink-0 flex items-center gap-3">
                <div class="bg-red-600 rounded-full p-2.5 shadow-md">
                    <span class="text-xl font-extrabold text-white">IF</span>
                </div>

                <div>
                    <a href="{{ route('dashboard') }}"
                       class="text-2xl font-extrabold tracking-wide text-gray-900 hover:text-red-600 transition">
                        SIRA
                    </a>
                    <p class="text-xs text-gray-500">Italfiat Repuestos</p>
                </div>
            </div>

            <!-- DESKTOP MENU -->
            <div class="hidden sm:flex sm:items-center space-x-1 ml-10">

                <!-- DASHBOARD -->
                <a href="{{ route('dashboard') }}"
                   class="px-4 py-2 rounded-md font-medium transition
                   {{ request()->routeIs('dashboard') ? 'bg-red-600 text-white shadow' : 'text-gray-900 hover:bg-gray-100' }}">
                    📊 Panel Principal
                </a>

                <!-- PRODUCTOS -->
                <a href="{{ route('productos.index') }}"
                   class="px-4 py-2 rounded-md font-medium transition
                   {{ request()->routeIs('productos.*') ? 'bg-red-600 text-white shadow' : 'text-gray-900 hover:bg-gray-100' }}">
                    📦 Productos
                </a>

                <!-- CATEGORIAS (solo admin) -->
                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('categorias.index') }}"
                    class="px-4 py-2 rounded-md font-medium transition
                    {{ request()->routeIs('categorias.*') ? 'bg-red-600 text-white shadow' : 'text-gray-900 hover:bg-gray-100' }}">
                        🏷️ Categorías
                    </a>
                @endif

                <!-- USUARIOS (solo admin) -->
                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('usuarios.index') }}"
                    class="px-4 py-2 rounded-md font-medium transition
                    {{ request()->routeIs('usuarios.*') ? 'bg-red-600 text-white shadow' : 'text-gray-900 hover:bg-gray-100' }}">
                        👥 Usuarios
                    </a>
                @endif

            </div>

            <!-- USER DROPDOWN -->
            <div class="hidden sm:flex sm:items-center sm:ml-6 ml-auto">

                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="flex items-center text-sm font-semibold text-gray-900 border border-gray-300 px-4 py-2 rounded-md bg-white hover:bg-gray-50 hover:text-red-600 transition">
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                          d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0L5.25 8.27a.75.75 0 01-.02-1.06z"
                                          clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">

                        <x-dropdown-link :href="route('profile.edit')">
                            👤 Perfil
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                🚪 Cerrar sesión
                            </x-dropdown-link>
                        </form>

                    </x-slot>
                </x-dropdown>

            </div>

            <!-- HAMBURGER (MÓVIL) -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-900 hover:bg-gray-100 transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }"
                              class="inline-flex"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }"
                              class="hidden"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

        </div>
    </div>

    <!-- RESPONSIVE MENU -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-gray-50 border-t">
        <div class="pt-2 pb-3 space-y-1">

            <!-- DASHBOARD -->
            <a href="{{ route('dashboard') }}"
               class="block pl-3 pr-4 py-2 border-l-4 text-gray-900 transition
               {{ request()->routeIs('dashboard') ? 'border-red-600 bg-red-50 font-bold' : 'border-transparent hover:bg-gray-100' }}">
                📊 Dashboard
            </a>

            <!-- PRODUCTOS -->
            <a href="{{ route('productos.index') }}"
               class="block pl-3 pr-4 py-2 border-l-4 text-gray-900 transition
               {{ request()->routeIs('productos.*') ? 'border-red-600 bg-red-50 font-bold' : 'border-transparent hover:bg-gray-100' }}">
                📦 Productos
            </a>

            <!-- CATEGORÍAS (admin) -->
            @if(auth()->user()->role === 'admin')
                <a href="{{ route('categorias.index') }}"
                   class="block pl-3 pr-4 py-2 border-l-4 text-gray-900 transition
                   {{ request()->routeIs('categorias.*') ? 'border-red-600 bg-red-50 font-bold' : 'border-transparent hover:bg-gray-100' }}">
                    🏷️ Categorías
                </a>
            @endif
        </div>

        <!-- USER MOBILE -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-semibold text-base text-gray-900">{{ Auth::user()->name }}</div>
                <div class="font-semibold text-sm text-gray-600">{{ Auth::user()->email }}</div>

                <span class="inline-block mt-2 px-3 py-1 text-xs font-bold rounded-md
                    {{ auth()->user()->role === 'admin' ? 'bg-red-600 text-white' : 'bg-gray-200 text-gray-900' }}">
                    {{ auth()->user()->role === 'admin' ? '👑 Administrador' : '👤 Empleado' }}
                </span>
            </div>

            <div class="mt-3 space-y-1">
                <a href="{{ route('profile.edit') }}" class="block pl-3 pr-4 py-2 text-gray-900 hover:bg-gray-100">
                    👤 Perfil
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault(); this.closest('form').submit();"
                       class="block pl-3 pr-4 py-2 text-gray-900 hover:bg-gray-100">
                        🚪 Cerrar sesión
                    </a>
                </form>
            </div>
        </div>
    </div>

</nav>

