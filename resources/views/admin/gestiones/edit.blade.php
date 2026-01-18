{{-- resources/views/admin/gestiones/edit.blade.php --}}
<x-admin-layout>
    <x-slot name="header">Editar Gestión</x-slot>

    <div class="max-w-2xl">
        <div class="bg-white shadow-sm rounded-lg p-6">
            <form action="{{ route('admin.gestiones.update', $gestion->ID_gestion) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Información adicional -->
                @if($gestion->es_actual)
                    <div class="mb-4 bg-green-50 border-l-4 border-green-400 p-4 rounded">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-green-700 font-medium">Esta es la gestión actual</p>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Nombre -->
                <div class="mb-4">
                    <label for="nombre" class="block text-sm font-medium text-gray-700 mb-2">
                        Nombre de la Gestión *
                    </label>
                    <input type="text"
                           name="nombre"
                           id="nombre"
                           value="{{ old('nombre', $gestion->nombre) }}"
                           class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('nombre') border-red-500 @enderror"
                           required>
                    @error('nombre')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Número y Año -->
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <!-- Número de Semestre -->
                    <div>
                        <label for="numero" class="block text-sm font-medium text-gray-700 mb-2">
                            Número de Semestre *
                        </label>
                        <select name="numero"
                                id="numero"
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('numero') border-red-500 @enderror"
                                required>
                            <option value="">Seleccionar</option>
                            <option value="1" {{ old('numero', $gestion->numero) == '1' ? 'selected' : '' }}>1 - Primer Semestre</option>
                            <option value="2" {{ old('numero', $gestion->numero) == '2' ? 'selected' : '' }}>2 - Segundo Semestre</option>
                        </select>
                        @error('numero')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Año -->
                    <div>
                        <label for="anio" class="block text-sm font-medium text-gray-700 mb-2">
                            Año *
                        </label>
                        <input type="number"
                               name="anio"
                               id="anio"
                               value="{{ old('anio', $gestion->anio) }}"
                               min="2020"
                               max="2030"
                               class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('anio') border-red-500 @enderror"
                               required>
                        @error('anio')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Fechas -->
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <!-- Fecha de Inicio -->
                    <div>
                        <label for="fecha_inicio" class="block text-sm font-medium text-gray-700 mb-2">
                            Fecha de Inicio *
                        </label>
                        <input type="date"
                               name="fecha_inicio"
                               id="fecha_inicio"
                               value="{{ old('fecha_inicio', $gestion->fecha_inicio->format('Y-m-d')) }}"
                               class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('fecha_inicio') border-red-500 @enderror"
                               required>
                        @error('fecha_inicio')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Fecha de Fin -->
                    <div>
                        <label for="fecha_fin" class="block text-sm font-medium text-gray-700 mb-2">
                            Fecha de Fin *
                        </label>
                        <input type="date"
                               name="fecha_fin"
                               id="fecha_fin"
                               value="{{ old('fecha_fin', $gestion->fecha_fin->format('Y-m-d')) }}"
                               class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('fecha_fin') border-red-500 @enderror"
                               required>
                        @error('fecha_fin')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Es Actual -->
                <div class="mb-6">
                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <input type="checkbox"
                                   name="es_actual"
                                   id="es_actual"
                                   value="1"
                                   {{ old('es_actual', $gestion->es_actual) ? 'checked' : '' }}
                                   class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                        </div>
                        <div class="ml-3 text-sm">
                            <label for="es_actual" class="font-medium text-gray-700">Marcar como gestión actual</label>
                            <p class="text-gray-500">Solo puede haber una gestión activa a la vez. Si activas esta, las demás se desactivarán automáticamente.</p>
                        </div>
                    </div>
                    @error('es_actual')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Advertencia si tiene relaciones -->
                @if($gestion->materiaGestionDocente()->count() > 0 || $gestion->horarios()->count() > 0)
                    <div class="mb-6 bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-yellow-800">Esta gestión está siendo utilizada</h3>
                                <div class="mt-2 text-sm text-yellow-700">
                                    <ul class="list-disc list-inside space-y-1">
                                        @if($gestion->materiaGestionDocente()->count() > 0)
                                            <li>{{ $gestion->materiaGestionDocente()->count() }} asignación(es) de materias</li>
                                        @endif
                                        @if($gestion->horarios()->count() > 0)
                                            <li>{{ $gestion->horarios()->count() }} horario(s)</li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Botones -->
                <div class="flex items-center justify-end space-x-3">
                    <a href="{{ route('admin.gestiones.index') }}"
                       class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        Cancelar
                    </a>
                    <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        Actualizar Gestión
                    </button>
                </div>
            </form>
        </div>

        <!-- Información adicional -->
        <div class="mt-6 bg-white shadow-sm rounded-lg p-6">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Información Adicional</h3>
            <dl class="grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
                <div>
                    <dt class="text-sm font-medium text-gray-500">ID de Gestión</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $gestion->ID_gestion }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Nombre Completo</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $gestion->nombre_completo }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Duración</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $gestion->fecha_inicio->diffInDays($gestion->fecha_fin) }} días</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Materias Asignadas</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $gestion->materiaGestionDocente()->count() }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Horarios</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $gestion->horarios()->count() }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Fecha de Creación</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $gestion->created_at->format('d/m/Y H:i') }}</dd>
                </div>
            </dl>
        </div>
    </div>

    @push('scripts')
    <script>
    // Validación de fechas
    document.getElementById('fecha_inicio')?.addEventListener('change', function() {
        const fechaFin = document.getElementById('fecha_fin');
        fechaFin.min = this.value;
    });

    document.getElementById('fecha_fin')?.addEventListener('change', function() {
        const fechaInicio = document.getElementById('fecha_inicio');
        if (fechaInicio.value && this.value < fechaInicio.value) {
            alert('La fecha de fin debe ser posterior a la fecha de inicio');
            this.value = '';
        }
    });
    </script>
    @endpush
</x-admin-layout>
