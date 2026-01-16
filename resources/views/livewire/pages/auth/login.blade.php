<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public LoginForm $form;

    public function login(): void
    {
        $this->validate();
        $this->form->authenticate();
        Session::regenerate();
        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div class="fixed inset-0 bg-gradient-to-br from-blue-600 via-blue-700 to-blue-800 flex items-center justify-center p-6">
    <div class="w-full max-w-md">
        <div class="bg-white rounded-[2.5rem] overflow-hidden shadow-2xl">

            <!-- Ola superior -->
            <div class="relative h-40 bg-gradient-to-br from-blue-700 to-blue-900">
                <svg class="absolute bottom-0 w-full h-24" viewBox="0 0 1440 120" preserveAspectRatio="none">
                    <path d="M0,50 C300,90 600,70 900,50 C1200,30 1350,40 1440,50 L1440,120 L0,120 Z" fill="white"/>
                </svg>
            </div>

            <!-- Logo -->
            <div class="flex justify-center -mt-20 mb-6">
                <div class="bg-white rounded-full p-4 shadow-2xl">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-28 h-28 object-contain">
                </div>
            </div>

            <!-- Contenido -->
            <div class="px-10 pb-10">
                <!-- Título -->
                <div class="text-center mb-8">
                    <h2 class="text-2xl font-bold text-gray-800">Iniciar Sesión</h2>
                    <p class="text-sm text-gray-500 mt-1">Accede a tu contenido académico</p>
                </div>

                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form wire:submit="login" class="space-y-5">
                    <!-- Usuario -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Usuario</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-4">
                                <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                                </svg>
                            </span>
                            <input wire:model="form.email" id="email" type="email" name="email" required autofocus
                                class="w-full pl-12 pr-4 py-3.5 bg-gray-50 border border-gray-200 rounded-2xl focus:ring-2 focus:ring-blue-500 focus:border-transparent focus:bg-white transition text-gray-700"
                                placeholder="PlaceHolder">
                        </div>
                        <x-input-error :messages="$errors->get('form.email')" class="mt-1.5 text-xs" />
                    </div>

                    <!-- Registro -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Registro</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-4">
                                <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"/>
                                </svg>
                            </span>
                            <input wire:model="form.password" id="password" type="password" name="password" required
                                class="w-full pl-12 pr-4 py-3.5 bg-gray-50 border border-gray-200 rounded-2xl focus:ring-2 focus:ring-blue-500 focus:border-transparent focus:bg-white transition text-gray-700"
                                placeholder="••••••••••••••••">
                        </div>
                        <x-input-error :messages="$errors->get('form.password')" class="mt-1.5 text-xs" />
                    </div>

                    <!-- Recuérdame y Olvidaste -->
                    <div class="flex items-center justify-between text-sm pt-1">
                        <label for="remember" class="flex items-center cursor-pointer">
                            <input wire:model="form.remember" id="remember" type="checkbox"
                                class="w-4 h-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                            <span class="ml-2 text-gray-700">Recuérdame</span>
                        </label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" wire:navigate class="text-blue-600 hover:text-blue-700 font-medium">
                                ¿Olvidaste tu contraseña?
                            </a>
                        @endif
                    </div>

                    <!-- Botón -->
                    <button type="submit"
                        class="w-full bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-semibold py-4 rounded-2xl transition duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 mt-6">
                        Iniciar Sesión
                    </button>

                    <!-- Registrarse -->
                    <div class="text-center text-sm pt-3">
                        <span class="text-gray-600">¿No tienes cuenta?</span>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" wire:navigate class="text-blue-600 hover:text-blue-700 font-semibold ml-1">
                                Regístrate aquí
                            </a>
                        @endif
                    </div>

                    <!-- Facebook -->
                    <div class="flex justify-center pt-4">
                        <a href="#" class="text-blue-600 hover:text-blue-700 transition transform hover:scale-110">
                            <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                            </svg>
                        </a>
                    </div>
                </form>
            </div>

            <!-- Ola inferior -->
            <div class="relative h-24 bg-white">
                <svg class="absolute top-0 w-full h-20" viewBox="0 0 1440 80" preserveAspectRatio="none">
                    <path d="M0,30 C300,0 600,20 900,30 C1200,40 1350,35 1440,30 L1440,0 L0,0 Z" fill="#1e40af" opacity="0.95"/>
                </svg>
            </div>
        </div>
    </div>
</div>
