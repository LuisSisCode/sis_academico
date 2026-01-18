<x-admin-layout>
    <x-slot name="header">Crear Nuevo Auxiliar</x-slot>

    <div class="max-w-3xl">
        <div class="bg-white shadow-sm rounded-lg p-6">
            <form action="{{ route('admin.auxiliares.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-6 bg-blue-50 border border-blue-200 rounded-md p-4">
                    <p class="text-sm text-blue-800">
                        <strong>Nota:</strong> Al crear un auxiliar, se creará automáticamente un usuario con acceso al sistema.
                    </p>
                </div>

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
                                <option value="{{ $carrera->ID_carrera }}" {{ old('ID_carrera') == $carrera->ID_carrera ? 'selected' : '' }}>
                                    {{ $carrera->nombre }}
                                </option>
                            @endforeach
                        </select>
                        @error('ID_carrera')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Materia -->
                    <div class="mb-4">
                        <label for="ID_materia" class="block text-sm font-medium text-gray-700 mb-2">
                            Materia *
                        </label>
                        <select name="ID_materia"
                                id="ID_materia"
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('ID_materia') border-red-500 @enderror"
                                required>
                            <option value="">Seleccione una materia</option>
                            @foreach($materias as $materia)
                                <option value="{{ $materia->ID_materia }}" {{ old('ID_materia') == $materia->ID_materia ? 'selected' : '' }}>
                                    {{ $materia->Nombre }} ({{ $materia->sigla }}) - {{ $materia->semestre->nombre }}
                                </option>
                            @endforeach
                        </select>
                        @error('ID_materia')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Nombre -->
                <div class="mb-4">
                    <label for="nombre" class="block text-sm font-medium text-gray-700 mb-2">
                        Nombre Completo *
                    </label>
                    <input type="text"
                           name="nombre"
                           id="nombre"
                           value="{{ old('nombre') }}"
                           placeholder="Ej: Juan Pérez García"
                           class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('nombre') border-red-500 @enderror"
                           required>
                    @error('nombre')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Email -->
                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                            Email *
                        </label>
                        <input type="email"
                               name="email"
                               id="email"
                               value="{{ old('email') }}"
                               placeholder="auxiliar@ejemplo.com"
                               class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('email') border-red-500 @enderror"
                               required>
                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Celular -->
                    <div class="mb-4">
                        <label for="celular" class="block text-sm font-medium text-gray-700 mb-2">
                            Celular
                        </label>
                        <input type="text"
                               name="celular"
                               id="celular"
                               value="{{ old('celular') }}"
                               placeholder="+591 12345678"
                               class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('celular') border-red-500 @enderror">
                        @error('celular')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Contraseña -->
                    <div class="mb-4">
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                            Contraseña *
                        </label>
                        <input type="password"
                               name="password"
                               id="password"
                               class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('password') border-red-500 @enderror"
                               required>
                        @error('password')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Confirmar Contraseña -->
                    <div class="mb-4">
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                            Confirmar Contraseña *
                        </label>
                        <input type="password"
                               name="password_confirmation"
                               id="password_confirmation"
                               class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                               required>
                    </div>
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
                        <span class="ml-2 text-sm text-gray-600">Auxiliar Activo</span>
                    </label>
                </div>

                <!-- Botones -->
                <div class="flex items-center justify-end space-x-3">
                    <a href="{{ route('admin.auxiliares.index') }}"
                       class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        Cancelar
                    </a>
                    <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        Guardar Auxiliar
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
