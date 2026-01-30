<x-guest-layout>
    <div class="relative min-h-screen flex items-center justify-center p-4 sm:p-8 overflow-hidden">
        <!-- Background Decor -->
        <div class="absolute inset-0 pointer-events-none">
            <div class="absolute top-0 right-0 w-[800px] h-[800px] bg-blue-600/5 rounded-full blur-[120px] -mr-96 -mt-96"></div>
            <div class="absolute bottom-0 left-0 w-[600px] h-[600px] bg-blue-900/10 rounded-full blur-[100px] -ml-48 -mb-48"></div>
        </div>

        <div class="relative w-full max-w-[1200px] grid lg:grid-cols-2 bg-white dark:bg-slate-900 rounded-[3.5rem] shadow-3xl border border-slate-100 dark:border-white/5 overflow-hidden animate-blur-in">
            <!-- Left Side: Visual/Branding -->
            <div class="hidden lg:flex flex-col justify-between p-16 bg-slate-950 relative overflow-hidden">
                <div class="absolute inset-0 opacity-20">
                    <div class="absolute inset-0 bg-gradient-to-br from-blue-600/40 to-transparent"></div>
                    <img src="https://images.unsplash.com/photo-1550745165-9bc0b252726f?auto=format&fit=crop&q=80&w=1200" class="w-full h-full object-cover grayscale opacity-50">
                </div>

                <div class="relative z-10">
                    <a href="/" class="flex items-center gap-4 group">
                        <div class="w-12 h-12 bg-blue-600 rounded-2xl flex items-center justify-center shadow-2xl shadow-blue-600/20 transition-transform group-hover:rotate-6">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                        </div>
                        <span class="text-2xl font-black tracking-tighter text-white uppercase italic">Electro<span class="text-blue-500">Mart</span></span>
                    </a>
                </div>

                <div class="relative z-10 space-y-6">
                    <h2 class="text-6xl font-['Outfit'] font-black text-white uppercase italic tracking-tighter leading-none">
                        Welcome <br/> Back.
                    </h2>
                    <p class="text-slate-400 font-medium italic text-lg leading-relaxed max-w-sm">
                        Please enter your details to access your account.
                    </p>
                </div>

                <div class="relative z-10 border-t border-white/10 pt-8">
                    <div class="flex items-center gap-4">
                        <div class="flex -space-x-3">
                            <div class="w-10 h-10 rounded-full bg-slate-800 border-2 border-slate-950 flex items-center justify-center text-[8px] font-black italic">EM_01</div>
                            <div class="w-10 h-10 rounded-full bg-slate-800 border-2 border-slate-950 flex items-center justify-center text-[8px] font-black italic">EM_02</div>
                        </div>
                        <p class="text-[9px] font-black uppercase tracking-[0.2em] text-slate-500">Authorized Personnel Only</p>
                    </div>
                </div>
            </div>

            <!-- Right Side: Form -->
            <div class="p-8 sm:p-16 lg:p-24 flex flex-col justify-center bg-white dark:bg-slate-900">
                <div class="mb-12 space-y-4">
                    <div class="flex items-center gap-3 lg:hidden mb-10">
                        <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center text-white">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                        </div>
                        <span class="text-xl font-black tracking-tighter text-slate-950 dark:text-white uppercase italic">ElectroMart</span>
                    </div>
                    <h1 class="text-4xl font-['Outfit'] font-black text-slate-950 dark:text-white uppercase italic tracking-tighter">Login</h1>
                    <p class="text-slate-500 dark:text-slate-400 font-medium italic">Sign in to your account.</p>
                </div>

                <form method="POST" action="{{ route('login') }}" class="space-y-8">
                    @csrf

                    @if ($errors->any())
                        <div class="p-4 bg-rose-50 dark:bg-rose-500/10 border border-rose-100 dark:border-rose-500/20 rounded-2xl">
                            @foreach ($errors->all() as $error)
                                <p class="text-[10px] font-black text-rose-500 uppercase tracking-widest">{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif

                    @session('status')
                        <div class="p-4 bg-emerald-50 dark:bg-emerald-500/10 border border-emerald-100 dark:border-emerald-500/20 rounded-2xl">
                            <p class="text-[10px] font-black text-emerald-600 uppercase tracking-widest">{{ $value }}</p>
                        </div>
                    @endsession

                    <div class="space-y-6">
                        <div>
                            <label class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] mb-3 ml-1">Email Address</label>
                            <input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" 
                                   class="w-full bg-slate-50 dark:bg-slate-800 border-none rounded-2xl p-6 text-slate-900 dark:text-white focus:ring-2 focus:ring-blue-500/20 transition-all font-bold text-sm">
                        </div>

                        <div x-data="{ show: false }">
                            <div class="flex justify-between items-center mb-3">
                                <label class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] ml-1">Password</label>
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}" class="text-[9px] font-black text-blue-600 hover:text-blue-700 uppercase tracking-widest italic outline-none">Forgot Password?</a>
                                @endif
                            </div>
                            <div class="relative block w-full">
                                <input id="password" :type="show ? 'text' : 'password'" name="password" required autocomplete="current-password"
                                       class="w-full bg-slate-50 dark:bg-slate-800 border-none rounded-2xl p-6 pr-16 text-slate-900 dark:text-white focus:ring-2 focus:ring-blue-500/20 transition-all font-bold text-sm">
                                <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 flex items-center pr-6 z-20 text-slate-400 hover:text-blue-600 transition-colors outline-none">
                                    <svg x-show="!show" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                                    <svg x-show="show" x-cloak class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" /></svg>
                                </button>
                            </div>
                        </div>

                        <div class="flex items-center px-1">
                            <label for="remember_me" class="flex items-center cursor-pointer group">
                                <div class="relative">
                                    <input type="checkbox" id="remember_me" name="remember" class="peer hidden">
                                    <div class="w-5 h-5 border-2 border-slate-200 dark:border-slate-700 rounded-md peer-checked:bg-blue-600 peer-checked:border-blue-600 transition-all"></div>
                                    <svg class="absolute inset-0 w-5 h-5 text-white scale-0 peer-checked:scale-100 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M5 13l4 4L19 7" /></svg>
                                </div>
                                <span class="ms-3 text-[10px] font-black text-slate-400 uppercase tracking-widest">Remember me</span>
                            </label>
                        </div>
                    </div>

                    <div class="space-y-6 pt-4">
                        <button type="submit" class="group relative w-full px-8 py-6 bg-blue-600 hover:bg-blue-700 text-white rounded-2xl font-black text-xs uppercase tracking-[0.4em] shadow-2xl shadow-blue-600/20 transition-all active:scale-95 overflow-hidden">
                            <span class="relative z-10">Sign In</span>
                            <div class="absolute inset-0 bg-gradient-to-r from-blue-400/20 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
                        </button>

                        <div class="text-center">
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">
                                New here? 
                                <a href="{{ route('register') }}" class="text-blue-600 hover:text-blue-700 ml-1 italic group outline-none">
                                    Create Account
                                    <i data-lucide="arrow-right" class="w-3 h-3 inline-block transition-transform group-hover:translate-x-1"></i>
                                </a>
                            </p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
