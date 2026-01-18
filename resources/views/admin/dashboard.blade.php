<x-admin-layout>
    <x-slot name="header">Dashboard</x-slot>

    <!-- Estadísticas -->
    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">
        <!-- Carreras -->
        <div class="overflow-hidden rounded-lg bg-white shadow">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <svg class="h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5" />
                        </svg>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="truncate text-sm font-medium text-gray-500">Carreras</dt>
                            <dd class="text-3xl font-semibold tracking-tight text-gray-900">{{ $stats['total_carreras'] }}</dd>
                        </dl>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-5 py-3">
                <a href="{{ route('admin.carreras.index') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">
                    Ver todas →
                </a>
            </div>
        </div>

        <!-- Materias -->
        <div class="overflow-hidden rounded-lg bg-white shadow">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <svg class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                        </svg>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="truncate text-sm font-medium text-gray-500">Materias</dt>
                            <dd class="text-3xl font-semibold tracking-tight text-gray-900">{{ $stats['total_materias'] }}</dd>
                        </dl>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-5 py-3">
                <a href="{{ route('admin.materias.index') }}" class="text-sm font-medium text-green-600 hover:text-green-500">
                    Ver todas →
                </a>
            </div>
        </div>

        <!-- Docentes -->
        <div class="overflow-hidden rounded-lg bg-white shadow">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <svg class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                        </svg>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="truncate text-sm font-medium text-gray-500">Docentes</dt>
                            <dd class="text-3xl font-semibold tracking-tight text-gray-900">{{ $stats['total_docentes'] }}</dd>
                        </dl>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-5 py-3">
                <a href="{{ route('admin.docentes.index') }}" class="text-sm font-medium text-blue-600 hover:text-blue-500">
                    Ver todos →
                </a>
            </div>
        </div>

        <!-- Auxiliares -->
        <div class="overflow-hidden rounded-lg bg-white shadow">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <svg class="h-6 w-6 text-purple-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                        </svg>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="truncate text-sm font-medium text-gray-500">Auxiliares</dt>
                            <dd class="text-3xl font-semibold tracking-tight text-gray-900">{{ $stats['total_auxiliares'] }}</dd>
                        </dl>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-5 py-3">
                <a href="{{ route('admin.auxiliares.index') }}" class="text-sm font-medium text-purple-600 hover:text-purple-500">
                    Ver todos →
                </a>
            </div>
        </div>
    </div>

    <!-- Gestión Actual -->
    @if($stats['gestion_actual'])
    <div class="mt-8">
        <div class="rounded-lg bg-blue-50 p-4">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-blue-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a.75.75 0 000 1.5h.253a.25.25 0 01.244.304l-.459 2.066A1.75 1.75 0 0010.747 15H11a.75.75 0 000-1.5h-.253a.25.25 0 01-.244-.304l.459-2.066A1.75 1.75 0 009.253 9H9z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3 flex-1">
                    <h3 class="text-sm font-medium text-blue-800">Gestión Actual</h3>
                    <div class="mt-2 text-sm text-blue-700">
                        <p>{{ $stats['gestion_actual']->nombre_completo }}</p>
                        <p class="mt-1">{{ $stats['gestion_actual']->fecha_inicio->format('d/m/Y') }} - {{ $stats['gestion_actual']->fecha_fin->format('d/m/Y') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Actividad Reciente -->
    <div class="mt-8 grid grid-cols-1 gap-5 lg:grid-cols-2">
        <!-- Últimas Carreras -->
        <div class="overflow-hidden rounded-lg bg-white shadow">
            <div class="p-6">
                <h3 class="text-base font-semibold leading-6 text-gray-900">Últimas Carreras</h3>
                <div class="mt-5 flow-root">
                    <ul role="list" class="-my-5 divide-y divide-gray-200">
                        @forelse($ultimasCarreras as $carrera)
                        <li class="py-4">
                            <div class="flex items-center space-x-4">
                                <div class="min-w-0 flex-1">
                                    <p class="truncate text-sm font-medium text-gray-900">{{ $carrera->nombre }}</p>
                                    <p class="truncate text-sm text-gray-500">{{ $carrera->codigo_carrera }}</p>
                                </div>
                                <div>
                                    <span class="inline-flex items-center rounded-full px-2 py-1 text-xs font-medium {{ $carrera->activo ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-700' }}">
                                        {{ $carrera->activo ? 'Activa' : 'Inactiva' }}
                                    </span>
                                </div>
                            </div>
                        </li>
                        @empty
                        <li class="py-4 text-center text-sm text-gray-500">
                            No hay carreras registradas
                        </li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>

        <!-- Últimas Materias -->
        <div class="overflow-hidden rounded-lg bg-white shadow">
            <div class="p-6">
                <h3 class="text-base font-semibold leading-6 text-gray-900">Últimas Materias</h3>
                <div class="mt-5 flow-root">
                    <ul role="list" class="-my-5 divide-y divide-gray-200">
                        @forelse($ultimasMaterias as $materia)
                        <li class="py-4">
                            <div class="flex items-center space-x-4">
                                <div class="min-w-0 flex-1">
                                    <p class="truncate text-sm font-medium text-gray-900">{{ $materia->Nombre }}</p>
                                    <p class="truncate text-sm text-gray-500">{{ $materia->sigla }} - {{ $materia->semestre->nombre }}</p>
                                </div>
                                <div>
                                    <span class="inline-flex items-center rounded-full px-2 py-1 text-xs font-medium {{ $materia->tiene_auxiliar ? 'bg-blue-100 text-blue-700' : 'bg-gray-100 text-gray-700' }}">
                                        {{ $materia->tiene_auxiliar ? 'Con auxiliar' : 'Sin auxiliar' }}
                                    </span>
                                </div>
                            </div>
                        </li>
                        @empty
                        <li class="py-4 text-center text-sm text-gray-500">
                            No hay materias registradas
                        </li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
