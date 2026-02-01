<footer class="bg-white dark:bg-[#0a0a0b] border-t border-slate-100 dark:border-slate-800 pt-24 pb-12 transition-colors duration-500">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-16 mb-20">
            <!-- Brand & About -->
            <div class="space-y-8">
                <a href="/" class="flex items-center gap-2">
                    <div class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <span class="text-xl font-extrabold tracking-tight text-slate-900 dark:text-white transition-colors uppercase">Electro<span class="text-blue-600">Mart</span></span>
                </a>
                <p class="text-sm text-slate-500 dark:text-slate-400 font-medium leading-relaxed max-w-xs transition-colors">
                    Providing the most innovative technology solutions for modern lifestyles since 2010. Quality, performance, and reliability guaranteed.
                </p>
                <div class="flex gap-4">
                    @foreach(['globe', 'instagram', 'twitter', 'linkedin'] as $icon)
                        <a href="#" class="w-10 h-10 rounded-full bg-slate-50 dark:bg-slate-800 flex items-center justify-center text-slate-600 dark:text-slate-400 hover:bg-blue-600 hover:text-white transition-all shadow-sm">
                            <i data-lucide="{{ $icon }}" class="w-5 h-5"></i>
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- Shop Links -->
            <div>
                <h4 class="text-sm font-black uppercase tracking-widest text-slate-900 dark:text-white mb-8 transition-colors">Shop</h4>
                <ul class="space-y-4">
                    <li><a href="/shop" class="text-sm text-slate-500 dark:text-slate-400 font-medium hover:text-blue-600 transition-colors italic">Latest Collection</a></li>
                    <li><a href="/shop?category=laptops" class="text-sm text-slate-500 dark:text-slate-400 font-medium hover:text-blue-600 transition-colors italic">Laptops & Computers</a></li>
                    <li><a href="/shop?category=smartphones" class="text-sm text-slate-500 dark:text-slate-400 font-medium hover:text-blue-600 transition-colors italic">Smartphones & Tablets</a></li>
                    <li><a href="/shop?category=cameras" class="text-sm text-slate-500 dark:text-slate-400 font-medium hover:text-blue-600 transition-colors italic">Cameras & Video</a></li>
                    <li><a href="/shop?category=headphones" class="text-sm text-slate-500 dark:text-slate-400 font-medium hover:text-blue-600 transition-colors italic">Audio & Headphones</a></li>
                </ul>
            </div>

            <!-- Customer Service -->
            <div>
                <h4 class="text-sm font-black uppercase tracking-widest text-slate-900 dark:text-white mb-8 transition-colors">Customer Service</h4>
                <ul class="space-y-4">
                    <li><a href="/about" class="text-sm text-slate-500 dark:text-slate-400 font-medium hover:text-blue-600 transition-colors italic">Our Story</a></li>
                    <li><a href="#" class="text-sm text-slate-500 dark:text-slate-400 font-medium hover:text-blue-600 transition-colors italic">Contact Us</a></li>
                    <li><a href="#" class="text-sm text-slate-500 dark:text-slate-400 font-medium hover:text-blue-600 transition-colors italic">Shipping & Returns</a></li>
                    <li><a href="#" class="text-sm text-slate-500 dark:text-slate-400 font-medium hover:text-blue-600 transition-colors italic">Order Tracking</a></li>
                    <li><a href="#" class="text-sm text-slate-500 dark:text-slate-400 font-medium hover:text-blue-600 transition-colors italic">FAQ</a></li>
                </ul>
            </div>

            <!-- Connect With Us -->
            <div class="space-y-8">
                <h4 class="text-sm font-black uppercase tracking-widest text-slate-900 dark:text-white transition-colors uppercase italic">Connect With Us</h4>
                <div class="space-y-4">
                    <div class="flex items-center gap-3 text-slate-500 dark:text-slate-400">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        <span class="text-sm font-medium italic">+94 (11) 233-5566</span>
                    </div>
                    <div class="flex items-center gap-3 text-slate-500 dark:text-slate-400">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        <span class="text-sm font-medium italic">Colombo 02, Sri Lanka</span>
                    </div>
                </div>
                <!-- Payment methods placeholder icons -->
                <div class="flex gap-2">
                    <div class="w-10 h-6 bg-slate-100 dark:bg-slate-800 rounded border border-slate-200 dark:border-slate-700 flex items-center justify-center text-[10px] font-bold text-slate-400">VISA</div>
                    <div class="w-10 h-6 bg-slate-100 dark:bg-slate-800 rounded border border-slate-200 dark:border-slate-700 flex items-center justify-center text-[10px] font-bold text-slate-400">MC</div>
                    <div class="w-10 h-6 bg-slate-100 dark:bg-slate-800 rounded border border-slate-200 dark:border-slate-700 flex items-center justify-center text-[10px] font-bold text-slate-400">PP</div>
                    <div class="w-10 h-6 bg-slate-100 dark:bg-slate-800 rounded border border-slate-200 dark:border-slate-700 flex items-center justify-center text-[10px] font-bold text-slate-400">AP</div>
                </div>
            </div>
        </div>

        <div class="pt-12 border-t border-slate-100 dark:border-slate-800 text-center">
            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-[0.3em]">
                &copy; {{ date('Y') }} ElectroMart Electronics. All rights reserved.
            </p>
        </div>
    </div>
</footer>
