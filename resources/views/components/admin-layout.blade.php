@props(['header' => null, 'headerAction' => null, 'breadcrumbs' => null])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-gray-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Panel Admin</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="h-full" x-data="{ open: false }">
    <div class="min-h-full">
        <!-- Sidebar -->
        @include('layouts.partials.sidebar')

        <!-- Main Content -->
        <div class="lg:pl-64">
            <!-- Top Navigation -->
            @include('layouts.partials.navbar')

            <!-- Page Content -->
            <main class="py-6">
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <!-- Breadcrumbs -->
                    @if($breadcrumbs)
                        <nav class="mb-4" aria-label="Breadcrumb">
                            <ol class="flex items-center space-x-2 text-sm text-gray-500">
                                @foreach($breadcrumbs as $breadcrumb)
                                    @if($loop->last)
                                        <li class="font-medium text-gray-700">{{ $breadcrumb['name'] }}</li>
                                    @else
                                        <li>
                                            <a href="{{ $breadcrumb['url'] }}" class="hover:text-gray-700">
                                                {{ $breadcrumb['name'] }}
                                            </a>
                                            <span class="mx-2">/</span>
                                        </li>
                                    @endif
                                @endforeach
                            </ol>
                        </nav>
                    @endif

                    <!-- Flash Messages -->
                    @if(session('success'))
                        <div class="mb-4 rounded-lg bg-green-50 p-4 text-sm text-green-800" role="alert">
                            <span class="font-medium">¡Éxito!</span> {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="mb-4 rounded-lg bg-red-50 p-4 text-sm text-red-800" role="alert">
                            <span class="font-medium">¡Error!</span> {{ session('error') }}
                        </div>
                    @endif

                    <!-- Page Heading -->
                    @if($header)
                        <header class="mb-6">
                            <div class="flex items-center justify-between">
                                <h1 class="text-2xl font-bold text-gray-900">{{ $header }}</h1>
                                @if($headerAction)
                                    <div>{{ $headerAction }}</div>
                                @endif
                            </div>
                        </header>
                    @endif

                    <!-- Page Content -->
                    {{ $slot }}
                </div>
            </main>
        </div>
    </div>

    @livewireScripts

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>
</html>
