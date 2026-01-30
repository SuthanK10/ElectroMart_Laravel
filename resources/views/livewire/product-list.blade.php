<div class="relative">
    <!-- Subtle Gradient Ornament -->
    <div class="absolute -top-48 -left-48 w-96 h-96 bg-blue-600/5 rounded-full blur-[120px] pointer-events-none"></div>

    <!-- Professional Category Filter Pills -->
    <div class="mb-6 flex flex-col items-center gap-6">
        <div class="flex flex-wrap justify-center items-center gap-4">
            <button wire:click="selectCategory(null)" 
                    class="px-8 py-4 rounded-2xl {{ !$category_id ? 'bg-blue-600 text-white shadow-xl shadow-blue-600/20' : 'bg-white dark:bg-slate-900 text-slate-400 border border-slate-100 dark:border-white/5' }} text-[10px] font-black uppercase tracking-widest italic transition-all hover:scale-105 active:scale-95">
                All Gears
            </button>
            @foreach(\App\Models\Category::all() as $category)
                <button wire:click="selectCategory({{ $category->id }})" 
                        class="px-8 py-4 rounded-2xl {{ $category_id == $category->id ? 'bg-blue-600 text-white shadow-xl shadow-blue-600/20' : 'bg-white dark:bg-slate-900 text-slate-400 border border-slate-100 dark:border-white/5' }} text-[10px] font-black uppercase tracking-widest transition-all hover:scale-105 active:scale-95 italic">
                    {{ $category->name }}
                </button>
            @endforeach
        </div>
        
        <div class="flex items-center gap-4 group">
            <div class="h-px w-12 bg-slate-200 dark:bg-slate-800 transition-all group-hover:w-24"></div>
            <p class="text-[10px] font-black uppercase tracking-[0.4em] text-slate-300 dark:text-slate-600 italic">Discover Precision Performance</p>
            <div class="h-px w-12 bg-slate-200 dark:bg-slate-800 transition-all group-hover:w-24"></div>
        </div>
    </div>

    <!-- Search Section -->
    <div class="mb-12 relative z-10 flex justify-center lg:justify-start">
        <div class="group flex items-center w-full max-w-lg bg-white dark:bg-slate-900 border border-slate-100 dark:border-white/5 rounded-[2.5rem] shadow-premium focus-within:ring-8 focus-within:ring-blue-600/5 transition-all px-10">
            <div class="shrink-0">
                <svg class="h-6 w-6 text-slate-300 group-focus-within:text-blue-600 transition-colors pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            </div>
            <input type="text" 
                   wire:model.live.debounce.300ms="search" 
                   placeholder="SEARCH TECH..." 
                   class="flex-1 bg-transparent border-none py-8 pl-6 pr-4 text-xs font-black uppercase tracking-[0.3em] italic transition-all dark:text-white placeholder:text-slate-200 dark:placeholder:text-slate-700 outline-none focus:ring-0">
        </div>
    </div>

    @if (session()->has('success'))
        <div class="mb-12 p-5 bg-blue-50 dark:bg-blue-600/10 text-blue-600 rounded-2xl font-black text-center text-[10px] uppercase tracking-widest border border-blue-100 dark:border-blue-600/20 animate-blur-in">
            {{ session('success') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="mb-12 p-5 bg-rose-50 dark:bg-rose-600/10 text-rose-500 rounded-2xl font-black text-center text-[10px] uppercase tracking-widest border border-rose-100 dark:border-rose-600/20 animate-blur-in">
            {{ session('error') }}
        </div>
    @endif

    @if($products->isEmpty())
        <div class="py-24 text-center">
            <h3 class="text-3xl font-black uppercase italic tracking-tighter text-slate-300 dark:text-slate-700">No Gear Found</h3>
        </div>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 lg:gap-12 relative z-10">
        @foreach($products as $product)
            <div wire:key="product-{{ $product->id }}" class="group flex flex-col">
                <!-- Image Wrapper -->
                <div class="relative aspect-square bg-white dark:bg-slate-900 rounded-[3rem] overflow-hidden mb-8 border border-slate-100 dark:border-white/5 shadow-sm transition-all duration-700 hover:shadow-3xl hover:-translate-y-3 cursor-pointer">
                    <!-- Glassy Overlay -->
                    <div class="absolute inset-0 bg-gradient-to-tr from-blue-600/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-700 pointer-events-none"></div>
                    
                    <a href="{{ route('products.show', $product->slug) }}" class="block w-full h-full">
                        @if($product->image_path)
                            @php
                                try {
                                    $imageUrl = str_starts_with($product->image_path, 'http') 
                                        ? $product->image_path 
                                        : \Illuminate\Support\Facades\Storage::url($product->image_path);
                                } catch (\Exception $e) {
                                    $imageUrl = 'https://placehold.co/600x600?text=Missing+File';
                                }
                            @endphp
                            <img src="{{ $imageUrl }}" 
                                 alt="{{ $product->name }}" 
                                 loading="lazy"
                                 onerror="this.onerror=null; this.src='https://placehold.co/600x600?text=No+Image';"
                                 class="w-full h-full object-cover transform transition-transform duration-1000 group-hover:scale-110">
                        @else
                            <div class="w-full h-full flex items-center justify-center font-black text-slate-100 dark:text-slate-800 uppercase tracking-[0.2em] text-[10px] italic">No Image</div>
                        @endif
                    </a>
                    
                    <!-- Feature Badges -->
                    <div class="absolute top-8 left-8">
                         @if($loop->first || $product->stock < 5)
                            <div class="relative">
                                <span class="relative z-10 px-5 py-2 bg-blue-600 text-white rounded-2xl text-[9px] font-black uppercase tracking-[0.2em] shadow-xl italic inline-block">Featured</span>
                                <div class="absolute inset-0 bg-blue-600 blur-md opacity-20 animate-pulse"></div>
                            </div>
                         @endif
                    </div>

                    <!-- Simplified Add Button - More Premium -->
                    <button wire:click="addToCart({{ $product->id }})" 
                            class="absolute bottom-8 right-8 w-14 h-14 bg-slate-950 dark:bg-white text-white dark:text-slate-950 rounded-2xl flex items-center justify-center shadow-2xl opacity-0 group-hover:opacity-100 translate-y-6 group-hover:translate-y-0 transition-all duration-500 hover:bg-blue-600 hover:text-white dark:hover:bg-blue-600 dark:hover:text-white">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                    </button>
                </div>
                
                <!-- Info Section -->
                <div class="space-y-4 px-4">
                    <div class="flex items-center gap-2">
                        <div class="w-1 h-3 bg-blue-600 rounded-full"></div>
                        <p class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.3em] leading-none italic">{{ $product->category->name }}</p>
                    </div>
                    
                    <a href="{{ route('products.show', $product->slug) }}" class="block text-2xl font-black text-slate-900 dark:text-white hover:text-blue-600 transition-colors tracking-tighter leading-[0.9] uppercase italic">
                        {{ $product->name }}
                    </a>
                    
                    <!-- Enhanced Rating -->
                    <div class="flex items-center gap-3 pt-1">
                        <div class="flex text-blue-600">
                            @for($i=0; $i<5; $i++)
                                <svg class="w-3 h-3 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            @endfor
                        </div>
                        <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest leading-none border-l border-slate-200 dark:border-slate-800 pl-3 italic">Verified Review</span>
                    </div>

                    <!-- Pricing -->
                    <div class="flex items-center gap-5 pt-4">
                        <div class="relative">
                            <span class="text-3xl font-['Outfit'] font-black text-slate-950 dark:text-white tracking-tighter leading-none">${{ number_format($product->price, 0) }}</span>
                        </div>
                        @if($product->price > 1000)
                            <span class="text-xs font-black text-slate-300 dark:text-slate-600 line-through tracking-tighter opacity-50">${{ number_format($product->price * 1.2, 0) }}</span>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    @endif
</div>
