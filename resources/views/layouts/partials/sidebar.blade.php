<!-- Sidebar para móvil (oculto por defecto) -->
<div class="relative z-50 lg:hidden" role="dialog" aria-modal="true" x-data="{ open: false }" x-show="open" style="display: none;">
    <div class="fixed inset-0 bg-gray-900/80" x-show="open"
         x-transition:enter="transition-opacity ease-linear duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition-opacity ease-linear duration-300"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"></div>

    <div class="fixed inset-0 flex">
        <div class="relative mr-16 flex w-full max-w-xs flex-1" x-show="open"
             x-transition:enter="transition ease-in-out duration-300 transform"
             x-transition:enter-start="-translate-x-full"
             x-transition:enter-end="translate-x-0"
             x-transition:leave="transition ease-in-out duration-300 transform"
             x-transition:leave-start="translate-x-0"
             x-transition:leave-end="-translate-x-full">
            <div class="flex grow flex-col gap-y-5 overflow-y-auto bg-white px-6 pb-2">
                <div class="flex h-16 shrink-0 items-center">
                    <span class="text-xl font-bold text-indigo-600">SISTEMA</span>
                </div>
                <nav class="flex flex-1 flex-col">
                    @include('layouts.partials.menu-items')
                </nav>
            </div>
        </div>
    </div>
</div>

<!-- Sidebar estático para desktop -->
<div class="hidden lg:fixed lg:inset-y-0 lg:z-50 lg:flex lg:w-64 lg:flex-col">
    <div class="flex grow flex-col gap-y-5 overflow-y-auto border-r border-gray-200 bg-white px-6">
        <div class="flex h-16 shrink-0 items-center">
            <span class="text-xl font-bold text-indigo-600">SISTEMA ACADÉMICO</span>
        </div>
        <nav class="flex flex-1 flex-col">
            @include('layouts.partials.menu-items')
        </nav>
    </div>
</div>
