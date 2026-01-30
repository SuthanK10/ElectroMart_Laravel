<div class="pt-32 pb-24 bg-slate-50 dark:bg-slate-950 min-h-screen transition-colors duration-500">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="mb-16 space-y-4">
            <div class="flex items-center gap-4">
                <div class="w-1.5 h-10 bg-blue-600 rounded-full"></div>
                <h1 class="text-5xl font-['Outfit'] font-black text-slate-900 dark:text-white uppercase italic tracking-tighter">Order History</h1>
            </div>
            <p class="text-slate-500 dark:text-slate-400 font-medium italic">Your past orders and purchase history.</p>
        </div>

        <div class="space-y-8">
            @forelse($orders as $order)
                <div class="bg-white dark:bg-slate-900 rounded-[3rem] border border-slate-100 dark:border-white/5 shadow-xl overflow-hidden animate-blur-in" style="animation-delay: {{ $loop->index * 0.1 }}s">
                    <!-- Order Top Bar -->
                    <div class="bg-slate-50 dark:bg-slate-800/50 px-10 py-8 flex flex-wrap items-center justify-between gap-6 border-b border-slate-100 dark:border-white/5">
                        <div class="flex items-center gap-10">
                            <div class="space-y-1">
                                <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest leading-none">Order ID</p>
                                <p class="text-xl font-black text-slate-950 dark:text-white tracking-tighter">#{{ $order->id }}</p>
                            </div>
                            <div class="space-y-1">
                                <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest leading-none">Date</p>
                                <p class="text-sm font-black text-slate-900 dark:text-white tracking-tight uppercase italic">{{ $order->created_at->format('M d, Y') }}</p>
                            </div>
                            <div class="space-y-1">
                                <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest leading-none">Status</p>
                                <span class="px-4 py-1.5 rounded-xl text-[9px] font-black uppercase tracking-[0.2em] {{ $order->status === 'completed' ? 'bg-emerald-500 text-white' : 'bg-amber-500 text-white shadow-lg shadow-amber-500/20' }}">
                                    {{ $order->status }}
                                </span>
                            </div>
                        </div>
                        <div class="text-right flex flex-col items-end gap-2">
                            <div>
                                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Total Amount</p>
                                <p class="text-3xl font-['Outfit'] font-black text-blue-600 tracking-tighter leading-none">${{ number_format($order->total_amount, 2) }}</p>
                            </div>
                            <a href="{{ route('invoice.show', $order->id) }}" target="_blank" class="inline-flex items-center gap-2 px-4 py-2 bg-slate-100 dark:bg-slate-700/50 rounded-xl text-[9px] font-black uppercase tracking-widest text-slate-500 hover:text-blue-600 hover:bg-blue-50 transition-colors">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                                Invoice
                            </a>
                        </div>
                    </div>

                    <!-- Order Items -->
                    <div class="px-10 py-10 space-y-10">
                        @foreach($order->items as $item)
                            <div class="flex flex-col sm:row items-center gap-8 group">
                                <div class="w-24 h-24 bg-slate-50 dark:bg-slate-800 rounded-3xl border border-slate-100 dark:border-white/5 p-4 overflow-hidden shrink-0">
                                    <img src="{{ asset($item->product->image_path) }}" class="w-full h-full object-contain transform group-hover:scale-110 transition-transform duration-700">
                                </div>
                                <div class="flex-1 text-center sm:text-left">
                                    <p class="text-[9px] font-black text-blue-600 uppercase tracking-[0.3em] mb-1">Product</p>
                                    <h4 class="text-xl font-black text-slate-900 dark:text-white uppercase italic tracking-tight">{{ $item->product->name }}</h4>
                                    <div class="flex items-center justify-center sm:justify-start gap-3 mt-2 text-slate-400 dark:text-slate-500">
                                        <span class="text-[10px] font-bold uppercase tracking-widest">Qty: {{ $item->quantity }}</span>
                                        <div class="w-1 h-1 bg-slate-200 dark:bg-slate-700 rounded-full"></div>
                                        <span class="text-[10px] font-bold uppercase tracking-widest">Unit Price: ${{ number_format($item->price, 2) }}</span>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1">Subtotal</p>
                                    <p class="text-xl font-black text-slate-950 dark:text-white tracking-tighter">${{ number_format($item->price * $item->quantity, 2) }}</p>
                                </div>
                            </div>
                            @if(!$loop->last)
                                <div class="h-px bg-slate-50 dark:bg-slate-800"></div>
                            @endif
                        @endforeach
                    </div>

                    <!-- Shipping Info -->
                    <div class="px-10 py-8 bg-slate-50/50 dark:bg-slate-800/30 border-t border-slate-50 dark:border-white/5 flex flex-col sm:row justify-between gap-6">
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 bg-white dark:bg-slate-800 rounded-2xl flex items-center justify-center text-blue-600 shadow-sm">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /></svg>
                            </div>
                            <div>
                                <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1 italic">Shipping Address</p>
                                <p class="text-xs font-bold text-slate-600 dark:text-slate-300 italic">{{ $order->shipping_address }}</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 bg-white dark:bg-slate-800 rounded-2xl flex items-center justify-center text-blue-600 shadow-sm">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" /></svg>
                            </div>
                            <div>
                                <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1 italic">Contact Number</p>
                                <p class="text-xs font-bold text-slate-600 dark:text-slate-300 italic">{{ $order->contact_number }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="py-40 bg-white dark:bg-slate-900 text-center rounded-[3rem] border border-slate-100 dark:border-white/5 shadow-2xl">
                    <div class="w-32 h-32 bg-slate-50 dark:bg-slate-800 rounded-[2.5rem] flex items-center justify-center mx-auto mb-10 shadow-inner rotate-6">
                        <svg class="w-16 h-16 text-slate-200 dark:text-slate-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </div>
                    <h2 class="text-4xl font-['Outfit'] font-black text-slate-900 dark:text-white uppercase italic tracking-tighter">No orders found</h2>
                    <p class="text-slate-500 dark:text-slate-400 font-medium italic mt-4 mb-10">You haven't placed any orders yet. Start shopping to see your history!</p>
                    <a href="/shop" class="px-12 py-6 bg-blue-600 hover:bg-blue-700 text-white rounded-2xl font-black text-xs uppercase tracking-[0.3em] shadow-2xl transition-all hover:scale-105">Go to Shop</a>
                </div>
            @endforelse

            <div class="pt-10">
                {{ $orders->links() }}
            </div>
        </div>
    </div>
</div>
