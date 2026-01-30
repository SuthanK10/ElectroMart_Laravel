<div class="pt-28 pb-24 bg-slate-50 dark:bg-slate-950 min-h-screen transition-colors duration-500">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="mb-16 space-y-4">
            <div class="flex items-center gap-4">
                <div class="w-1.5 h-10 bg-blue-600 rounded-full"></div>
                <h1 class="text-5xl font-['Outfit'] font-black text-slate-900 dark:text-white uppercase italic tracking-tighter">Your Shopping Cart</h1>
            </div>
            <p class="text-slate-500 dark:text-slate-400 font-medium italic">Review your selection and proceed to secure checkout.</p>
        </div>

        @if(count($cart) > 0)
            <div class="grid lg:grid-cols-3 gap-12 items-start">
                <!-- Cart Items -->
                <div class="lg:col-span-2 space-y-6">
                    @foreach($cart as $productId => $item)
                        <div class="group bg-white dark:bg-slate-900 p-6 sm:p-8 rounded-[2.5rem] border border-slate-100 dark:border-white/5 flex flex-col sm:flex-row items-center gap-8 shadow-sm hover:shadow-xl transition-all duration-500">
                            <!-- Image Container -->
                            <div class="w-40 h-40 bg-white dark:bg-slate-800 rounded-3xl overflow-hidden shrink-0 border border-slate-100 dark:border-white/5">
                                @if($item['image'])
                                    <img src="{{ str_starts_with($item['image'], 'http') ? $item['image'] : asset('storage/' . $item['image']) }}" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700">
                                @else
                                    <div class="w-full h-full flex items-center justify-center font-black text-slate-200 dark:text-slate-700 text-xs uppercase tracking-widest">No Image</div>
                                @endif
                            </div>
                            
                            <!-- Item Info -->
                            <div class="flex-1 text-center sm:text-left space-y-3">
                                <div class="space-y-1">
                                    <p class="text-[10px] font-black text-blue-600 uppercase tracking-[0.3em]">Item {{ $loop->iteration }}</p>
                                    <h3 class="text-2xl font-black text-slate-900 dark:text-white uppercase italic tracking-tight leading-none">{{ $item['name'] }}</h3>
                                </div>
                                <div class="flex items-center justify-center sm:justify-start gap-3">
                                    <span class="text-blue-600 font-black text-lg font-['Outfit']">${{ number_format($item['price'], 2) }}</span>
                                    <div class="h-1 w-1 bg-slate-200 dark:bg-slate-700 rounded-full"></div>
                                    <span class="text-slate-400 dark:text-slate-500 font-bold text-xs uppercase tracking-widest">Unit Price</span>
                                </div>
                            </div>

                            <!-- Quantity & Total -->
                            <div class="flex flex-col items-center sm:items-end gap-6 w-full sm:w-auto">
                                <div class="flex items-center bg-slate-50 dark:bg-slate-800 rounded-2xl p-1 border border-slate-100 dark:border-white/10">
                                    <div class="px-6 py-2 text-sm font-black text-slate-900 dark:text-white">Qty: {{ $item['quantity'] }}</div>
                                </div>
                                <div class="text-right">
                                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Total</p>
                                    <div class="text-3xl font-black text-slate-900 dark:text-white tracking-tighter">${{ number_format($item['price'] * $item['quantity'], 2) }}</div>
                                </div>
                                <button wire:click="removeItem({{ $productId }})" class="flex items-center gap-2 px-4 py-2 text-rose-500 hover:bg-rose-50 dark:hover:bg-rose-500/10 rounded-xl transition-all text-[10px] font-black uppercase tracking-widest border border-transparent hover:border-rose-100 dark:hover:border-rose-500/20">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                    Remove Item
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Checkout Sidebar -->
                <div class="lg:col-span-1">
                    <div class="bg-white dark:bg-slate-900 p-8 lg:p-10 rounded-[3rem] border border-slate-100 dark:border-white/5 shadow-2xl sticky top-32 space-y-10">
                        <div class="space-y-2">
                            <h3 class="text-3xl font-['Outfit'] font-black uppercase italic tracking-tighter text-slate-950 dark:text-white">Order Summary</h3>
                            <div class="w-12 h-1 bg-blue-600"></div>
                        </div>
                        
                        <div class="space-y-6">
                            <!-- Coupon Input -->
                            <div class="space-y-2">
                                <label class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em]">Promo Code</label>
                                <div class="flex gap-2">
                                    <input type="text" wire:model="couponCode" placeholder="Enter code" class="flex-1 bg-slate-50 dark:bg-slate-800 border-none rounded-xl p-3 text-slate-900 dark:text-white focus:ring-2 focus:ring-blue-500/20 text-xs font-bold uppercase tracking-wider">
                                    <button wire:click="applyCoupon" class="px-4 py-2 bg-slate-900 dark:bg-white text-white dark:text-slate-900 rounded-xl font-black text-[10px] uppercase tracking-widest hover:bg-blue-600 dark:hover:bg-blue-600 hover:text-white transition-colors">
                                        Apply
                                    </button>
                                </div>
                                @error('couponCode') <span class="text-rose-500 font-bold text-[10px] block uppercase tracking-wider">{{ $message }}</span> @enderror
                                @if (session()->has('success_coupon'))
                                    <div class="text-green-500 font-bold text-[10px] uppercase tracking-wider">{{ session('success_coupon') }}</div>
                                @endif
                            </div>

                            <div class="flex justify-between items-center text-slate-500 dark:text-slate-400">
                                <span class="text-[10px] font-black uppercase tracking-widest">Subtotal</span>
                                <span class="font-black text-slate-900 dark:text-white tracking-tight">${{ number_format($total + $discountAmount, 2) }}</span>
                            </div>
                            
                            @if($discountAmount > 0)
                                <div class="flex justify-between items-center text-green-500">
                                    <span class="text-[10px] font-black uppercase tracking-widest">Discount ({{ $appliedCoupon->code }})</span>
                                    <div class="flex items-center gap-2">
                                        <span class="font-black tracking-tight">-${{ number_format($discountAmount, 2) }}</span>
                                        <button wire:click="removeCoupon" class="text-rose-500 hover:text-rose-600">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                                        </button>
                                    </div>
                                </div>
                            @endif

                            <div class="flex justify-between items-center text-slate-500 dark:text-slate-400">
                                <span class="text-[10px] font-black uppercase tracking-widest">Shipping</span>
                                <span class="text-blue-600 font-black uppercase text-[10px] tracking-widest">Standard (Free)</span>
                            </div>
                            <div class="h-px bg-slate-100 dark:bg-slate-800"></div>
                            <div class="flex justify-between items-end">
                                <span class="text-slate-400 font-black text-[10px] uppercase tracking-[0.2em] mb-1">Grand Total</span>
                                <span class="text-5xl font-['Outfit'] font-black text-slate-900 dark:text-white tracking-tighter leading-none">${{ number_format($total, 2) }}</span>
                            </div>
                        </div>

                        <div class="space-y-8 pt-4">
                            <div class="space-y-6">
                                <div>
                                    <label class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] mb-3">Shipping Address</label>
                                    <textarea wire:model="shipping_address" placeholder="Enter your full shipping address" class="w-full bg-slate-50 dark:bg-slate-800 border-none rounded-2xl p-5 text-slate-900 dark:text-white focus:ring-2 focus:ring-blue-500/20 transition-all font-bold text-xs h-32"></textarea>
                                    @error('shipping_address') <span class="text-rose-500 font-bold text-[10px] mt-2 block uppercase tracking-wider">{{ $message }}</span> @enderror
                                </div>

                            </div>
                            
                            @if(!Auth::user()->isAdmin())
                                <button wire:click="checkout" class="group relative w-full px-8 py-6 bg-blue-600 hover:bg-blue-700 text-white rounded-2xl font-black text-xs uppercase tracking-[0.3em] shadow-2xl shadow-blue-600/20 transition-all active:scale-95 overflow-hidden">
                                    <span class="relative z-10">Checkout</span>
                                    <div class="absolute inset-0 bg-gradient-to-r from-blue-400/20 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
                                </button>
                            @else
                                <div class="p-6 bg-amber-50 dark:bg-amber-600/10 text-amber-600 rounded-2xl font-black text-center text-[10px] uppercase tracking-widest border border-amber-100 dark:border-amber-600/20">
                                    Admin Preview Mode: Checkout Disabled
                                </div>
                            @endif

                            @if (session()->has('success'))
                                <div class="p-5 bg-blue-50 dark:bg-blue-600/10 text-blue-600 rounded-2xl font-black text-center text-[10px] uppercase tracking-widest border border-blue-100 dark:border-blue-600/20">
                                    {{ session('success') }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @else
            <!-- Empty State -->
            <div class="relative py-40 bg-white dark:bg-slate-900 text-center rounded-[4rem] border border-slate-100 dark:border-white/5 shadow-2xl overflow-hidden">
                <div class="absolute top-0 left-0 w-32 h-32 bg-blue-600/5 rounded-br-full"></div>
                <div class="relative z-10 space-y-10">
                    <div class="w-32 h-32 bg-slate-50 dark:bg-slate-800 rounded-[2.5rem] flex items-center justify-center mx-auto shadow-inner transform rotate-6 scale-90 sm:scale-100 transition-transform">
                        <svg class="w-16 h-16 text-slate-200 dark:text-slate-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                    </div>
                    <div class="space-y-4 px-6">
                        <h2 class="text-5xl font-['Outfit'] font-black text-slate-900 dark:text-white uppercase italic tracking-tighter">Your cart is empty.</h2>
                        <p class="text-slate-500 dark:text-slate-400 font-medium italic max-w-sm mx-auto">Looks like you haven't added any products yet. Explore our shop to find the best tech tools.</p>
                    </div>
                    <a href="/shop" class="inline-flex px-12 py-6 bg-blue-600 hover:bg-blue-700 text-white rounded-2xl font-black text-xs uppercase tracking-[0.3em] shadow-2xl shadow-blue-600/20 transition-all hover:scale-105 active:scale-95">
                        Go to Shop
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>
