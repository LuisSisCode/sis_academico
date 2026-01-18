<x-admin-layout>
    <x-slot name="header">Editar Semestre</x-slot>

    <div class="max-w-2xl">
        <div class="bg-white shadow-sm rounded-lg p-6">
            <form action="{{ route('admin.semestres.update', $semestre->ID_semestre) }}" method="POST">
                @csrf
                @method('PUT')

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
                            <option value="{{ $carrera->ID_carrera }}" {{ old('ID_carrera', $semestre->ID_carrera) == $carrera->ID_carrera ? 'selected' : '' }}>
                                {{ $carrera->nombre }} ({{ $carrera->codigo_carrera }})
                            </option>
                        @endforeach
                    </select>
                    @error('ID_carrera')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Nombre -->
                <div class="mb-4">
                    <label for="nombre" class="block text-sm font-medium text-gray-700 mb-2">
                        Nombre del Semestre *
                    </label>
                    <input type="text"
                           name="nombre"
                           id="nombre"
                           value="{{ old('nombre', $semestre->nombre) }}"
                           class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('nombre') border-red-500 @enderror"
                           required>
                    @error('nombre')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Número de Semestre -->
                <div class="mb-4">
                    <label for="numero_semestre" class="block text-sm font-medium text-gray-700 mb-2">
                        Número de Semestre *
                    </label>
                    <input type="number"
                           name="numero_semestre"
                           id="numero_semestre"
                           value="{{ old('numero_semestre', $semestre->numero_semestre) }}"
                           min="1"
                           max="15"
                           class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('numero_semestre') border-red-500 @enderror"
                           required>
                    @error('numero_semestre')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Tipo -->
                <div class="mb-6">
                    <label for="tipo" class="block text-sm font-medium text-gray-700 mb-2">
                        Tipo de Semestre *
                    </label>
                    <select name="tipo"
                            id="tipo"
                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('tipo') border-red-500 @enderror"
                            required>
                        <option value="Regular" {{ old('tipo', $semestre->tipo) == 'Regular' ? 'selected' : '' }}>Regular</option>
                        <option value="Verano" {{ old('tipo', $semestre->tipo) == 'Verano' ? 'selected' : '' }}>Verano</option>
                    </select>
                    @error('tipo')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Botones -->
                <div class="flex items-center justify-end space-x-3">
                    <a href="{{ route('admin.semestres.index') }}"
                       class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        Cancelar
                    </a>
                    <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        Actualizar Semestre
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
