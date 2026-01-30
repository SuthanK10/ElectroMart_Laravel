<div class="pt-32 pb-20 space-y-8 max-w-5xl mx-auto px-6 lg:px-8">
    <!-- Header -->
    <div class="flex justify-between items-end">
        <div>
            <h2 class="text-3xl font-black text-slate-900 dark:text-white uppercase italic tracking-tighter">Coupon Manager</h2>
            <p class="text-slate-500 dark:text-slate-400 font-medium">Create and manage discount codes.</p>
        </div>
        <button wire:click="$set('showingModal', true)" class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-bold uppercase tracking-widest shadow-lg shadow-blue-500/30 transition-all flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Create Coupon
        </button>
    </div>

    <!-- Coupon List -->
    <div class="bg-white dark:bg-slate-900 rounded-3xl border border-slate-100 dark:border-white/5 overflow-hidden shadow-xl">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-slate-50 dark:bg-slate-800/50">
                    <tr>
                        <th class="px-8 py-5 text-[10px] font-black uppercase tracking-widest text-slate-400">Code</th>
                        <th class="px-8 py-5 text-[10px] font-black uppercase tracking-widest text-slate-400">Discount</th>
                        <th class="px-8 py-5 text-[10px] font-black uppercase tracking-widest text-slate-400">Visibility</th>
                        <th class="px-8 py-5 text-[10px] font-black uppercase tracking-widest text-slate-400">Status</th>
                        <th class="px-8 py-5 text-[10px] font-black uppercase tracking-widest text-slate-400 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-white/5">
                    @forelse($coupons as $coupon)
                    <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/30 transition-colors">
                        <td class="px-8 py-5">
                            <span class="font-black text-slate-900 dark:text-white uppercase tracking-wider">{{ $coupon->code }}</span>
                        </td>
                        <td class="px-8 py-5 font-bold text-slate-600 dark:text-slate-300">
                             {{ $coupon->type === 'fixed' ? '$' . number_format($coupon->value, 2) : $coupon->value . '%' }} OFF
                        </td>
                        <td class="px-8 py-5">
                            @if($coupon->is_featured)
                                <span class="px-3 py-1 bg-purple-100 text-purple-600 dark:bg-purple-500/10 dark:text-purple-400 rounded-full text-[10px] font-black uppercase tracking-widest">Featured</span>
                            @else
                                <span class="px-3 py-1 bg-slate-100 text-slate-500 dark:bg-slate-800 dark:text-slate-400 rounded-full text-[10px] font-black uppercase tracking-widest">Standard</span>
                            @endif
                        </td>
                        <td class="px-8 py-5">
                             <button wire:click="toggleStatus({{ $coupon->id }})" 
                                class="px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest transition-all {{ $coupon->is_active ? 'bg-green-100 text-green-600 dark:bg-green-500/10 dark:text-green-400' : 'bg-slate-100 text-slate-400 dark:bg-slate-800 dark:text-slate-500' }}">
                                 {{ $coupon->is_active ? 'Active' : 'Inactive' }}
                             </button>
                        </td>
                        <td class="px-8 py-5 text-right">
                             <button wire:click="deleteCoupon({{ $coupon->id }})" class="text-rose-400 hover:text-rose-600 transition-colors">
                                 <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                             </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-8 py-12 text-center text-slate-400 italic">No coupons found. Create one to get started.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Create Modal -->
    <x-dialog-modal wire:model="showingModal">
        <x-slot name="title">
            <span class="uppercase tracking-widest font-black italic">Create New Coupon</span>
        </x-slot>

        <x-slot name="content">
            <div class="space-y-6">
                <!-- Code -->
                <div>
                    <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2">Coupon Code</label>
                    <input type="text" wire:model="code" class="w-full bg-slate-50 dark:bg-slate-900 border-none rounded-xl font-bold uppercase tracking-wider focus:ring-2 focus:ring-blue-500" placeholder="e.g. SUMMER2026">
                    @error('code') <span class="text-rose-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div class="grid grid-cols-2 gap-6">
                    <!-- Type -->
                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2">Type</label>
                        <select wire:model="type" class="w-full bg-slate-50 dark:bg-slate-900 border-none rounded-xl font-bold focus:ring-2 focus:ring-blue-500">
                            <option value="percent">Percentage (%)</option>
                            <option value="fixed">Fixed Amount ($)</option>
                        </select>
                    </div>

                    <!-- Value -->
                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2">Value</label>
                        <input type="number" wire:model="value" class="w-full bg-slate-50 dark:bg-slate-900 border-none rounded-xl font-bold focus:ring-2 focus:ring-blue-500" placeholder="e.g. 10">
                        @error('value') <span class="text-rose-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Toggles -->
                <div class="space-y-4 pt-4 border-t border-slate-100 dark:border-white/5">
                    <label class="flex items-center gap-3 cursor-pointer group">
                        <div class="relative">
                            <input type="checkbox" wire:model="is_active" class="peer sr-only">
                            <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer dark:bg-slate-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                        </div>
                        <span class="font-bold text-slate-700 dark:text-slate-300 group-hover:text-blue-600 transition-colors">Active Status</span>
                    </label>

                    <label class="flex items-center gap-3 cursor-pointer group">
                        <div class="relative">
                            <input type="checkbox" wire:model="is_featured" class="peer sr-only">
                            <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer dark:bg-slate-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-purple-600"></div>
                        </div>
                        <span class="font-bold text-slate-700 dark:text-slate-300 group-hover:text-purple-600 transition-colors">Feature on Homepage</span>
                    </label>
                </div>
            </div>
        </x-slot>

        <x-slot name="footer">
            <button wire:click="$set('showingModal', false)" class="px-6 py-2 mr-2 text-slate-500 hover:text-slate-700 font-bold uppercase text-xs tracking-widest">Cancel</button>
            <button wire:click="saveCoupon" class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-bold uppercase text-xs tracking-widest shadow-lg">Save Coupon</button>
        </x-slot>
    </x-dialog-modal>
</div>
