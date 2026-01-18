<x-admin-layout>
    <x-slot name="header">Editar Materia</x-slot>

    <div class="max-w-3xl">
        <div class="bg-white shadow-sm rounded-lg p-6">
            <form action="{{ route('admin.materias.update', $materia->ID_materia) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
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
                                <option value="{{ $carrera->ID_carrera }}" {{ old('ID_carrera', $materia->ID_carrera) == $carrera->ID_carrera ? 'selected' : '' }}>
                                    {{ $carrera->nombre }}
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
                            Semestre *
                        </label>
                        <select name="ID_semestre"
                                id="ID_semestre"
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('ID_semestre') border-red-500 @enderror"
                                required>
                            <option value="">Seleccione un semestre</option>
                            @foreach($semestres as $semestre)
                                <option value="{{ $semestre->ID_semestre }}" {{ old('ID_semestre', $materia->ID_semestre) == $semestre->ID_semestre ? 'selected' : '' }}>
                                    {{ $semestre->nombre }} - {{ $semestre->carrera->nombre }}
                                </option>
                            @endforeach
                        </select>
                        @error('ID_semestre')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Nombre -->
                <div class="mb-4">
                    <label for="Nombre" class="block text-sm font-medium text-gray-700 mb-2">
                        Nombre de la Materia *
                    </label>
                    <input type="text"
                           name="Nombre"
                           id="Nombre"
                           value="{{ old('Nombre', $materia->Nombre) }}"
                           class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('Nombre') border-red-500 @enderror"
                           required>
                    @error('Nombre')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Sigla -->
                    <div class="mb-4">
                        <label for="sigla" class="block text-sm font-medium text-gray-700 mb-2">
                            Sigla *
                        </label>
                        <input type="text"
                               name="sigla"
                               id="sigla"
                               value="{{ old('sigla', $materia->sigla) }}"
                               class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('sigla') border-red-500 @enderror"
                               required>
                        @error('sigla')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Créditos -->
                    <div class="mb-4">
                        <label for="creditos" class="block text-sm font-medium text-gray-700 mb-2">
                            Créditos *
                        </label>
                        <input type="number"
                               name="creditos"
                               id="creditos"
                               value="{{ old('creditos', $materia->creditos) }}"
                               min="1"
                               max="10"
                               class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('creditos') border-red-500 @enderror"
                               required>
                        @error('creditos')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Descripción -->
                <div class="mb-4">
                    <label for="descripcion" class="block text-sm font-medium text-gray-700 mb-2">
                        Descripción
                    </label>
                    <textarea name="descripcion"
                              id="descripcion"
                              rows="3"
                              class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('descripcion') border-red-500 @enderror">{{ old('descripcion', $materia->descripcion) }}</textarea>
                    @error('descripcion')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Tiene Auxiliar -->
                <div class="mb-6">
                    <label class="flex items-center">
                        <input type="checkbox"
                               name="tiene_auxiliar"
                               value="1"
                               {{ old('tiene_auxiliar', $materia->tiene_auxiliar) ? 'checked' : '' }}
                               class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <span class="ml-2 text-sm text-gray-600">Esta materia tiene auxiliar</span>
                    </label>
                </div>

                <!-- Botones -->
                <div class="flex items-center justify-end space-x-3">
                    <a href="{{ route('admin.materias.index') }}"
                       class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        Cancelar
                    </a>
                    <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        Actualizar Materia
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
