{{-- resources/views/admin/horarios/create.blade.php --}}
<x-admin-layout>
    <x-slot name="header">Crear Nuevo Horario</x-slot>

    <div class="max-w-2xl">
        <div class="bg-white shadow-sm rounded-lg p-6">
            <form action="{{ route('admin.horarios.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

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
                            <option value="{{ $gestion->ID_gestion }}" {{ old('ID_gestion') == $gestion->ID_gestion ? 'selected' : '' }}>
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
                            <option value="{{ $carrera->ID_carrera }}" {{ old('ID_carrera') == $carrera->ID_carrera ? 'selected' : '' }}>
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
                            <option value="{{ $semestre->ID_semestre }}" {{ old('ID_semestre') == $semestre->ID_semestre ? 'selected' : '' }}>
                                {{ $semestre->numero_semestre }}° Semestre - {{ $semestre->carrera->nombre }}
                            </option>
                        @endforeach
                    </select>
                    @error('ID_semestre')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <p class="mt-1 text-xs text-gray-500">Deje vacío si el horario es para toda la carrera</p>
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
                        <option value="pdf" {{ old('archivo_tipo') == 'pdf' ? 'selected' : '' }}>PDF (.pdf)</option>
                        <option value="imagen" {{ old('archivo_tipo') == 'imagen' ? 'selected' : '' }}>Imagen (.jpg, .png, .gif, .webp)</option>
                        <option value="excel" {{ old('archivo_tipo') == 'excel' ? 'selected' : '' }}>Excel (.xls, .xlsx, .csv)</option>
                        <option value="word" {{ old('archivo_tipo') == 'word' ? 'selected' : '' }}>Word (.doc, .docx)</option>
                        <option value="texto" {{ old('archivo_tipo') == 'texto' ? 'selected' : '' }}>Texto (.txt)</option>
                    </select>
                    @error('archivo_tipo')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Archivo -->
                <div class="mb-6">
                    <label for="archivo" class="block text-sm font-medium text-gray-700 mb-2">
                        Archivo *
                    </label>
                    <input type="file"
                           name="archivo"
                           id="archivo"
                           class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 @error('archivo') border-red-500 @enderror"
                           required>
                    @error('archivo')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <p class="mt-1 text-xs text-gray-500">Tamaño máximo: 10MB</p>
                </div>

                <!-- Botones -->
                <div class="flex items-center justify-end space-x-3">
                    <a href="{{ route('admin.horarios.index') }}"
                       class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        Cancelar
                    </a>
                    <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        Guardar Horario
                    </button>
                </div>
            </form>
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
                // Mostrar solo los semestres de la carrera seleccionada
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

        // Resetear selección si no coincide
        if (semestreSelect.value) {
            const selectedOption = semestreSelect.querySelector(`option[value="${semestreSelect.value}"]`);
            if (selectedOption && selectedOption.style.display === 'none') {
                semestreSelect.value = '';
            }
        }
    });

    // Mostrar preview del nombre del archivo
    document.getElementById('archivo')?.addEventListener('change', function() {
        const fileName = this.files[0]?.name;
        if (fileName) {
            console.log('Archivo seleccionado:', fileName);
        }
    });
    </script>
    @endpush
</x-admin-layout>
