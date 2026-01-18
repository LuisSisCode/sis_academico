{{-- resources/views/admin/horarios/edit.blade.php --}}
<x-admin-layout>
    <x-slot name="header">Editar Horario</x-slot>

    <div class="max-w-2xl">
        <div class="bg-white shadow-sm rounded-lg p-6">
            <form action="{{ route('admin.horarios.update', $horario->ID_horario) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Información del archivo actual -->
                <div class="mb-4 bg-blue-50 border-l-4 border-blue-400 p-4 rounded">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-blue-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-blue-700">
                                <strong>Archivo actual:</strong> {{ $horario->archivo_nombre }}
                            </p>
                            <p class="text-xs text-blue-600 mt-1">
                                Subido el {{ $horario->created_at->format('d/m/Y H:i') }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Gestión -->
                <div class="mb-4">
                    <label for="ID_gestion" class="block text-sm font-medium text-gray-700 mb-2">
                        Gestión *
                    </label>
                    <select name="ID_gestion"
                            id="ID_gestion"
                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('ID_gestion') border-red-500 @enderror"
                            required>
                        <option value="">Seleccione una gestión</option>
                        @foreach($gestiones as $gestion)
                            <option value="{{ $gestion->ID_gestion }}" {{ old('ID_gestion', $horario->ID_gestion) == $gestion->ID_gestion ? 'selected' : '' }}>
                                {{ $gestion->nombre }} ({{ $gestion->anio }})
                            </option>
                        @endforeach
                    </select>
                    @error('ID_gestion')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Carrera -->
                <div class="mb-4">
                    <label for="ID_carrera" class="block text-sm font-medium text-gray-700 mb-2">
                        Carrera *
                    </label>
                    <select name="ID_carrera"
                            id="ID_carrera"
                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('ID_carrera') border-red-500 @enderror"
                            required>
                        <option value="">Seleccione una carrera</option>
                        @foreach($carreras as $carrera)
                            <option value="{{ $carrera->ID_carrera }}" {{ old('ID_carrera', $horario->ID_carrera) == $carrera->ID_carrera ? 'selected' : '' }}>
                                {{ $carrera->nombre }} ({{ $carrera->codigo_carrera }})
                            </option>
                        @endforeach
                    </select>
                    @error('ID_carrera')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Semestre -->
                <div class="mb-4">
                    <label for="ID_semestre" class="block text-sm font-medium text-gray-700 mb-2">
                        Semestre (Opcional)
                    </label>
                    <select name="ID_semestre"
                            id="ID_semestre"
                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('ID_semestre') border-red-500 @enderror">
                        <option value="">Sin semestre específico</option>
                        @foreach($semestres as $semestre)
                            <option value="{{ $semestre->ID_semestre }}" {{ old('ID_semestre', $horario->ID_semestre) == $semestre->ID_semestre ? 'selected' : '' }}>
                                {{ $semestre->numero_semestre }}° Semestre - {{ $semestre->carrera->nombre }}
                            </option>
                        @endforeach
                    </select>
                    @error('ID_semestre')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Tipo de Archivo -->
                <div class="mb-4">
                    <label for="archivo_tipo" class="block text-sm font-medium text-gray-700 mb-2">
                        Tipo de Archivo *
                    </label>
                    <select name="archivo_tipo"
                            id="archivo_tipo"
                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('archivo_tipo') border-red-500 @enderror"
                            required>
                        <option value="">Seleccionar tipo</option>
                        <option value="pdf" {{ old('archivo_tipo', $horario->archivo_tipo) == 'pdf' ? 'selected' : '' }}>PDF (.pdf)</option>
                        <option value="imagen" {{ old('archivo_tipo', $horario->archivo_tipo) == 'imagen' ? 'selected' : '' }}>Imagen (.jpg, .png, .gif, .webp)</option>
                        <option value="excel" {{ old('archivo_tipo', $horario->archivo_tipo) == 'excel' ? 'selected' : '' }}>Excel (.xls, .xlsx, .csv)</option>
                        <option value="word" {{ old('archivo_tipo', $horario->archivo_tipo) == 'word' ? 'selected' : '' }}>Word (.doc, .docx)</option>
                        <option value="texto" {{ old('archivo_tipo', $horario->archivo_tipo) == 'texto' ? 'selected' : '' }}>Texto (.txt)</option>
                    </select>
                    @error('archivo_tipo')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Archivo (Opcional en edición) -->
                <div class="mb-6">
                    <label for="archivo" class="block text-sm font-medium text-gray-700 mb-2">
                        Reemplazar Archivo (Opcional)
                    </label>
                    <input type="file"
                           name="archivo"
                           id="archivo"
                           class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 @error('archivo') border-red-500 @enderror">
                    @error('archivo')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <p class="mt-1 text-xs text-gray-500">Deje vacío si no desea cambiar el archivo. Tamaño máximo: 10MB</p>
                </div>

                <!-- Botones -->
                <div class="flex items-center justify-end space-x-3">
                    <a href="{{ route('admin.horarios.index') }}"
                       class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        Cancelar
                    </a>
                    <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        Actualizar Horario
                    </button>
                </div>
            </form>
        </div>

        <!-- Vista previa del archivo -->
        <div class="mt-6 bg-white shadow-sm rounded-lg p-6">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Archivo Actual</h3>
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    @if($horario->es_pdf)
                        <svg class="h-12 w-12 text-red-500 mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                        </svg>
                    @elseif($horario->es_imagen)
                        <svg class="h-12 w-12 text-blue-500 mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    @else
                        <svg class="h-12 w-12 text-gray-500 mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    @endif
                    <div>
                        <p class="text-sm font-medium text-gray-900">{{ $horario->archivo_nombre }}</p>
                        <p class="text-xs text-gray-500">Tipo: {{ ucfirst($horario->archivo_tipo) }}</p>
                    </div>
                </div>
                <a href="{{ route('admin.horarios.descargar', $horario->ID_horario) }}"
                   class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                    </svg>
                    Descargar
                </a>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
    // Filtrar semestres según carrera seleccionada
    document.getElementById('ID_carrera')?.addEventListener('change', function() {
        const carreraId = this.value;
        const semestreSelect = document.getElementById('ID_semestre');
        const options = semestreSelect.querySelectorAll('option:not([value=""])');

        options.forEach(option => {
            const optionText = option.textContent;
            if (carreraId) {
                const carreraNombre = this.options[this.selectedIndex].text.split('(')[0].trim();
                if (optionText.includes(carreraNombre)) {
                    option.style.display = '';
                } else {
                    option.style.display = 'none';
                }
            } else {
                option.style.display = '';
            }
        });

        if (semestreSelect.value) {
            const selectedOption = semestreSelect.querySelector(`option[value="${semestreSelect.value}"]`);
            if (selectedOption && selectedOption.style.display === 'none') {
                semestreSelect.value = '';
            }
        }
    });
    </script>
    @endpush
</x-admin-layout>
