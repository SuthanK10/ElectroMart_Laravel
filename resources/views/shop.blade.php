<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{ darkMode: localStorage.getItem('dark') === 'true' }" :class="{ 'dark': darkMode }">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Shop Collection | ElectroMart</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@200..800&family=Outfit:wght@100..900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <script src="https://unpkg.com/lucide@latest"></script>
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
        .stagger-3 { transition-delay: 0.3s; }
        .stagger-4 { transition-delay: 0.4s; }
        .stagger-5 { transition-delay: 0.5s; }
    </style>
</head>
<body class="bg-slate-50 dark:bg-slate-950 text-slate-900 dark:text-white transition-colors duration-500 font-['Plus_Jakarta_Sans'] antialiased overflow-x-hidden selection:bg-blue-600 selection:text-white">
    @include('navigation-menu')

    <main class="pt-28 pb-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header Section -->
            @php
                $featuredCoupon = \App\Models\Coupon::where('is_active', true)
                    ->where('is_featured', true)
                    ->where(function($q){ $q->whereNull('expiry_date')->orWhere('expiry_date', '>', now()); })
                    ->latest()
                    ->first();
            @endphp
            
            @if($featuredCoupon)
                <div x-data="{ show: true }" x-show="show" 
                     style="background-color: #2563eb;"
                     class="mb-12 relative overflow-hidden bg-blue-600 rounded-[2rem] shadow-2xl p-8 lg:p-12 text-white reveal-left">
                     <!-- Abstract Background -->
                     <div class="absolute -top-24 -right-24 w-64 h-64 bg-white/20 rounded-full blur-[80px]"></div>
                     <div class="absolute bottom-0 left-0 w-full h-1/2 bg-gradient-to-t from-black/20 to-transparent"></div>
                     
                     <div class="relative z-10 flex flex-col md:flex-row items-center justify-between gap-8">
                         <div class="space-y-4 text-center md:text-left">
                             <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/20 backdrop-blur-md border border-white/20 text-[10px] font-black uppercase tracking-widest">
                                 <span class="w-1.5 h-1.5 bg-green-400 rounded-full animate-pulse"></span>
                                 Limited Time Offer
                             </div>
                             <h2 class="text-4xl md:text-5xl font-['Outfit'] font-black uppercase italic tracking-tighter text-white">
                                 Get <span class="text-yellow-300">{{ $featuredCoupon->type === 'fixed' ? '$' . number_format($featuredCoupon->value, 0) : number_format($featuredCoupon->value, 0) . '%' }} OFF</span>
                             </h2>
                             <p class="text-lg text-blue-100 font-medium italic">Your next premium upgrade awaits. Don't miss out.</p>
                         </div>
                         
                         <div class="flex flex-col items-center gap-3">
                             <button @click="navigator.clipboard.writeText('{{ $featuredCoupon->code }}'); $dispatch('notify', 'Code Copied: {{ $featuredCoupon->code }}')" 
                                     class="group relative px-10 py-5 bg-white text-blue-600 rounded-2xl font-black text-xl uppercase tracking-widest shadow-xl hover:shadow-2xl hover:scale-105 active:scale-95 transition-all">
                                 <span class="flex items-center gap-3">
                                     {{ $featuredCoupon->code }}
                                     <svg class="w-5 h-5 opacity-50 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                                 </span>
                                 <div class="absolute inset-x-0 bottom-0 h-1 bg-blue-100/50 scale-x-0 group-hover:scale-x-100 transition-transform p-3"></div>
                             </button>
                             <span class="text-[10px] uppercase tracking-widest opacity-60 font-bold">Tap to copy code</span>
                         </div>
                     </div>
                     
                     <button @click="show = false" class="absolute top-6 right-6 p-2 text-white/50 hover:text-white transition-colors bg-white/10 hover:bg-white/20 rounded-full">
                         <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                     </button>
                </div>
            @endif

            <div class="mb-12 space-y-8 reveal">
                <div class="flex items-center gap-4">
                    <div class="w-1.5 h-10 bg-blue-600 rounded-full"></div>
                    <span class="text-blue-600 font-black uppercase tracking-[0.4em] text-[10px] leading-none italic">Product Collection</span>
                </div>
                
                <h1 class="text-7xl md:text-8xl lg:text-9xl font-['Outfit'] font-black text-slate-950 dark:text-white tracking-tighter leading-none uppercase italic">
                    Our <span class="text-blue-600 not-italic">Shop.</span>
                </h1>
                
                <div class="max-w-3xl border-l-4 border-blue-600 pl-8 lg:pl-12 py-2">
                    <p class="text-xl lg:text-2xl text-slate-500 dark:text-slate-400 font-medium italic leading-relaxed">
                        Explore our curated collection of high-quality electronics and tech accessories.
                    </p>
                </div>
            </div>

            <!-- Product Listing -->
            <div class="space-y-16">
                @livewire('product-list')
            </div>
        </div>
    </main>

    @include('layouts.footer')

    @livewireScripts
    <script>
        document.addEventListener('livewire:init', () => {
            lucide.createIcons();

            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('active');
                        // Optional: Stop observing once revealed
                        // observer.unobserve(entry.target);
                    }
                });
            }, observerOptions);

            const initAnimations = () => {
                document.querySelectorAll('.reveal, .reveal-left, .reveal-right').forEach(el => {
                    // Only observe if not already active to avoid flickering
                    if (!el.classList.contains('active')) {
                        observer.observe(el);
                    }
                });
                lucide.createIcons();
            };

            // Initial load
            initAnimations();

            // Re-initialize on Livewire updates (e.g., category filter)
            Livewire.hook('morph.updated', ({ el, component }) => {
                initAnimations();
            });
        });
    </script>
</body>
</html>
