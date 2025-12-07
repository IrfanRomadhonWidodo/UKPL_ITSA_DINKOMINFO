<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{ darkMode: $persist(false) }">
    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        
        <!-- ICON -->
        <link rel="icon" href="{{ asset('image/LOGO_BARU.png') }}" type="image/png">
        <link rel="apple-touch-icon" href="{{ asset('logo_baru.png') }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <!-- Sweet Alert 2 CDN -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
        
    </head>
    <body class="bg-[#E0F7FE] ">
        <div class="min-h-screen">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
            <!-- Tombol WhatsApp dengan efek hover dan tooltip -->
            <div class="fixed bottom-8 right-8 z-50 group">
                <!-- Tooltip muncul saat hover -->
                <div class="absolute right-16 bottom-1/2 translate-y-1/2 bg-white text-gray-700 text-sm font-medium px-4 py-2 rounded-lg shadow-md opacity-0 group-hover:opacity-100 transition duration-300 whitespace-nowrap">
                    Chat Kami di WhatsApp
                </div>

                <!-- Tombol WA -->
                <a href="https://wa.me/6282225584976" target="_blank"
                    class="bg-green-500 text-white w-14 h-14 flex items-center justify-center rounded-full shadow-xl transform group-hover:scale-110 transition-all duration-300 ease-in-out"
                    aria-label="Chat via WhatsApp">
                    <i class="fab fa-whatsapp text-2xl"></i>
                </a>
            </div>

            <!-- Loading Screen -->
            <div id="loading-screen" class="fixed inset-0 bg-white z-[9999] flex items-center justify-center transition-opacity duration-700">
                <div class="relative w-32 h-32">
                    <!-- Logo -->
                    <img id="loading-logo" src="{{ asset('image/LOGO_WITH_OUTER.png') }}" alt="Logo"
                        class="w-20 h-20 absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 z-10">
                    
                    <!-- Circular Loading Animation -->
                    <div class="w-32 h-32 rounded-full border-4 border-t-[#06b6d4] border-r-transparent border-b-transparent border-l-transparent animate-spin"></div>
                </div>
            </div>

            <script>
                const loadingScreen = document.getElementById('loading-screen');
                const loadingLogo = document.getElementById('loading-logo');

                loadingLogo.onload = function () {
                    window.addEventListener('load', () => {
                        loadingScreen.classList.add('opacity-0');
                        setTimeout(() => {
                            loadingScreen.style.display = 'none';
                        }, 1600);
                    });
                };
            </script>





            @include('layouts.footer')
        </div>
        @stack('scripts')
        
    </body>
</html>