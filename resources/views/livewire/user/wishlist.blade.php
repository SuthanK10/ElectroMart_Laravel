<div class="min-h-screen pt-28 pb-12 bg-slate-50 dark:bg-slate-950 transition-colors duration-500">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-end justify-between mb-12">
            <div>
                <h2 class="text-5xl font-['Outfit'] font-black text-slate-950 dark:text-white uppercase italic tracking-tighter mb-2">My Wishlist</h2>
                <p class="text-slate-500 dark:text-slate-400 font-medium">Saved items for later</p>
            </div>
            <div class="text-slate-400 font-black text-sm uppercase tracking-widest">{{ $wishlistItems->count() }} Items</div>
        </div>

        @if($wishlistItems->isEmpty())
             <div class="text-center py-24">
                <div class="inline-flex p-8 rounded-full bg-slate-100 dark:bg-slate-900 text-slate-300 dark:text-slate-700 mb-6">
                    <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" /></svg>
                </div>
                <h3 class="text-xl font-black text-slate-900 dark:text-white uppercase tracking-tight mb-2">Your wishlist is empty</h3>
                <p class="text-slate-500 mb-8 max-w-md mx-auto">Start exploring our premium collection and save your favorites.</p>
                <a href="{{ route('shop') }}" class="inline-block px-8 py-4 bg-blue-600 text-white rounded-2xl font-black text-xs uppercase tracking-widest shadow-lg shadow-blue-600/20 hover:bg-blue-700 transition-all hover:scale-105">Start Shopping</a>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                @foreach($wishlistItems as $item)
                    <div class="group bg-white dark:bg-slate-900 border border-slate-100 dark:border-white/5 rounded-[2rem] p-6 hover:shadow-2xl transition-all duration-500 hover:-translate-y-2">
                        <div class="relative aspect-square mb-6 bg-slate-50 dark:bg-slate-800/50 rounded-3xl overflow-hidden">
                            @if($item->product->image_path)
                                <img src="{{ str_starts_with($item->product->image_path, 'http') ? $item->product->image_path : asset('storage/' . $item->product->image_path) }}" alt="{{ $item->product->name }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                            @else
                                <span class="text-slate-300 dark:text-slate-600 font-black text-4xl italic">Img</span>
                            @endif
                            
                            <button wire:click="removeFromWishlist({{ $item->id }})" class="absolute top-4 right-4 p-2 bg-white/90 dark:bg-black/50 text-rose-500 rounded-full hover:bg-rose-500 hover:text-white transition-all shadow-sm">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                            </button>
                        </div>

                        <div class="space-y-4">
                            <div>
                                <div class="text-xs font-bold text-blue-600 uppercase tracking-widest mb-1">{{ $item->product->category->name }}</div>
                                <h3 class="text-xl font-black text-slate-900 dark:text-white italic leading-tight group-hover:text-blue-600 transition-colors line-clamp-1">{{ $item->product->name }}</h3>
                            </div>
                            
                            <div class="flex items-center justify-between">
                                <div class="text-2xl font-black text-slate-900 dark:text-white tracking-tighter">${{ number_format($item->product->price, 0) }}</div>
                                <a href="{{ route('products.show', $item->product->slug) }}" class="px-6 py-2 bg-blue-600 text-white rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-blue-700 hover:scale-105 transition-all shadow-lg shadow-blue-600/20">
                                    View
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
