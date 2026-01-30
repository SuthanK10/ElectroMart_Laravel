<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{ darkMode: localStorage.getItem('dark') === 'true' }" :class="{ 'dark': darkMode }">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'ElectroMart') }}</title>

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
        </style>
    </head>
    <body class="bg-slate-50 dark:bg-slate-950 antialiased selection:bg-blue-600 selection:text-white transition-colors duration-500 font-['Plus_Jakarta_Sans']">
        <div class="text-slate-900 dark:text-white min-h-screen">
            {{ $slot }}
        </div>

        @livewireScripts
        <script src="https://unpkg.com/lucide@latest"></script>
        <script>
            lucide.createIcons();
            
            // Intersection Observer for Reveal Animations
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('active');
                    }
                });
            }, observerOptions);

            const initReveals = () => {
                document.querySelectorAll('.reveal, .reveal-left, .reveal-right').forEach(el => observer.observe(el));
            };

            initReveals();
            document.addEventListener('livewire:navigated', () => {
                lucide.createIcons();
                initReveals();
            });
        </script>
    </body>
</html>
