<x-app-layout>
    <div class="pt-32 pb-16 bg-slate-50 dark:bg-slate-950 min-h-screen transition-colors duration-500">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="mb-16 space-y-4 animate-blur-in">
                <div class="text-indigo-600 dark:text-indigo-400 font-black uppercase tracking-[0.3em] text-xs italic">User Center</div>
                <h1 class="text-5xl font-black text-slate-900 dark:text-white tracking-tighter">Account Hub</h1>
                <p class="text-xl text-slate-500 dark:text-slate-400 font-medium italic border-l-4 border-indigo-600 pl-8">Welcome back, {{ Auth::user()->name }}. Your personalized cockpit is ready.</p>
            </div>

            <!-- Dashboard Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                <!-- Left Column -->
                <div class="lg:col-span-2 space-y-12">
                    <!-- Stats -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 animate-blur-in stagger-1">
                        <div class="glass-card !bg-white dark:!bg-slate-950/50 p-10 flex items-center justify-between group hover:shadow-2xl transition-all duration-500 border border-slate-100 dark:border-white/5">
                            <div class="space-y-1">
                                <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest leading-none">Total Acquisitions</span>
                                <div class="text-6xl font-black text-slate-900 dark:text-white leading-tight">{{ Auth::user()->orders()->count() }}</div>
                            </div>
                            <div class="w-20 h-20 bg-indigo-50 dark:bg-indigo-900/20 text-indigo-600 dark:text-indigo-400 rounded-3xl flex items-center justify-center group-hover:rotate-12 group-hover:scale-110 transition-all duration-500 shadow-lg shadow-indigo-100 dark:shadow-none">
                                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                </svg>
                            </div>
                        </div>
                        <div class="bg-slate-900 dark:bg-indigo-900 p-10 rounded-[2.5rem] shadow-2xl flex items-center justify-between text-white relative overflow-hidden group">
                            <div class="absolute inset-0 bg-gradient-to-br from-indigo-500/20 to-transparent"></div>
                            <div class="relative z-10 space-y-1">
                                <span class="text-[10px] font-black text-indigo-400 uppercase tracking-widest">Membership Status</span>
                                <div class="text-4xl font-black uppercase italic tracking-tighter text-transparent bg-clip-text bg-gradient-to-r from-white to-slate-400">{{ Auth::user()->role }}</div>
                            </div>
                            <div class="relative z-10 w-20 h-20 bg-white/10 text-white rounded-3xl flex items-center justify-center group-hover:-rotate-12 group-hover:scale-110 transition-all duration-500 backdrop-blur-xl">
                                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Order History -->
                    <div class="glass-card !bg-white dark:!bg-slate-900 overflow-hidden animate-blur-in stagger-2 border border-slate-100 dark:border-white/5">
                        <div class="p-10 border-b border-slate-50 dark:border-white/5 flex justify-between items-center bg-slate-50/50 dark:bg-white/5">
                            <h3 class="text-2xl font-black text-slate-900 dark:text-white tracking-tight">Recent Orders</h3>
                            <a href="#" class="text-[10px] font-black uppercase tracking-widest text-indigo-600 dark:text-indigo-400 hover:text-indigo-700 underline decoration-2 underline-offset-8 transition-all">Archive Access</a>
                        </div>
                        <div class="p-10 space-y-6">
                            @php $orders = Auth::user()->orders()->latest()->take(5)->get(); @endphp
                            @forelse($orders as $order)
                                <div class="flex items-center justify-between p-8 bg-white dark:bg-slate-800 rounded-3xl border border-slate-100 dark:border-white/5 transition-all hover:bg-slate-50 dark:hover:bg-slate-700 hover:shadow-xl hover:shadow-slate-100 dark:hover:shadow-none group">
                                    <div class="flex items-center gap-8">
                                        <div class="w-16 h-16 bg-slate-900 dark:bg-slate-950 text-white rounded-2xl flex items-center justify-center font-black text-xl group-hover:scale-110 transition-transform">#{{ $order->id }}</div>
                                        <div class="space-y-1">
                                            <div class="font-black text-slate-900 dark:text-white text-lg">Premium Fulfillment</div>
                                            <div class="text-[10px] text-slate-400 font-black uppercase tracking-[0.2em]">{{ $order->created_at->diffForHumans() }}</div>
                                        </div>
                                    </div>
                                    <div class="text-right space-y-2">
                                        <div class="text-3xl font-black text-slate-900 dark:text-white tracking-tighter">${{ number_format($order->total_amount, 2) }}</div>
                                        <span class="inline-block px-4 py-1.5 bg-emerald-50 dark:bg-emerald-900/20 text-emerald-600 dark:text-emerald-400 border border-emerald-100 dark:border-emerald-900/30 rounded-full text-[10px] font-black uppercase tracking-widest">{{ $order->status }}</span>
                                    </div>
                                </div>
                            @empty
                                <div class="py-20 text-center space-y-6">
                                    <div class="w-24 h-24 bg-slate-50 rounded-full flex items-center justify-center mx-auto text-slate-200">
                                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                        </svg>
                                    </div>
                                    <p class="text-slate-400 font-bold italic">No transactions recorded in your history.</p>
                                    <a href="/shop" class="btn-premium !inline-flex">Initiate Collection</a>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Right Column (Sidebar) -->
                <div class="space-y-12 animate-blur-in stagger-3">
                    <div class="glass-card !bg-white dark:!bg-slate-900 p-12 space-y-10 border border-slate-100 dark:border-white/5">
                        <h3 class="text-2xl font-black text-slate-900 dark:text-white tracking-tight">Access Terminal</h3>
                        <div class="space-y-4">
                            <a href="/shop" class="flex items-center justify-between p-8 bg-slate-50 dark:bg-slate-800 rounded-[2rem] border border-slate-100 dark:border-white/5 group hover:bg-slate-900 dark:hover:bg-slate-700 hover:border-slate-800 transition-all duration-500">
                                <span class="font-black text-slate-700 dark:text-slate-200 group-hover:text-white transition-colors uppercase text-xs tracking-widest">Explore Mart</span>
                                <div class="w-10 h-10 rounded-xl bg-white dark:bg-slate-700 flex items-center justify-center text-slate-400 group-hover:text-slate-900 dark:group-hover:text-white transition-all">
                                    <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                    </svg>
                                </div>
                            </a>
                            <a href="{{ route('profile.show') }}" class="flex items-center justify-between p-8 bg-slate-50 dark:bg-slate-800 rounded-[2rem] border border-slate-100 dark:border-white/5 group hover:bg-indigo-600 hover:border-indigo-500 transition-all duration-500">
                                <span class="font-black text-slate-700 dark:text-slate-200 group-hover:text-white transition-colors uppercase text-xs tracking-widest">Protocol Settings</span>
                                <div class="w-10 h-10 rounded-xl bg-white dark:bg-slate-700 flex items-center justify-center text-slate-400 group-hover:text-indigo-600 dark:group-hover:text-white transition-all">
                                    <svg class="w-5 h-5 group-hover:rotate-45 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                    </svg>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="relative bg-gradient-to-br from-indigo-700 to-blue-600 p-12 rounded-[2.5rem] shadow-2xl overflow-hidden group">
                        <div class="absolute -top-10 -right-10 w-40 h-40 bg-white/10 rounded-full blur-3xl group-hover:scale-150 transition-transform duration-700"></div>
                        <div class="relative z-10 space-y-8">
                            <div class="space-y-4">
                                <h3 class="text-3xl font-black text-white italic tracking-tighter leading-none">Concierge Support</h3>
                                <p class="text-white/80 font-bold leading-relaxed opacity-90">Exclusive 24/7 dedicated assistance protocol for premium members.</p>
                            </div>
                            <button class="w-full py-5 bg-white text-indigo-700 font-black rounded-2xl hover:bg-slate-900 hover:text-white transition-all uppercase text-[10px] tracking-[0.3em] shadow-xl">Engage Agent</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

