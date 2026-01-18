<x-admin-layout>
    <x-slot name="header">Crear Nuevo Docente</x-slot>

    <div class="max-w-2xl">
        <div class="bg-white shadow-sm rounded-lg p-6">
            <form action="{{ route('admin.docentes.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Nombre -->
                <div class="mb-4">
                    <label for="nombre" class="block text-sm font-medium text-gray-700 mb-2">
                        Nombre Completo *
                    </label>
                    <input type="text"
                           name="nombre"
                           id="nombre"
                           value="{{ old('nombre') }}"
                           placeholder="Ej: Dr. Juan Pérez García"
                           class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('nombre') border-red-500 @enderror"
                           required>
                    @error('nombre')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Especialidad -->
                <div class="mb-4">
                    <label for="especialidad" class="block text-sm font-medium text-gray-700 mb-2">
                        Especialidad
                    </label>
                    <input type="text"
                           name="especialidad"
                           id="especialidad"
                           value="{{ old('especialidad') }}"
                           placeholder="Ej: Matemáticas, Programación, Redes"
                           class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('especialidad') border-red-500 @enderror">
                    @error('especialidad')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Teléfono -->
                <div class="mb-4">
                    <label for="telefono" class="block text-sm font-medium text-gray-700 mb-2">
                        Teléfono
                    </label>
                    <input type="text"
                           name="telefono"
                           id="telefono"
                           value="{{ old('telefono') }}"
                           placeholder="Ej: +591 12345678"
                           class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('telefono') border-red-500 @enderror">
                    @error('telefono')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Foto -->
                <div class="mb-4">
                    <label for="foto" class="block text-sm font-medium text-gray-700 mb-2">
                        Foto
                    </label>
                    <input type="file"
                           name="foto"
                           id="foto"
                           accept="image/*"
                           class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 @error('foto') border-red-500 @enderror">
                    <p class="mt-1 text-xs text-gray-500">JPG, PNG, GIF hasta 2MB</p>
                    @error('foto')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Estado -->
                <div class="mb-6">
                    <label class="flex items-center">
                        <input type="checkbox"
                               name="activo"
                               value="1"
                               {{ old('activo', true) ? 'checked' : '' }}
                               class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <span class="ml-2 text-sm text-gray-600">Docente Activo</span>
                    </label>
                </div>

                <!-- Botones -->
                <div class="flex items-center justify-end space-x-3">
                    <a href="{{ route('admin.docentes.index') }}"
                       class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        Cancelar
                    </a>
                    <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        Guardar Docente
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
