<x-guest-layout>
    <div class="relative min-h-screen flex items-center justify-center p-4 sm:p-8 overflow-hidden">
        <!-- Background Decor -->
        <div class="absolute inset-0 pointer-events-none">
            <div class="absolute top-0 left-0 w-[800px] h-[800px] bg-blue-600/5 rounded-full blur-[120px] -ml-96 -mt-96"></div>
            <div class="absolute bottom-0 right-0 w-[600px] h-[600px] bg-blue-900/10 rounded-full blur-[100px] -mr-48 -mb-48"></div>
        </div>

        <div class="relative w-full max-w-[1200px] grid lg:grid-cols-2 bg-white dark:bg-slate-900 rounded-[3.5rem] shadow-3xl border border-slate-100 dark:border-white/5 overflow-hidden animate-blur-in">
            <!-- Left Side: Form -->
            <div class="p-8 sm:p-12 lg:p-20 flex flex-col justify-center bg-white dark:bg-slate-900 order-2 lg:order-1">
                <div class="mb-10 space-y-4">
                    <div class="flex items-center gap-3 lg:hidden mb-10">
                        <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center text-white">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                        </div>
                        <span class="text-xl font-black tracking-tighter text-slate-950 dark:text-white uppercase italic">ElectroMart</span>
                    </div>
                    <h1 class="text-4xl font-['Outfit'] font-black text-slate-950 dark:text-white uppercase italic tracking-tighter">Sign Up</h1>
                    <p class="text-slate-500 dark:text-slate-400 font-medium italic">Create your account to start shopping.</p>
                </div>

                <form method="POST" action="{{ route('register') }}" class="space-y-6">
                    @csrf

                    @if ($errors->any())
                        <div class="p-4 bg-rose-50 dark:bg-rose-500/10 border border-rose-100 dark:border-rose-500/20 rounded-2xl">
                            @foreach ($errors->all() as $error)
                                <p class="text-[10px] font-black text-rose-500 uppercase tracking-widest">{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif

                    <div class="space-y-5">
                        <div class="grid sm:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] mb-3 ml-1">Full Name</label>
                                <input id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" 
                                       class="w-full bg-slate-50 dark:bg-slate-800 border-none rounded-2xl p-5 text-slate-900 dark:text-white focus:ring-2 focus:ring-blue-500/20 transition-all font-bold text-sm">
                            </div>

                            <div>
                                <label class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] mb-3 ml-1">Email Address</label>
                                <input id="email" type="email" name="email" :value="old('email')" required autocomplete="username" 
                                       class="w-full bg-slate-50 dark:bg-slate-800 border-none rounded-2xl p-5 text-slate-900 dark:text-white focus:ring-2 focus:ring-blue-500/20 transition-all font-bold text-sm">
                            </div>
                        </div>

                        <div>
                            <label class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] mb-3 ml-1">Phone Number (Optional)</label>
                            <input id="phone" type="text" name="phone" :value="old('phone')" 
                                   class="w-full bg-slate-50 dark:bg-slate-800 border-none rounded-2xl p-5 text-slate-900 dark:text-white focus:ring-2 focus:ring-blue-500/20 transition-all font-bold text-sm" placeholder="+1 [Optional]">
                        </div>

                        <div class="grid sm:grid-cols-2 gap-5">
                            <div x-data="{ show: false }">
                                <label class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] mb-3 ml-1">Password</label>
                                <div class="relative block w-full">
                                    <input id="password" :type="show ? 'text' : 'password'" name="password" required autocomplete="new-password" 
                                           class="w-full bg-slate-50 dark:bg-slate-800 border-none rounded-2xl p-5 pr-14 text-slate-900 dark:text-white focus:ring-2 focus:ring-blue-500/20 transition-all font-bold text-sm">
                                    <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 flex items-center pr-4 z-20 text-slate-400 hover:text-blue-600 transition-colors outline-none">
                                        <svg x-show="!show" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                                        <svg x-show="show" x-cloak class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" /></svg>
                                    </button>
                                </div>
                            </div>

                            <div x-data="{ show: false }">
                                <label class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] mb-3 ml-1">Confirm Password</label>
                                <div class="relative block w-full">
                                    <input id="password_confirmation" :type="show ? 'text' : 'password'" name="password_confirmation" required autocomplete="new-password" 
                                           class="w-full bg-slate-50 dark:bg-slate-800 border-none rounded-2xl p-5 pr-14 text-slate-900 dark:text-white focus:ring-2 focus:ring-blue-500/20 transition-all font-bold text-sm">
                                    <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 flex items-center pr-4 z-20 text-slate-400 hover:text-blue-600 transition-colors outline-none">
                                        <svg x-show="!show" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                                        <svg x-show="show" x-cloak class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" /></svg>
                                    </button>
                                </div>
                            </div>
                        </div>

                        @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                            <div class="flex items-center px-1">
                                <label class="flex items-center cursor-pointer group">
                                    <div class="relative">
                                        <input type="checkbox" name="terms" id="terms" required class="peer hidden">
                                        <div class="w-5 h-5 border-2 border-slate-200 dark:border-slate-700 rounded-md peer-checked:bg-blue-600 peer-checked:border-blue-600 transition-all"></div>
                                        <svg class="absolute inset-0 w-5 h-5 text-white scale-0 peer-checked:scale-100 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M5 13l4 4L19 7" /></svg>
                                    </div>
                                    <span class="ms-3 text-[10px] font-black text-slate-400 uppercase tracking-widest leading-relaxed">
                                        Accept {!! __('the :terms_of_service and :privacy_policy', [
                                                'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="text-blue-600 underline">Terms of Service</a>',
                                                'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="text-blue-600 underline">Privacy Policy</a>',
                                        ]) !!}
                                    </span>
                                </label>
                            </div>
                        @endif
                    </div>

                    <div class="space-y-6 pt-4">
                        <button type="submit" class="group relative w-full px-8 py-6 bg-blue-600 hover:bg-blue-700 text-white rounded-2xl font-black text-xs uppercase tracking-[0.4em] shadow-2xl shadow-blue-600/20 transition-all active:scale-95 overflow-hidden">
                            <span class="relative z-10">Create Account</span>
                            <div class="absolute inset-0 bg-gradient-to-r from-blue-400/20 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
                        </button>

                        <div class="text-center">
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">
                                Already have an account? 
                                <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-700 ml-1 italic group outline-none">
                                    Login here
                                    <i data-lucide="arrow-right" class="w-3 h-3 inline-block transition-transform group-hover:translate-x-1"></i>
                                </a>
                            </p>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Right Side: Visual/Branding -->
            <div class="hidden lg:flex flex-col justify-between p-16 bg-blue-600 relative overflow-hidden order-1 lg:order-2">
                <div class="absolute inset-0 opacity-20">
                    <div class="absolute inset-0 bg-gradient-to-bl from-slate-950/80 to-transparent"></div>
                    <img src="https://images.unsplash.com/photo-1518770660439-4636190af475?auto=format&fit=crop&q=80&w=1200" class="w-full h-full object-cover grayscale opacity-40">
                </div>

                <div class="relative z-10 flex justify-end">
                    <a href="/" class="flex items-center gap-4 group">
                        <span class="text-2xl font-black tracking-tighter text-white uppercase italic">Electro<span class="text-slate-950">Mart</span></span>
                        <div class="w-12 h-12 bg-slate-950 rounded-2xl flex items-center justify-center shadow-2xl transition-transform group-hover:-rotate-6">
                            <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                        </div>
                    </a>
                </div>

                <div class="relative z-10 space-y-6 text-right">
                    <h2 class="text-6xl font-['Outfit'] font-black text-white uppercase italic tracking-tighter leading-none">
                        Join <br/> The <span class="text-slate-950 not-italic">Community.</span>
                    </h2>
                    <p class="text-blue-100 font-medium italic text-lg leading-relaxed max-w-sm ml-auto">
                        Create your account and start exploring the best tech tools available.
                    </p>
                </div>

                <div class="relative z-10 border-t border-white/20 pt-8 flex justify-end">
                    <div class="flex items-center gap-4">
                        <p class="text-[9px] font-black uppercase tracking-[0.2em] text-blue-100">Global Registry Active</p>
                        <div class="flex -space-x-3">
                            <div class="w-10 h-10 rounded-full bg-blue-700 border-2 border-blue-600 flex items-center justify-center text-[8px] font-black italic">REG_X</div>
                            <div class="w-10 h-10 rounded-full bg-blue-700 border-2 border-blue-600 flex items-center justify-center text-[8px] font-black italic">REG_Y</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
