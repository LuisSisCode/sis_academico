{{-- resources/views/admin/gestiones/create.blade.php --}}
<x-admin-layout>
    <x-slot name="header">Crear Nueva Gestión</x-slot>

    <div class="max-w-2xl">
        <div class="bg-white shadow-sm rounded-lg p-6">
            <form action="{{ route('admin.gestiones.store') }}" method="POST">
                @csrf

                <!-- Nombre -->
                <div class="mb-4">
                    <label for="nombre" class="block text-sm font-medium text-gray-700 mb-2">
                        Nombre de la Gestión *
                    </label>
                    <input type="text"
                           name="nombre"
                           id="nombre"
                           value="{{ old('nombre') }}"
                           placeholder="Ej: Primer Semestre 2026"
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
                            <option value="1" {{ old('numero') == '1' ? 'selected' : '' }}>1 - Primer Semestre</option>
                            <option value="2" {{ old('numero') == '2' ? 'selected' : '' }}>2 - Segundo Semestre</option>
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
                               value="{{ old('anio', date('Y')) }}"
                               min="2020"
                               max="2030"
                               placeholder="2026"
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
                               value="{{ old('fecha_inicio') }}"
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
                               value="{{ old('fecha_fin') }}"
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
                                   {{ old('es_actual') ? 'checked' : '' }}
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

                <!-- Botones -->
                <div class="flex items-center justify-end space-x-3">
                    <a href="{{ route('admin.gestiones.index') }}"
                       class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        Cancelar
                    </a>
                    <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        Guardar Gestión
                    </button>
                </div>
            </form>
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

    // Auto-generar nombre basado en número y año
    const numeroSelect = document.getElementById('numero');
    const anioInput = document.getElementById('anio');
    const nombreInput = document.getElementById('nombre');

    function generarNombre() {
        const numero = numeroSelect.value;
        const anio = anioInput.value;

        if (numero && anio && !nombreInput.value) {
            const nombreSemestre = numero === '1' ? 'Primer' : 'Segundo';
            nombreInput.value = `${nombreSemestre} Semestre ${anio}`;
        }
    }

    numeroSelect?.addEventListener('change', generarNombre);
    anioInput?.addEventListener('blur', generarNombre);
    </script>
    @endpush
</x-admin-layout>
