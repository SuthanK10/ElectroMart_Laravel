<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{ darkMode: localStorage.getItem('dark') === 'true' }" :class="{ 'dark': darkMode }">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'ElectroMart') }} | Premium Store</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@200..800&family=Outfit:wght@100..900&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
        <style>
            [x-cloak] { display: none !important; }
            html { scroll-behavior: smooth; }
            #nprogress .bar { display: none !important; } /* Hide Livewire loading bar */
            
            /* Scroll Reveal Core Styles */
            .reveal {
                opacity: 0;
                transform: translateY(60px);
                transition: all 1.2s cubic-bezier(0.16, 1, 0.3, 1);
                filter: blur(8px);
                will-change: transform, opacity;
            }

            .reveal-left {
                opacity: 0;
                transform: translateX(-50px);
                transition: all 1.2s cubic-bezier(0.16, 1, 0.3, 1);
                filter: blur(10px);
                will-change: transform, opacity;
            }

            .reveal-right {
                opacity: 0;
                transform: translateX(50px);
                transition: all 1.2s cubic-bezier(0.16, 1, 0.3, 1);
                filter: blur(10px);
                will-change: transform, opacity;
            }

            .reveal.active, .reveal-left.active, .reveal-right.active {
                opacity: 1;
                transform: translate(0, 0);
                filter: blur(0);
            }

            .stagger-1 { transition-delay: 0.1s; }
            .stagger-2 { transition-delay: 0.2s; }
            .stagger-3 { transition-delay: 0.3s; }
            .stagger-4 { transition-delay: 0.4s; }
            .stagger-5 { transition-delay: 0.5s; }
        </style>
    </head>
    <body class="bg-white dark:bg-slate-950 text-slate-900 dark:text-white transition-colors duration-500 font-['Plus_Jakarta_Sans'] antialiased overflow-x-hidden selection:bg-blue-600 selection:text-white">




        <div class="min-h-screen">
            @include('navigation-menu')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="pt-52 pb-8 bg-white dark:bg-slate-950 border-b border-slate-100 dark:border-white/5 transition-colors duration-500">
                    <div class="max-w-7xl mx-auto px-6 lg:px-8">
                         <div class="flex items-center gap-4">
                             <div class="w-1.5 h-6 bg-blue-600 rounded-full"></div>
                             <div class="text-3xl font-black text-slate-900 dark:text-white tracking-tighter uppercase italic">{{ $header }}</div>
                         </div>
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        @stack('modals')

        @livewireScripts
        <script src="https://unpkg.com/lucide@latest"></script>
        <script>
            lucide.createIcons();
            
            // Re-initialize icons after Livewire updates
            document.addEventListener('livewire:navigated', () => {
                lucide.createIcons();
            });
            
            // For older Livewire versions or manual updates
            document.addEventListener('livewire:load', () => {
                lucide.createIcons();
            });
        </script>
    </body>
</html>
