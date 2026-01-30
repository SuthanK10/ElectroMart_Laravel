<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{ darkMode: localStorage.getItem('dark') === 'true' }" :class="{ 'dark': darkMode }">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>About Us | ElectroMart</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@200..800&display=swap" rel="stylesheet">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
        <script src="https://unpkg.com/lucide@latest"></script>
        <style>
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
            .stagger-3 { transition-delay: 0.3s; }
            .stagger-4 { transition-delay: 0.4s; }
            .stagger-5 { transition-delay: 0.5s; }
        </style>
    </head>
    <body class="bg-white dark:bg-[#0a0a0b] text-slate-900 dark:text-white transition-colors duration-500 font-['Plus_Jakarta_Sans'] antialiased">
        @include('navigation-menu')

        <!-- About Hero -->
        <header class="pt-48 pb-24 px-6 relative overflow-hidden">
            <div class="max-w-7xl mx-auto text-center space-y-8 animate-blur-in">
                <span class="inline-block px-5 py-2 bg-indigo-50 dark:bg-indigo-500/10 text-indigo-600 rounded-full text-[10px] font-black uppercase tracking-[0.3em] border border-indigo-100 dark:border-indigo-500/20">Our Story</span>
                <h1 class="text-6xl md:text-8xl font-black tracking-tighter leading-none italic uppercase">
                    Defining the <br/> <span class="text-indigo-600">Future of Tech.</span>
                </h1>
                <p class="text-xl text-slate-500 dark:text-slate-400 max-w-2xl mx-auto leading-relaxed font-medium">
                    Since 2024, ElectroMart has been at the forefront of curating world-class electronics for the modern hardware enthusiast.
                </p>
            </div>
        </header>

        <!-- Story Section -->
        <section class="py-32 px-6">
            <div class="max-w-7xl mx-auto">
                <div class="grid lg:grid-cols-2 gap-20 items-center">
                    <div class="rounded-[3rem] overflow-hidden shadow-2xl">
                        <img src="https://images.unsplash.com/photo-1519389950473-47ba0277781c?auto=format&fit=crop&q=80&w=1200" alt="Our Team" class="w-full h-full object-cover">
                    </div>
                    <div class="space-y-10">
                        <div class="space-y-6">
                            <h2 class="text-5xl font-black tracking-tighter leading-tight italic uppercase">Precision in <br/>Every Decision.</h2>
                            <p class="text-lg text-slate-500 dark:text-slate-400 leading-relaxed font-medium">
                                We believe that technology should be an extension of your intent. That's why every product in our collection is hand-tested for performance, durability, and aesthetic perfection.
                            </p>
                        </div>
                        <div class="grid grid-cols-2 gap-8">
                             <div class="p-8 border border-slate-100 dark:border-white/5 rounded-[2.5rem] bg-slate-50 dark:bg-white/5">
                                 <h4 class="text-4xl font-black text-indigo-600 mb-1">15K+</h4>
                                 <p class="text-[10px] font-black uppercase tracking-widest text-slate-400">Products Shipped</p>
                             </div>
                             <div class="p-8 border border-slate-100 dark:border-white/5 rounded-[2.5rem] bg-slate-50 dark:bg-white/5">
                                 <h4 class="text-4xl font-black text-indigo-600 mb-1">2024</h4>
                                 <p class="text-[10px] font-black uppercase tracking-widest text-slate-400">Founded</p>
                             </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        @include('layouts.footer')

        @livewireScripts
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

            document.querySelectorAll('.reveal, .reveal-left, .reveal-right').forEach(el => observer.observe(el));
        </script>
    </body>
</html>
