<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{ darkMode: localStorage.getItem('dark') === 'true' }" :class="{ 'dark': darkMode }">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ElectroMart | Modern Tech Marketplace</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@200..800&family=Outfit:wght@100..900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        [x-cloak] { display: none !important; }
        html { scroll-behavior: smooth; }
        .bg-pattern { background-image: radial-gradient(circle at 1px 1px, rgba(37, 99, 235, 0.05) 1px, transparent 0); background-size: 40px 40px; }
        
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
    @include('navigation-menu')

    <main class="pt-32 pb-24 lg:pt-36">
        <!-- Hero Section -->
        <section class="max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-8 mb-24">
            <div class="relative bg-slate-900 rounded-[3rem] overflow-hidden min-h-[500px] lg:min-h-[650px] flex items-center shadow-3xl border border-white/5" style="background-color: #0f172a;">
                <div class="absolute inset-0 pointer-events-none">
                    <div class="absolute top-0 right-0 w-full h-full bg-gradient-to-l from-blue-600/10 to-transparent"></div>
                    <div class="absolute bottom-0 left-0 w-1/2 h-full bg-gradient-to-tr from-blue-900/20 to-transparent"></div>
                </div>
                
                <div class="relative z-10 w-full px-8 lg:px-20 py-20 grid lg:grid-cols-2 gap-16 items-center">
                    <div class="space-y-10 animate-blur-in">
                        <div class="space-y-6">
                            <span class="inline-block px-4 py-1.5 bg-blue-600/20 text-blue-400 rounded-full text-[10px] font-black uppercase tracking-[0.4em] animate-scale-in">New Generation</span>
                            <h1 class="text-5xl md:text-[5rem] lg:text-[6rem] font-['Outfit'] font-black text-white leading-[1.1] tracking-tight uppercase italic transition-all animate-blur-in">
                                Experience <br/> the Future. <br/>
                                <span class="text-blue-500 not-italic">Pro Latitude X.</span>
                            </h1>
                            <p class="text-xl text-slate-400 font-medium max-w-lg leading-relaxed italic animate-fade-up">High-performance specs in a sleek, lightweight magnesium design. Built for the modern creator.</p>
                        </div>

                        <div class="flex flex-wrap items-center gap-12 animate-fade-up" style="animation-delay: 0.2s">
                            <a href="/shop" class="px-12 py-6 bg-blue-600 hover:bg-blue-700 text-white rounded-2xl font-black text-xs uppercase tracking-widest flex items-center gap-3 transition-all transform hover:scale-105 active:scale-95 shadow-2xl shadow-blue-600/20">
                                Shop Now
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </a>
                            <div class="space-y-1 text-left">
                                <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest leading-none opacity-60">Price Starting At</p>
                                <p class="text-4xl font-['Outfit'] font-black text-white leading-none">$1,299.00</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="relative flex justify-center lg:justify-end animate-blur-in" style="animation-delay: 0.1s">
                        <img src="https://images.unsplash.com/photo-1541807084-5c52b6b3adef?auto=format&fit=crop&q=80&w=1200" 
                             alt="Luxury Tech" 
                             class="w-full max-w-[550px] object-contain drop-shadow-[0_30px_60px_rgba(37,99,235,0.4)] transform scale-110 lg:scale-[1.2] transition-transform duration-1000 animate-float animate-glow">
                    </div>
                </div>
            </div>
        </section>

        <!-- Category Grid - Light BG Section -->
        <section class="bg-slate-50 dark:bg-slate-900/30 py-32 bg-pattern transition-colors duration-500">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-end justify-between mb-16 px-2">
                    <div class="space-y-3 font-['Outfit'] reveal">
                        <h2 class="text-4xl font-black uppercase italic tracking-tighter text-slate-900 dark:text-white">Shop by Category</h2>
                        <div class="w-16 h-1.5 bg-blue-600"></div>
                    </div>
                    <a href="/shop" class="text-[10px] font-black uppercase tracking-[0.3em] text-blue-600 hover:text-blue-700 flex items-center gap-2 group">
                        Explore All
                        <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                    </a>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-8 lg:gap-12">
                    @foreach([
                        ['Laptops', 'laptop', '45+ Products'],
                        ['Headphones', 'headphones', '32+ Products'],
                        ['Smartphones', 'smartphone', '28+ Products'],
                        ['Cameras', 'camera', '15+ Products']
                    ] as $index => $category)
                        <div class="group bg-white dark:bg-slate-900 p-10 lg:p-12 rounded-[3.5rem] text-center border border-slate-100 dark:border-white/5 hover:shadow-3xl hover:-translate-y-3 transition-all duration-500 cursor-pointer shadow-sm reveal stagger-{{ $index + 1 }}">
                            <div class="mb-8 transform group-hover:scale-110 transition-transform duration-500">
                                <i data-lucide="{{ $category[1] }}" class="w-16 h-16 mx-auto text-blue-600"></i>
                            </div>
                            <h3 class="text-xl font-black mb-1 uppercase italic tracking-tight transition-colors group-hover:text-blue-600 dark:text-white">{{ $category[0] }}</h3>
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest leading-none">{{ $category[2] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- Arrivals - Dark Contrast Section -->
        <section id="featured" class="py-32 px-4 sm:px-6 lg:px-8 bg-white dark:bg-slate-950 transition-colors duration-500">
            <div class="max-w-7xl mx-auto">
                <div class="space-y-4 mb-20 text-center lg:text-left reveal">
                    <h2 class="text-5xl font-['Outfit'] font-black uppercase italic tracking-tighter text-slate-900 dark:text-white">New Arrivals</h2>
                    <div class="w-24 h-2 bg-blue-600 mx-auto lg:mx-0"></div>
                </div>

                @livewire('product-list', ['limit' => 4])
            </div>
        </section>

        <!-- Newsletter - High Contrast Section -->
        <section class="bg-blue-600 dark:bg-blue-700 py-32 transition-colors duration-500 reveal">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="relative bg-slate-950 rounded-[4rem] p-12 lg:p-24 shadow-3xl border border-white/5 overflow-hidden text-center reveal">
                    <!-- Decor -->
                    <div class="absolute top-0 right-0 w-64 h-64 bg-blue-600/10 rounded-full -mr-32 -mt-32 blur-3xl"></div>
                    <div class="absolute bottom-0 left-0 w-64 h-64 bg-blue-900/10 rounded-full -ml-32 -mb-32 blur-3xl"></div>
                    
                    <div class="relative z-10 space-y-12">
                        <div class="w-24 h-24 bg-blue-600/10 text-blue-500 rounded-[2.5rem] flex items-center justify-center mx-auto shadow-inner transform rotate-6 border border-blue-500/20">
                            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        </div>
                        
                        <div class="space-y-6 reveal-left stagger-1">
                            <h2 class="text-5xl md:text-6xl font-['Outfit'] font-black uppercase tracking-tighter italic text-white leading-none">Stay Updated.</h2>
                            <p class="text-xl text-slate-400 font-medium max-w-md mx-auto leading-relaxed italic">Subscribe to our newsletter for the latest tech updates and exclusive offers.</p>
                        </div>

                        <form class="max-w-lg mx-auto flex flex-col sm:flex-row items-center gap-4 reveal-right stagger-2">
                            <input type="email" placeholder="Enter your email address" class="w-full bg-slate-900 border-none rounded-2xl py-6 px-8 font-bold text-sm transition-all shadow-inner text-white focus:ring-2 focus:ring-blue-500/20">
                            <button class="w-full sm:w-auto px-12 py-6 bg-blue-600 hover:bg-blue-700 text-white rounded-2xl font-black text-[11px] uppercase tracking-widest shadow-2xl transition-all hover:scale-105 active:scale-95">Subscribe</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>

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
