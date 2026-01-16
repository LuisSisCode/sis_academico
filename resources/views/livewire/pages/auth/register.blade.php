<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered($user = User::create($validated)));

        Auth::login($user);

        $this->redirect(route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div class="fixed inset-0 bg-gradient-to-br from-blue-600 via-blue-700 to-blue-800 flex items-center justify-center p-6 overflow-y-auto">
    <div class="w-full max-w-md py-8">
        <div class="text-center text-white">

            <!-- Logo -->
            <div class="flex justify-center mb-6">
                <div class="bg-white rounded-full p-4 shadow-2xl">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-28 h-28 object-contain">
                </div>
            </div>

            <!-- Título -->
            <div class="mb-8">
                <h2 class="text-3xl font-bold">Registrarte</h2>
                <p class="text-blue-100 text-sm mt-2">Accede a tu contenido académico</p>
            </div>

            <!-- Formulario -->
            <form wire:submit="register" class="space-y-4">
                <!-- Nombre Completo -->
                <div class="text-left">
                    <label for="name" class="block text-sm font-medium mb-2">Nombre Completo</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4">
                            <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                            </svg>
                        </span>
                        <input wire:model="name" id="name" type="text" name="name" required autofocus
                            class="w-full pl-12 pr-4 py-3.5 bg-white text-gray-800 rounded-2xl border-0 focus:ring-2 focus:ring-white focus:outline-none transition placeholder-gray-400"
                            placeholder="ej: Juan Pérez">
                    </div>
                    <x-input-error :messages="$errors->get('name')" class="mt-1.5 text-xs text-red-200" />
                </div>

                <!-- Registro Universitario -->
                <div class="text-left">
                    <label for="email" class="block text-sm font-medium mb-2">Registro Universitario</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4">
                            <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                            </svg>
                        </span>
                        <input wire:model="email" id="email" type="email" name="email" required
                            class="w-full pl-12 pr-4 py-3.5 bg-white text-gray-800 rounded-2xl border-0 focus:ring-2 focus:ring-white focus:outline-none transition placeholder-gray-400"
                            placeholder="ej: 223110183">
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-1.5 text-xs text-red-200" />
                </div>

                <!-- Contraseña -->
                <div class="text-left">
                    <label for="password" class="block text-sm font-medium mb-2">Contraseña</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4">
                            <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"/>
                            </svg>
                        </span>
                        <input wire:model="password" id="password" type="password" name="password" required
                            class="w-full pl-12 pr-4 py-3.5 bg-white text-gray-800 rounded-2xl border-0 focus:ring-2 focus:ring-white focus:outline-none transition placeholder-gray-400"
                            placeholder="•••••••">
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-1.5 text-xs text-red-200" />
                </div>

                <!-- Confirmar Contraseña -->
                <div class="text-left">
                    <label for="password_confirmation" class="block text-sm font-medium mb-2">Confirmar Contraseña</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4">
                            <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"/>
                            </svg>
                        </span>
                        <input wire:model="password_confirmation" id="password_confirmation" type="password" name="password_confirmation" required
                            class="w-full pl-12 pr-4 py-3.5 bg-white text-gray-800 rounded-2xl border-0 focus:ring-2 focus:ring-white focus:outline-none transition placeholder-gray-400"
                            placeholder="•••••••">
                    </div>
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1.5 text-xs text-red-200" />
                </div>

                <!-- Teléfono -->
                <div class="text-left">
                    <label for="telefono" class="block text-sm font-medium mb-2">Teléfono</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4">
                            <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/>
                            </svg>
                        </span>
                        <input id="telefono" type="tel"
                            class="w-full pl-12 pr-4 py-3.5 bg-white text-gray-800 rounded-2xl border-0 focus:ring-2 focus:ring-white focus:outline-none transition placeholder-gray-400"
                            placeholder="ej: 77123456">
                    </div>
                </div>

                <!-- Dirección -->
                <div class="text-left">
                    <label for="direccion" class="block text-sm font-medium mb-2">Dirección</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4">
                            <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                            </svg>
                        </span>
                        <input id="direccion" type="text"
                            class="w-full pl-12 pr-4 py-3.5 bg-white text-gray-800 rounded-2xl border-0 focus:ring-2 focus:ring-white focus:outline-none transition placeholder-gray-400"
                            placeholder="ej: Calle Principal #123">
                    </div>
                </div>

                <!-- Botón -->
                <button type="submit"
                    class="w-full bg-blue-800 hover:bg-blue-900 text-white font-semibold py-4 rounded-2xl transition duration-300 shadow-xl hover:shadow-2xl transform hover:-translate-y-0.5 mt-8">
                    Registrarse
                </button>

                <!-- Ya tienes cuenta -->
                <div class="text-center text-sm pt-4">
                    <span class="text-blue-100">¿Ya tienes cuenta?</span>
                    <a href="{{ route('login') }}" wire:navigate class="text-white hover:text-blue-100 font-semibold ml-1 underline">
                        Inicia sesión aquí
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
