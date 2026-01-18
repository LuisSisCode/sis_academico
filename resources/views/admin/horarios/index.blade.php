{{-- resources/views/admin/horarios/index.blade.php --}}
<x-admin-layout>
    <x-slot name="header">Gestión de Horarios</x-slot>

    <x-slot name="headerAction">
        <a href="{{ route('admin.horarios.create') }}"
           class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Nuevo Horario
        </a>
    </x-slot>

    <!-- Filtros -->
    <div class="bg-white shadow-sm rounded-lg p-4 mb-4">
        <form method="GET" action="{{ route('admin.horarios.index') }}">
            <div class="grid grid-cols-1 md:grid-cols-6 gap-4">
                <div>
                    <label for="ID_gestion" class="block text-sm font-medium text-gray-700 mb-1">Gestión</label>
                    <select name="ID_gestion" id="ID_gestion" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        <option value="">Todas</option>
                        @foreach($gestiones as $gestion)
                            <option value="{{ $gestion->ID_gestion }}" {{ request('ID_gestion') == $gestion->ID_gestion ? 'selected' : '' }}>
                                {{ $gestion->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="ID_carrera" class="block text-sm font-medium text-gray-700 mb-1">Carrera</label>
                    <select name="ID_carrera" id="ID_carrera" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        <option value="">Todas</option>
                        @foreach($carreras as $carrera)
                            <option value="{{ $carrera->ID_carrera }}" {{ request('ID_carrera') == $carrera->ID_carrera ? 'selected' : '' }}>
                                {{ $carrera->codigo_carrera }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="ID_semestre" class="block text-sm font-medium text-gray-700 mb-1">Semestre</label>
                    <select name="ID_semestre" id="ID_semestre" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        <option value="">Todos</option>
                        @foreach($semestres as $semestre)
                            <option value="{{ $semestre->ID_semestre }}" {{ request('ID_semestre') == $semestre->ID_semestre ? 'selected' : '' }}>
                                {{ $semestre->numero_semestre }}° - {{ $semestre->carrera->codigo_carrera }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="archivo_tipo" class="block text-sm font-medium text-gray-700 mb-1">Tipo</label>
                    <select name="archivo_tipo" id="archivo_tipo" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        <option value="">Todos</option>
                        <option value="pdf" {{ request('archivo_tipo') == 'pdf' ? 'selected' : '' }}>PDF</option>
                        <option value="imagen" {{ request('archivo_tipo') == 'imagen' ? 'selected' : '' }}>Imagen</option>
                        <option value="excel" {{ request('archivo_tipo') == 'excel' ? 'selected' : '' }}>Excel</option>
                        <option value="word" {{ request('archivo_tipo') == 'word' ? 'selected' : '' }}>Word</option>
                        <option value="texto" {{ request('archivo_tipo') == 'texto' ? 'selected' : '' }}>Texto</option>
                    </select>
                </div>
                <div>
                    <label for="buscar" class="block text-sm font-medium text-gray-700 mb-1">Buscar</label>
                    <input
                        type="text"
                        name="buscar"
                        id="buscar"
                        value="{{ request('buscar') }}"
                        placeholder="Nombre de archivo..."
                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                </div>
                <div class="flex items-end">
                    <button type="submit" class="w-full inline-flex justify-center items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        Buscar
                    </button>
                </div>
            </div>
        </form>
    </div>

    <div class="bg-white shadow-sm rounded-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Archivo
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Gestión
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Carrera
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Semestre
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Tipo
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Fecha
                    </th>
                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Acciones
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($horarios as $horario)
                <tr>
                    <td class="px-6 py-4">
                        <div class="flex items-center">
                            @if($horario->es_imagen)
                                <svg class="h-8 w-8 text-blue-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            @elseif($horario->es_pdf)
                                <svg class="h-8 w-8 text-red-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                </svg>
                            @else
                                <svg class="h-8 w-8 text-gray-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            @endif
                            <div>
                                <div class="text-sm font-medium text-gray-900">{{ $horario->archivo_nombre }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">{{ $horario->gestion->nombre }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">{{ $horario->carrera->nombre }}</div>
                        <div class="text-xs text-gray-500">{{ $horario->carrera->codigo_carrera }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($horario->semestre)
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                {{ $horario->semestre->numero_semestre }}°
                            </span>
                        @else
                            <span class="text-xs text-gray-400">Sin semestre</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($horario->archivo_tipo === 'pdf')
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">PDF</span>
                        @elseif($horario->archivo_tipo === 'imagen')
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">Imagen</span>
                        @elseif($horario->archivo_tipo === 'excel')
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Excel</span>
                        @elseif($horario->archivo_tipo === 'word')
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-indigo-100 text-indigo-800">Word</span>
                        @else
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">Texto</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $horario->created_at->format('d/m/Y') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <a href="{{ route('admin.horarios.descargar', $horario->ID_horario) }}"
                           class="text-green-600 hover:text-green-900 mr-3"
                           title="Descargar">
                            Descargar
                        </a>
                        <a href="{{ route('admin.horarios.edit', $horario->ID_horario) }}"
                           class="text-indigo-600 hover:text-indigo-900 mr-3">
                            Editar
                        </a>
                        <form action="{{ route('admin.horarios.destroy', $horario->ID_horario) }}"
                              method="POST"
                              class="inline-block"
                              onsubmit="return confirm('¿Estás seguro de eliminar este horario?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900">
                                Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-4 text-center text-sm text-gray-500">
                        No hay horarios registrados.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Paginación -->
    <div class="mt-4">
        {{ $horarios->links() }}
    </div>
</x-admin-layout>
