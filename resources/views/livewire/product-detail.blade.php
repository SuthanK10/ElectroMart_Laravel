<div class="pt-28 pb-24 bg-slate-50 dark:bg-slate-950 min-h-screen transition-colors duration-500">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Back Link -->
        <div class="mb-6">
            <a href="/shop" class="inline-flex items-center gap-3 text-slate-400 hover:text-blue-600 font-black text-[10px] uppercase tracking-[0.2em] transition-all group">
                <div class="p-2 rounded-full bg-white dark:bg-slate-900 border border-slate-100 dark:border-white/5 shadow-sm group-hover:shadow-md transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
                </div>
                Back to Shop
            </a>
        </div>

        <div class="grid lg:grid-cols-2 gap-16 lg:gap-24 items-start">
            <!-- Product Gallery -->
            <div class="animate-blur-in">
                <div class="relative aspect-square bg-white dark:bg-slate-900 border border-slate-100 dark:border-white/5 rounded-[3.5rem] overflow-hidden shadow-2xl group">
                    <!-- Subtle Glow -->
                    <div class="absolute inset-0 bg-gradient-to-tr from-blue-600/5 to-transparent pointer-events-none"></div>
                    
                    @if($currentImage)
                        <img src="{{ str_starts_with($currentImage, 'http') ? $currentImage : asset('storage/' . $currentImage) }}" class="w-full h-full object-cover transform transition-transform duration-1000 group-hover:scale-110">
                    @else
                        <div class="w-full h-full flex items-center justify-center italic text-slate-100 dark:text-slate-800 font-black text-6xl">NO IMAGE</div>
                    @endif
                    
                    <div class="absolute top-8 left-8">
                        <span class="px-5 py-2 bg-blue-600 text-white rounded-2xl text-[10px] font-black uppercase tracking-widest shadow-xl">Premium Quality</span>
                    </div>
                </div>
            </div>

            <!-- Product Info -->
            <div class="space-y-12 animate-blur-in" style="animation-delay: 0.1s">
                <div class="space-y-6">
                    <div class="flex items-center gap-3">
                        <div class="w-1.5 h-6 bg-blue-600 rounded-full"></div>
                        <span class="text-blue-600 font-black text-[10px] uppercase tracking-[0.4em] leading-none">{{ $product->category->name }}</span>
                    </div>
                    
                    <h1 class="text-5xl md:text-7xl font-['Outfit'] font-black text-slate-950 dark:text-white uppercase italic tracking-tighter leading-[0.9]">{{ $product->name }}</h1>
                    
                    <div class="flex flex-wrap items-center gap-6 pt-2">
                        <div class="text-5xl font-['Outfit'] font-black text-slate-900 dark:text-white tracking-tighter">${{ number_format($this->totalPrice, 0) }}</div>
                        @if($product->price > 1000)
                            <div class="px-4 py-2 bg-rose-500/10 text-rose-500 rounded-xl font-black text-[10px] uppercase tracking-widest border border-rose-500/20 italic">Special Edition</div>
                        @endif
                    </div>
                </div>

                <div class="prose prose-lg dark:prose-invert text-slate-500 dark:text-slate-400 max-w-none">
                    <p class="leading-relaxed italic text-lg lg:text-xl font-medium">
                        {{ $product->description }}
                    </p>
                </div>

                <!-- Product Variants -->
                @if(count($availableVariants) > 0)
                <div class="space-y-6">
                    @foreach($availableVariants as $type => $variants)
                        <div>
                            <h3 class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 dark:text-slate-500 mb-3 italic">{{ $type }}</h3>
                            <div class="flex flex-wrap gap-3">
                                @foreach($variants as $variant)
                                    <button 
                                        wire:click="selectVariant('{{ $type }}', {{ $variant['id'] }})"
                                        class="px-6 py-3 rounded-xl font-black text-xs uppercase tracking-widest transition-all border {{ isset($selectedVariants[$type]) && $selectedVariants[$type]['id'] == $variant['id'] ? 'bg-slate-900 dark:bg-white text-white dark:text-slate-900 border-slate-900 dark:border-white shadow-lg scale-105' : 'bg-white dark:bg-slate-900 text-slate-500 dark:text-slate-400 border-slate-200 dark:border-white/10 hover:border-blue-500 hover:text-blue-500' }}"
                                    >
                                        {{ $variant['value'] }}
                                        @if($variant['price_modifier'] > 0)
                                            <span class="ml-1 text-[10px] opacity-75">(+${{ number_format($variant['price_modifier'], 0) }})</span>
                                        @endif
                                    </button>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
                @endif

                <div class="grid grid-cols-2 gap-6 lg:gap-8">
                    <div class="p-8 bg-white dark:bg-slate-900 border border-slate-100 dark:border-white/5 rounded-3xl shadow-sm hover:shadow-md transition-shadow">
                         <div class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 dark:text-slate-500 mb-3 italic">Build Quality</div>
                         <div class="text-lg font-black text-slate-950 dark:text-white uppercase tracking-tight italic">Premium materials</div>
                    </div>
                    <div class="p-8 bg-white dark:bg-slate-900 border border-slate-100 dark:border-white/5 rounded-3xl shadow-sm hover:shadow-md transition-shadow">
                         <div class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 dark:text-slate-500 mb-3 italic">Warranty</div>
                         <div class="text-lg font-black text-slate-950 dark:text-white uppercase tracking-tight italic">2 Years Warranty</div>
                    </div>
                </div>

                <div class="pt-8 space-y-8">
                    <div class="flex gap-4">
                        <button wire:click="addToCart" class="flex-1 group relative px-12 py-6 bg-blue-600 hover:bg-blue-700 text-white rounded-[2rem] font-black text-sm uppercase tracking-[0.2em] shadow-2xl shadow-blue-600/20 transition-all active:scale-95 overflow-hidden">
                            <span class="relative z-10 flex items-center justify-center gap-3">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" /></svg>
                                ADD TO CART
                            </span>
                            <div class="absolute inset-0 bg-gradient-to-r from-blue-400/20 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
                        </button>
                        
                        <button wire:click="toggleWishlist" class="px-6 py-6 bg-white dark:bg-slate-900 border rounded-[2rem] transition-all active:scale-95 shadow-lg shadow-slate-200/50 dark:shadow-none {{ $isWishlisted ? 'text-rose-500 border-rose-200 dark:border-rose-500/30' : 'text-slate-400 border-slate-200 dark:border-white/10 hover:text-rose-500 hover:border-rose-200' }}">
                            <svg class="w-8 h-8 transition-all duration-300 {{ $isWishlisted ? 'fill-current scale-110' : 'fill-none scale-100' }}" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                        </button>
                    </div>
                    
                    @if (session()->has('success'))
                        <div class="p-6 bg-blue-50 dark:bg-blue-600/10 text-blue-600 rounded-2xl font-black text-center border border-blue-100 dark:border-blue-600/20 flex items-center justify-center gap-3 text-xs uppercase tracking-widest shadow-inner">
                             <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" /></svg>
                             Success: Item added to cart
                        </div>
                    @endif

                    @if (session()->has('error'))
                        <div class="p-6 bg-rose-50 dark:bg-rose-600/10 text-rose-500 rounded-2xl font-black text-center border border-rose-100 dark:border-rose-600/20 flex items-center justify-center gap-3 text-xs uppercase tracking-widest shadow-inner">
                             <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
                             {{ session('error') }}
                        </div>
                    @endif
                </div>

                <div class="pt-12 border-t border-slate-100 dark:border-white/5">
                    <h4 class="text-[10px] font-black uppercase tracking-[0.3em] text-slate-400 dark:text-slate-500 mb-8 italic">Product Details</h4>
                    <div class="space-y-6">
                        <div class="flex justify-between items-end py-1 text-sm">
                            <span class="text-slate-400 dark:text-slate-500 font-bold italic uppercase text-[10px] tracking-widest">Quality Standard</span>
                            <span class="text-slate-950 dark:text-white font-black italic uppercase tracking-tight border-b border-blue-600/30 pb-1">High Standard</span>
                        </div>
                        <div class="flex justify-between items-end py-1 text-sm">
                            <span class="text-slate-400 dark:text-slate-500 font-bold italic uppercase text-[10px] tracking-widest">Main Material</span>
                            <span class="text-slate-950 dark:text-white font-black italic uppercase tracking-tight border-b border-blue-600/30 pb-1">Durable Alloy</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- REVIEWS SECTION -->
        <div class="mt-24 pt-24 border-t border-slate-100 dark:border-white/5">
            @livewire('product-reviews', ['product' => $product])
        </div>
    </div>
</div>
