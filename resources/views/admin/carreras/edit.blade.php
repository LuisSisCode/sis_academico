<x-admin-layout>
    <x-slot name="header">Editar Carrera</x-slot>

    <div class="max-w-2xl">
        <div class="bg-white shadow-sm rounded-lg p-6">
            <form action="{{ route('admin.carreras.update', $carrera->ID_carrera) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Nombre -->
                <div class="mb-4">
                    <label for="nombre" class="block text-sm font-medium text-gray-700 mb-2">
                        Nombre de la Carrera *
                    </label>
                    <input type="text"
                           name="nombre"
                           id="nombre"
                           value="{{ old('nombre', $carrera->nombre) }}"
                           class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('nombre') border-red-500 @enderror"
                           required>
                    @error('nombre')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Código -->
                <div class="mb-4">
                    <label for="codigo_carrera" class="block text-sm font-medium text-gray-700 mb-2">
                        Código de Carrera *
                    </label>
                    <input type="text"
                           name="codigo_carrera"
                           id="codigo_carrera"
                           value="{{ old('codigo_carrera', $carrera->codigo_carrera) }}"
                           class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('codigo_carrera') border-red-500 @enderror"
                           required>
                    @error('codigo_carrera')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Estado -->
                <div class="mb-6">
                    <label class="flex items-center">
                        <input type="checkbox"
                               name="activo"
                               value="1"
                               {{ old('activo', $carrera->activo) ? 'checked' : '' }}
                               class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <span class="ml-2 text-sm text-gray-600">Carrera Activa</span>
                    </label>
                </div>

                <!-- Botones -->
                <div class="flex items-center justify-end space-x-3">
                    <a href="{{ route('admin.carreras.index') }}"
                       class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        Cancelar
                    </a>
                    <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        Actualizar Carrera
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
