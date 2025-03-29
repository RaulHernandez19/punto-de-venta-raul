<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Marketplace</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-gray-900 min-h-screen">
        <div class="min-h-screen">
            <div class="relative min-h-screen flex flex-col">
                <!-- Header -->
                <header class="bg-gray-800 border-b border-gray-700">
                    <div class="max-w-7xl mx-auto px-4 py-4 sm:px-6 lg:px-8">
                        <div class="flex justify-between items-center">
                            <div class="flex items-center">
                                <svg class="h-8 w-auto text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                                <span class="ml-2 text-xl font-bold text-white">Marketplace</span>
                            </div>

                            @if (Route::has('login'))
                                <livewire:welcome.navigation />
                            @endif
                        </div>
                    </div>
                </header>

                <!-- Hero Section -->
                <div class="bg-indigo-900">
                    <div class="max-w-7xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:px-8">
                        <div class="text-center">
                            <h1 class="text-4xl font-extrabold text-white sm:text-5xl md:text-6xl">
                                Bienvenido a nuestro Marketplace
                            </h1>
                            <p class="mt-3 max-w-md mx-auto text-base text-indigo-200 sm:text-lg md:mt-5 md:text-xl md:max-w-3xl">
                                Descubre productos únicos y servicios excepcionales de nuestra comunidad.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Footer -->
                <footer class="mt-auto bg-gray-800 border-t border-gray-700">
                    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
                        <p class="text-center text-base text-gray-400">
                            &copy; 2025 Marketplace. Todos los derechos reservados.
                        </p>
                    </div>
                </footer>
            </div>
        </div>
    </body>
</html>
