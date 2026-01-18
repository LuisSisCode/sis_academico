{{-- resources/views/admin/grupos-whatsapp/create.blade.php --}}
<x-admin-layout>
    <x-slot name="header">Crear Nuevo Grupo WhatsApp</x-slot>

    <div class="max-w-2xl">
        <div class="bg-white shadow-sm rounded-lg p-6">
            <form action="{{ route('admin.grupos-whatsapp.store') }}" method="POST">
                @csrf

                <!-- Información -->
                <div class="mb-4 bg-blue-50 border-l-4 border-blue-400 p-4 rounded">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-blue-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-blue-700">
                                Asegúrate de usar un link válido de WhatsApp (chat.whatsapp.com o wa.me)
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
                            <option value="{{ $gestion->ID_gestion }}" {{ old('ID_gestion') == $gestion->ID_gestion ? 'selected' : '' }}>
                                {{ $gestion->nombre }} ({{ $gestion->anio }})
                            </option>
                        @endforeach
                    </select>
                    @error('ID_gestion')
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
                                {{ $materia->nombre }} - {{ $materia->semestre->carrera->codigo_carrera }} ({{ $materia->semestre->numero_semestre }}° Sem)
                            </option>
                        @endforeach
                    </select>
                    @error('ID_materia')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Link WhatsApp -->
                <div class="mb-6">
                    <label for="link" class="block text-sm font-medium text-gray-700 mb-2">
                        Link de WhatsApp *
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-green-500" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                            </svg>
                        </div>
                        <input type="url"
                               name="link"
                               id="link"
                               value="{{ old('link') }}"
                               placeholder="https://chat.whatsapp.com/xxxxx o https://wa.me/xxxxx"
                               class="block w-full pl-10 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('link') border-red-500 @enderror"
                               required>
                    </div>
                    @error('link')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <p class="mt-1 text-xs text-gray-500">
                        Ejemplos: https://chat.whatsapp.com/ABC123 o https://wa.me/59112345678
                    </p>
                </div>

                <!-- Botones -->
                <div class="flex items-center justify-end space-x-3">
                    <a href="{{ route('admin.grupos-whatsapp.index') }}"
                       class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        Cancelar
                    </a>
                    <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        Guardar Grupo
                    </button>
                </div>
            </form>
        </div>

        <!-- Ayuda -->
        <div class="mt-6 bg-white shadow-sm rounded-lg p-6">
            <h3 class="text-lg font-medium text-gray-900 mb-4">¿Cómo obtener el link del grupo?</h3>
            <ol class="list-decimal list-inside space-y-2 text-sm text-gray-600">
                <li>Abre el grupo de WhatsApp desde tu celular</li>
                <li>Toca en el nombre del grupo en la parte superior</li>
                <li>Desplázate hacia abajo y selecciona "Invitar a través de enlace"</li>
                <li>Toca en "Copiar enlace"</li>
                <li>Pega el enlace en el campo de arriba</li>
            </ol>
        </div>
    </div>

    @push('scripts')
    <script>
    // Validar formato de link de WhatsApp
    document.getElementById('link')?.addEventListener('blur', function() {
        const link = this.value.trim();
        const patronesValidos = [
            'chat.whatsapp.com',
            'wa.me',
            'api.whatsapp.com'
        ];

        if (link && !patronesValidos.some(patron => link.includes(patron))) {
            alert('El link debe ser de WhatsApp (chat.whatsapp.com o wa.me)');
            this.focus();
        }
    });
    </script>
    @endpush
</x-admin-layout>
