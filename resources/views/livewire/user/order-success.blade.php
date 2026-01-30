<div class="py-24 bg-pattern min-h-screen">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Success Card -->
        <div class="bg-white dark:bg-slate-900 rounded-[3rem] shadow-3xl border border-slate-100 dark:border-white/5 overflow-hidden animate-blur-in">
            <!-- Header section -->
            <div class="bg-blue-600 p-12 text-center relative overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-br from-blue-500 to-blue-700 opacity-50"></div>
                <div class="relative z-10">
                    <div class="w-24 h-24 bg-white/20 text-white rounded-[2rem] flex items-center justify-center mx-auto mb-8 backdrop-blur-md shadow-inner transform rotate-12 scale-110">
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                    </div>
                    <h1 class="text-4xl md:text-5xl font-['Outfit'] font-black text-white uppercase italic tracking-tighter leading-none mb-4">Payment Successful</h1>
                    <p class="text-blue-100 font-medium italic opacity-80 uppercase tracking-widest text-xs">Order #{{ $order->id }} has been finalized</p>
                </div>
            </div>

            <div class="p-12">
                <!-- Order Summary -->
                <div class="mb-12">
                    <h2 class="text-2xl font-black text-slate-900 dark:text-white uppercase italic tracking-tight mb-8 flex items-center gap-3">
                        <span class="w-8 h-1 bg-blue-600 rounded-full"></span>
                        Order Summary
                    </h2>
                    
                    <div class="space-y-6">
                        @foreach($order->items as $item)
                            <div class="flex items-center justify-between group">
                                <div class="flex items-center gap-6">
                                    <div class="w-20 h-20 bg-slate-50 dark:bg-slate-800 rounded-2xl p-3 border border-slate-100 dark:border-white/5">
                                        <img src="{{ str_starts_with($item->product->image_path, 'http') ? $item->product->image_path : \Illuminate\Support\Facades\Storage::url($item->product->image_path) }}" 
                                             class="w-full h-full object-contain">
                                    </div>
                                    <div>
                                        <h3 class="font-black text-slate-800 dark:text-white uppercase italic text-sm tracking-tight">{{ $item->product->name }}</h3>
                                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Qty: {{ $item->quantity }} × ${{ number_format($item->price, 2) }}</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="font-black text-slate-900 dark:text-white tracking-tighter">${{ number_format($item->price * $item->quantity, 2) }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-10 pt-8 border-t border-slate-100 dark:border-white/5 flex justify-between items-center">
                        <p class="text-xl font-black text-slate-400 dark:text-slate-500 uppercase italic tracking-tighter">Total Amount Paid</p>
                        <p class="text-4xl font-['Outfit'] font-black text-blue-600 tracking-tighter italic">${{ number_format($order->total_amount, 2) }}</p>
                    </div>
                </div>

                <!-- Invoice section -->
                <div class="bg-slate-50 dark:bg-slate-950/50 rounded-[2.5rem] p-10 text-center border border-slate-100 dark:border-white/5">
                    @if(!$mailSent)
                        <h3 class="text-xl font-black text-slate-900 dark:text-white uppercase italic mb-4">Want the invoice?</h3>
                        <p class="text-sm text-slate-500 dark:text-slate-400 mb-8 max-w-sm mx-auto font-medium">We can dispatch a clean, professional PDF invoice to your registered email: <span class="text-blue-600 font-bold">{{ auth()->user()->email }}</span></p>
                        
                        <button wire:click="sendInvoice" 
                                class="px-12 py-5 bg-slate-950 dark:bg-white text-white dark:text-slate-950 rounded-2xl font-black text-xs uppercase tracking-widest transition-all hover:scale-105 active:scale-95 shadow-2xl flex items-center gap-3 mx-auto">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            Email My Invoice
                        </button>
                    @else
                        <div class="flex flex-col items-center">
                            <div class="w-16 h-16 bg-blue-600/10 text-blue-600 rounded-2xl flex items-center justify-center mb-6">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                            </div>
                            <h3 class="text-xl font-black text-blue-600 uppercase italic">Invoice Dispatched!</h3>
                            <p class="text-sm text-slate-500 font-medium mt-2">Check your inbox at {{ auth()->user()->email }}</p>
                        </div>
                    @endif
                </div>

                <div class="mt-12 flex justify-center gap-6">
                    <a href="{{ route('home') }}" class="text-[10px] font-black uppercase tracking-[0.3em] text-slate-400 hover:text-blue-600 transition-colors flex items-center gap-2 group">
                        <svg class="w-4 h-4 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
                        Back to Home
                    </a>
                    <a href="{{ route('orders.history') }}" class="text-[10px] font-black uppercase tracking-[0.3em] text-slate-400 hover:text-blue-600 transition-colors flex items-center gap-2 group">
                        View History
                        <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
