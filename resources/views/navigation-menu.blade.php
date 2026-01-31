<nav x-data="{ open: false, scrolled: false }" 
     @scroll.window="scrolled = (window.pageYOffset > 10)"
     class="fixed top-0 inset-x-0 z-[100] transition-all duration-300">
    <div :class="scrolled ? 'bg-white/95 dark:bg-slate-900/95 shadow-lg backdrop-blur-md py-3' : 'bg-white/80 dark:bg-slate-950/80 backdrop-blur-sm shadow-sm py-5'"
         class="w-full border-b border-slate-100 dark:border-white/5 transition-all">
        <div class="max-w-[1500px] mx-auto w-full px-6 lg:px-12 flex justify-between items-center bg-transparent">
            <!-- Left Side: Logo & Primary Links -->
            <div class="flex items-center gap-12">
                <a href="/" class="flex items-center gap-3 group shrink-0">
                    <div class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center shadow-lg shadow-blue-500/30 transition-transform group-hover:rotate-6">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <span class="text-xl font-extrabold tracking-tight text-slate-900 dark:text-white uppercase transition-colors">Electro<span class="text-blue-600">Mart</span></span>
                </a>

                <!-- Desktop Navigation - Home, Products, About Only -->
                <div class="hidden xl:flex items-center space-x-10 text-[11px] font-black uppercase tracking-[0.2em] text-slate-500 dark:text-slate-400">
                    <a href="/" class="{{ request()->is('/') ? 'text-blue-600' : 'hover:text-blue-600' }} transition-colors">Home</a>
                    <a href="/shop" class="{{ request()->is('shop*') ? 'text-blue-600' : 'hover:text-blue-600' }} transition-colors">Products</a>
                    <a href="/about" class="{{ request()->is('about*') ? 'text-blue-600' : 'hover:text-blue-600' }} transition-colors">About</a>
                </div>
            </div>

            <!-- Middle: Search Bar -->
            <div class="hidden md:flex flex-1 max-w-md mx-12">
                <div class="relative w-full group">
                    <input type="text" placeholder="Search for premium tech..." class="w-full bg-slate-100/50 dark:bg-slate-900/50 border-none focus:ring-2 focus:ring-blue-500/20 rounded-xl py-2.5 px-5 text-xs font-bold transition-all group-hover:bg-slate-100 dark:group-hover:bg-slate-800">
                    <div class="absolute inset-y-0 right-0 flex items-center pr-4 text-slate-400 pointer-events-none">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </div>
                </div>
            </div>

            <!-- Right Side: Interaction Suite -->
            <div class="flex items-center space-x-2 sm:space-x-6">
                <!-- Wishlist -->
                <!-- Wishlist -->
                <a href="{{ route('wishlist') }}" class="p-2.5 text-slate-400 hover:text-rose-500 transition-colors rounded-xl hover:bg-slate-100 dark:hover:bg-slate-800" title="My Wishlist">
                    <svg class="w-5 h-5 {{ request()->routeIs('wishlist') ? 'fill-rose-500 text-rose-500' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                    </svg>
                </a>

                <!-- Theme Toggle -->
                <button @click="darkMode = !darkMode; localStorage.setItem('dark', darkMode)" class="p-2.5 text-slate-400 hover:text-blue-600 transition-colors rounded-xl hover:bg-slate-100 dark:hover:bg-slate-800">
                    <svg x-show="!darkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/></svg>
                    <svg x-show="darkMode" x-cloak class="w-5 h-5 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h1M4 12H3m15.364 6.364l.707.707M6.343 6.343l.707.707m12.728 0l.707.707M6.343 17.657l.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                </button>

                <div class="flex items-center gap-1 sm:gap-4">
                    
                    <a href="/cart" class="group relative p-2.5 text-slate-400 hover:text-blue-600 transition-colors rounded-xl hover:bg-slate-100 dark:hover:bg-slate-800">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                        @if(session()->has('cart') && count(session('cart')) > 0)
                            <span class="absolute -top-1 -right-1 bg-blue-600 text-white text-[8px] font-black w-4 h-4 rounded-full flex items-center justify-center ring-2 ring-white dark:ring-slate-900 group-hover:scale-110 transition-transform">
                                {{ count(session('cart')) }}
                            </span>
                        @endif
                    </a>

                    @auth
                        <div class="relative" x-data="{ userOpen: false }">
                            <button @click="userOpen = !userOpen" class="flex items-center focus:outline-none ring-2 ring-transparent hover:ring-blue-500 rounded-full transition-all">
                                <img class="h-9 w-9 rounded-full object-cover shadow-sm" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                            </button>
                            <div x-show="userOpen" @click.away="userOpen = false" x-transition class="absolute right-0 mt-3 w-56 bg-white dark:bg-slate-900 rounded-2xl shadow-2xl border border-slate-100 dark:border-white/5 py-3 z-50">
                                <div class="px-5 py-2 mb-2 border-b border-slate-50 dark:border-slate-800">
                                    <p class="text-[10px] font-black uppercase text-slate-400">Account</p>
                                    <p class="text-sm font-bold truncate dark:text-white">{{ Auth::user()->name }}</p>
                                </div>
                                <a href="{{ route('profile.show') }}" class="block px-5 py-2.5 text-xs font-bold text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800">Profile Settings</a>
                                <a href="{{ route('dashboard') }}" class="block px-5 py-2.5 text-xs font-bold text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800">Dashboard</a>
                                @if(!Auth::user()->isAdmin())
                                    <a href="{{ route('orders.history') }}" class="block px-5 py-2.5 text-xs font-bold text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800">Order History</a>
                                @endif
                                
                                @if(Auth::user()->isAdmin())
                                    <div class="h-px bg-slate-50 dark:bg-slate-800 my-2"></div>
                                    <p class="px-5 py-1 text-[8px] font-black text-blue-600 uppercase tracking-widest">Admin Control</p>
                                    <a href="{{ route('admin.dashboard') }}" class="block px-5 py-2.5 text-xs font-bold text-blue-600 hover:bg-blue-50 dark:hover:bg-blue-900/10 uppercase tracking-widest">Admin Dashboard</a>
                                    <a href="{{ route('admin.products') }}" class="block px-5 py-2.5 text-xs font-bold text-blue-600 hover:bg-blue-50 dark:hover:bg-blue-900/10 uppercase tracking-widest">Manage Products</a>
                                    <a href="{{ route('admin.coupons') }}" class="block px-5 py-2.5 text-xs font-bold text-blue-600 hover:bg-blue-50 dark:hover:bg-blue-900/10 uppercase tracking-widest">Manage Coupons</a>
                                @endif

                                <div class="h-px bg-slate-50 dark:bg-slate-800 my-2"></div>
                                <form method="POST" action="{{ route('logout') }}">@csrf<button type="submit" class="w-full text-left px-5 py-2.5 text-xs font-black text-rose-500 hover:bg-rose-50 dark:hover:bg-rose-900/10 uppercase tracking-widest">Logout</button></form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="p-2.5 text-slate-400 hover:text-blue-600 transition-colors rounded-xl hover:bg-slate-100 dark:hover:bg-slate-800">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        </a>
                    @endauth

                    <!-- Mobile Menu Button -->
                    <button @click="open = !open" class="xl:hidden p-2.5 text-slate-500 hover:text-blue-600 transition-colors rounded-xl hover:bg-slate-100 dark:hover:bg-slate-800">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16M4 18h16" /></svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile Slide Over - More Professional -->
    <div x-show="open" 
         @click.away="open = false"
         x-cloak
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-4"
         x-transition:enter-end="opacity-100 translate-y-0"
         class="xl:hidden fixed inset-x-0 top-[73px] bg-white/95 dark:bg-slate-950/95 backdrop-blur-lg border-b border-slate-100 dark:border-white/5 p-8 shadow-3xl space-y-6 z-[99]">
        <div class="flex flex-col space-y-4 text-center font-black uppercase tracking-widest text-slate-600 dark:text-slate-400">
            <a href="/" class="p-4 bg-slate-50 dark:bg-slate-900 rounded-2xl hover:text-blue-600 transition-colors">Home</a>
            <a href="/shop" class="p-4 bg-slate-50 dark:bg-slate-900 rounded-2xl hover:text-blue-600 transition-colors">Products</a>
            <a href="/about" class="p-4 bg-slate-50 dark:bg-slate-900 rounded-2xl hover:text-blue-600 transition-colors">About</a>
        </div>
    </div>
</nav>
