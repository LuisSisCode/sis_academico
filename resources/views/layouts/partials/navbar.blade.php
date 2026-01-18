<div class="sticky top-0 z-40 flex h-16 shrink-0 items-center gap-x-4 border-b border-gray-200 bg-white px-4 shadow-sm sm:gap-x-6 sm:px-6 lg:px-8">
    <!-- Botón hamburguesa para móvil -->
    <button type="button" class="-m-2.5 p-2.5 text-gray-700 lg:hidden" @click="open = true">
        <span class="sr-only">Abrir sidebar</span>
        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
        </svg>
    </button>

    <!-- Separador -->
    <div class="h-6 w-px bg-gray-200 lg:hidden" aria-hidden="true"></div>

    <div class="flex flex-1 gap-x-4 self-stretch lg:gap-x-6">
        <div class="relative flex flex-1 items-center">
            <!-- Breadcrumb o título aquí si lo necesitas -->
        </div>
        <div class="flex items-center gap-x-4 lg:gap-x-6">
            <!-- Notificaciones (opcional) -->
            <button type="button" class="-m-2.5 p-2.5 text-gray-400 hover:text-gray-500">
                <span class="sr-only">Ver notificaciones</span>
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                </svg>
            </button>

            <!-- Separador -->
            <div class="hidden lg:block lg:h-6 lg:w-px lg:bg-gray-200" aria-hidden="true"></div>

            <!-- Profile dropdown -->
            <div class="relative" x-data="{ open: false }">
                <button type="button" class="-m-1.5 flex items-center p-1.5" @click="open = !open">
                    <span class="sr-only">Abrir menú de usuario</span>
                    <div class="h-8 w-8 rounded-full bg-indigo-600 flex items-center justify-center text-white text-sm font-medium">
                        {{ substr(auth()->user()->nombre, 0, 1) }}
                    </div>
                    <span class="hidden lg:flex lg:items-center">
                        <span class="ml-4 text-sm font-semibold leading-6 text-gray-900" aria-hidden="true">
                            {{ auth()->user()->nombre }}
                        </span>
                        <svg class="ml-2 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                        </svg>
                    </span>
                </button>

                <div x-show="open" @click.away="open = false"
                     class="absolute right-0 z-10 mt-2.5 w-48 origin-top-right rounded-md bg-white py-2 shadow-lg ring-1 ring-gray-900/5 focus:outline-none"
                     style="display: none;">
                    <a href="{{ route('profile.edit') }}" class="block px-3 py-1 text-sm leading-6 text-gray-900 hover:bg-gray-50">
                        Tu Perfil
                    </a>

                    <!-- Formulario de logout usando Livewire si está disponible -->
                    @if(Route::has('logout'))
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="block w-full text-left px-3 py-1 text-sm leading-6 text-gray-900 hover:bg-gray-50">
                                Cerrar Sesión
                            </button>
                        </form>
                    @else
                        <!-- Alternativa si la ruta no existe -->
                        <button onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                class="block w-full text-left px-3 py-1 text-sm leading-6 text-gray-900 hover:bg-gray-50">
                            Cerrar Sesión
                        </button>
                        <form id="logout-form" action="/logout" method="POST" style="display: none;">
                            @csrf
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
