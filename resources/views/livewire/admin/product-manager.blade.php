<div class="pt-32 pb-24 bg-slate-50 dark:bg-slate-950 min-h-screen transition-colors duration-500">
    <div class="max-w-[1500px] mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumbs / Back navigation -->
        <div class="mb-10 flex items-center gap-4">
            <a href="{{ route('admin.dashboard') }}" class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 hover:text-blue-600 flex items-center gap-2 transition-all group">
                <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7" /></svg>
                Dashboard
            </a>
            <div class="w-1 h-3 bg-slate-200 dark:bg-slate-800 rounded-full"></div>
            <span class="text-[10px] font-black uppercase tracking-[0.2em] text-blue-600 italic">Products</span>
        </div>

        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-16 gap-8 animate-blur-in">
            <div class="space-y-4">
                <div class="flex items-center gap-4">
                    <div class="w-2 h-10 bg-blue-600 rounded-full"></div>
                    <h1 class="text-5xl font-['Outfit'] font-black text-slate-900 dark:text-white uppercase italic tracking-tighter">Product Management</h1>
                </div>
                <p class="text-slate-500 dark:text-slate-400 font-medium italic">Manage and update your store's product catalog.</p>
            </div>
            
            <button wire:click="openModal" class="group relative px-10 py-5 bg-blue-600 hover:bg-blue-700 text-white rounded-[2rem] font-black text-[11px] uppercase tracking-[0.3em] shadow-2xl shadow-blue-600/20 transition-all active:scale-95 overflow-hidden">
                <span class="relative z-10 flex items-center gap-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 6v6m0 0v6m0-6h6m-6 0H6" /></svg>
                    Add New Product
                </span>
                <div class="absolute inset-0 bg-gradient-to-r from-blue-400/20 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
            </button>
        </div>

        @if (session()->has('message'))
            <div class="mb-12 p-8 bg-blue-600 text-white rounded-[2.5rem] shadow-2xl shadow-blue-600/20 flex items-center gap-6 animate-blur-in">
                <div class="w-12 h-12 bg-white/20 rounded-2xl flex items-center justify-center border border-white/30 backdrop-blur-sm">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" /></svg>
                </div>
                <div>
                    <span class="text-[10px] font-black uppercase tracking-widest opacity-60">System Update</span>
                    <p class="font-black text-lg tracking-tight">{{ session('message') }}</p>
                </div>
            </div>
        @endif

        <div class="bg-white dark:bg-slate-900 rounded-[3.5rem] border border-slate-100 dark:border-white/5 overflow-hidden shadow-2xl transition-colors duration-500">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-slate-50 dark:bg-slate-800/30 text-[10px] font-black uppercase tracking-[0.3em] text-slate-400">
                            <th class="px-10 py-8">Product</th>
                            <th class="px-10 py-8">Category</th>
                            <th class="px-10 py-8">Price</th>
                            <th class="px-10 py-8">Stock Status</th>
                            <th class="px-10 py-8 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50 dark:divide-slate-800/50">
                        @foreach($products as $product)
                            <tr class="group hover:bg-slate-50 dark:hover:bg-slate-800 transition-all duration-300">
                                <td class="px-10 py-10">
                                    <div class="flex items-center gap-8">
                                        <div class="w-20 h-24 bg-white dark:bg-slate-900 rounded-3xl overflow-hidden shrink-0 border border-slate-100 dark:border-white/10 transition-all group-hover:shadow-lg">
                                            @if($product->image_path)
                                                @php
                                                    try {
                                                        $imageUrl = str_starts_with($product->image_path, 'http') 
                                                            ? $product->image_path 
                                                            : \Illuminate\Support\Facades\Storage::url($product->image_path);
                                                    } catch (\Exception $e) {
                                                        $imageUrl = 'https://placehold.co/100x120?text=Error';
                                                    }
                                                @endphp
                                                <img src="{{ $imageUrl }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                                            @else
                                                <div class="w-full h-full flex items-center justify-center font-black text-slate-200 dark:text-slate-800 italic text-[8px] uppercase tracking-widest leading-none">NO IMAGE</div>
                                            @endif
                                        </div>
                                        <div class="space-y-2">
                                            <div class="font-black text-slate-900 dark:text-white text-2xl tracking-tighter uppercase italic group-hover:text-blue-600 transition-colors leading-none">{{ $product->name }}</div>
                                            <div class="flex items-center gap-3">
                                                <div class="w-1 h-3 bg-blue-600/30 rounded-full"></div>
                                                <div class="text-[9px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest">ID: #{{ str_pad($product->id, 5, '0', STR_PAD_LEFT) }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-10 py-10">
                                    <span class="px-5 py-2 bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-400 rounded-2xl text-[10px] font-black uppercase tracking-widest border border-slate-200 dark:border-white/5 italic">
                                        {{ $product->category->name }}
                                    </span>
                                </td>
                                <td class="px-10 py-10">
                                    <div class="font-black text-slate-950 dark:text-white text-3xl tracking-tighter font-['Outfit']">${{ number_format($product->price, 0) }}</div>
                                </td>
                                <td class="px-10 py-10">
                                    <div class="space-y-2">
                                        <div class="flex items-center gap-3">
                                            <div class="w-1.5 h-1.5 rounded-full {{ $product->stock < 10 ? 'bg-rose-500 shadow-lg shadow-rose-500/20 animate-pulse' : 'bg-emerald-500 shadow-lg shadow-emerald-500/20' }}"></div>
                                            <span class="text-sm font-black uppercase tracking-tight {{ $product->stock < 10 ? 'text-rose-500' : 'text-slate-900 dark:text-slate-400' }}">{{ $product->stock }} Units</span>
                                        </div>
                                        <div class="w-24 h-1 bg-slate-100 dark:bg-slate-800 rounded-full overflow-hidden">
                                            <div class="h-full {{ $product->stock < 10 ? 'bg-rose-500' : 'bg-emerald-500' }}" style="width: {{ min($product->stock, 100) }}%"></div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-10 py-10 text-right">
                                    <div class="flex justify-end gap-3 translate-x-4 opacity-0 group-hover:translate-x-0 group-hover:opacity-100 transition-all duration-500">
                                        <button wire:click="edit({{ $product->id }})" class="p-4 bg-white dark:bg-slate-900 border border-slate-100 dark:border-white/5 text-slate-400 hover:text-blue-600 hover:border-blue-100 dark:hover:border-blue-500/20 hover:shadow-2xl rounded-2xl transition-all">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                                        </button>
                                        <button onclick="confirm('Are you sure you want to delete this product?') || event.stopImmediatePropagation()" wire:click="delete({{ $product->id }})" class="p-4 bg-white dark:bg-slate-900 border border-slate-100 dark:border-white/5 text-slate-400 hover:text-rose-500 hover:border-rose-100 dark:hover:border-rose-500/20 hover:shadow-2xl rounded-2xl transition-all">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Product Modal - Redesigned Modal -->
    @if($showModal)
        <div class="fixed inset-0 z-[200] overflow-y-auto">
            <!-- Backdrop -->
            <div class="fixed inset-0 bg-slate-950/80 backdrop-blur-3xl transition-opacity animate-in fade-in duration-500" wire:click="closeModal"></div>
            
            <!-- Modal Layout Wrapper -->
            <div class="flex min-h-full items-center justify-center p-4">
                <div class="relative bg-white dark:bg-slate-900 rounded-[4rem] w-full max-w-4xl overflow-hidden shadow-2xl animate-blur-in my-8">
                    <div class="flex flex-col lg:row">
                    <!-- Modal Sidebar -->
                    <div class="hidden lg:block w-72 bg-slate-50 dark:bg-slate-800/50 p-12 border-r border-slate-100 dark:border-white/5">
                        <div class="space-y-12">
                            <div class="space-y-2">
                                <div class="w-12 h-12 bg-blue-600 rounded-[1.25rem] flex items-center justify-center text-white shadow-premium">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" /></svg>
                                </div>
                                <h4 class="text-xl font-black text-slate-950 dark:text-white uppercase italic tracking-tighter leading-none mt-4">Product Details</h4>
                                <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest italic">Product Management v1.0</p>
                            </div>
                            
                            <div class="space-y-6">
                                <div class="flex items-center gap-4 group cursor-help">
                                    <div class="w-2 h-2 rounded-full bg-blue-600"></div>
                                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Base Information</span>
                                </div>
                                <div class="flex items-center gap-4 opacity-30">
                                    <div class="w-2 h-2 rounded-full bg-slate-300"></div>
                                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Pricing</span>
                                </div>
                                <div class="flex items-center gap-4 opacity-30">
                                    <div class="w-2 h-2 rounded-full bg-slate-300"></div>
                                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Product Image</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex-1 p-10 lg:p-16">
                        <div class="flex justify-between items-start mb-12">
                             <div class="space-y-3">
                                 <h3 class="text-5xl font-['Outfit'] font-black text-slate-950 dark:text-white tracking-tighter uppercase italic leading-none">{{ $isEdit ? 'Edit Product' : 'Add Product' }}</h3>
                                 <p class="text-slate-500 dark:text-slate-400 font-medium italic">Update the product information below.</p>
                             </div>
                             <button wire:click="closeModal" class="p-3 bg-slate-50 dark:bg-slate-800 rounded-2xl text-slate-400 hover:text-rose-500 transition-colors">
                                 <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12" /></svg>
                             </button>
                        </div>
                        
                        <form wire:submit.prevent="save" class="space-y-10">
                            <div class="grid grid-cols-2 gap-8 lg:gap-10">
                                <div class="col-span-2">
                                    <label class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.3em] mb-4 italic">Product Name</label>
                                    <input type="text" wire:model="name" class="w-full bg-slate-50 dark:bg-slate-800 border-none rounded-2xl p-6 text-slate-900 dark:text-white focus:ring-2 focus:ring-blue-500/20 transition-all font-black uppercase text-sm italic placeholder:opacity-30" placeholder="e.g. MacBook Pro M3">
                                    @error('name') <span class="text-rose-500 text-[10px] font-black uppercase tracking-widest mt-2 block">{{ $message }}</span> @enderror
                                </div>
                                
                                <div>
                                    <label class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.3em] mb-4 italic">Category</label>
                                    <div class="relative">
                                        <select wire:model="category_id" class="w-full bg-slate-50 dark:bg-slate-800 border-none rounded-2xl p-6 text-slate-900 dark:text-white focus:ring-2 focus:ring-blue-500/20 transition-all font-black uppercase text-[10px] tracking-widest appearance-none cursor-pointer italic">
                                            <option value="">Choose Category</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('category_id') <span class="text-rose-500 text-[10px] font-black uppercase tracking-widest mt-2 block">{{ $message }}</span> @enderror
                                </div>
                                
                                <div>
                                    <label class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.3em] mb-4 italic">Price ($)</label>
                                    <input type="number" step="0.01" wire:model="price" class="w-full bg-slate-50 dark:bg-slate-800 border-none rounded-2xl p-6 text-slate-900 dark:text-white focus:ring-2 focus:ring-blue-500/20 transition-all font-black text-sm italic placeholder:opacity-30" placeholder="0.00">
                                    @error('price') <span class="text-rose-500 text-[10px] font-black uppercase tracking-widest mt-2 block">{{ $message }}</span> @enderror
                                </div>

                                <div>
                                    <label class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.3em] mb-4 italic">Stock Quantity</label>
                                    <input type="number" wire:model="stock" class="w-full bg-slate-50 dark:bg-slate-800 border-none rounded-2xl p-6 text-slate-900 dark:text-white focus:ring-2 focus:ring-blue-500/20 transition-all font-black text-sm italic placeholder:opacity-30" placeholder="0">
                                    @error('stock') <span class="text-rose-500 text-[10px] font-black uppercase tracking-widest mt-2 block">{{ $message }}</span> @enderror
                                </div>

                                <div>
                                    <label class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.3em] mb-4 italic">Product Image</label>
                                    <div class="relative group h-full max-h-[72px]">
                                        <input type="file" wire:model="image" class="absolute inset-0 opacity-0 cursor-pointer z-10 w-full h-full">
                                        <div class="w-full h-full bg-slate-50 dark:bg-slate-800 border-2 border-dashed border-slate-200 dark:border-white/10 rounded-2xl flex items-center justify-center group-hover:bg-blue-600/5 group-hover:border-blue-600/30 transition-all px-6">
                                            <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest">{{ $image ? 'Ready' : 'Upload Image' }}</span>
                                        </div>
                                    </div>
                                    @error('image') <span class="text-rose-500 text-[10px] font-black uppercase tracking-widest mt-2 block">{{ $message }}</span> @enderror
                                </div>

                                <div class="col-span-2">
                                    <label class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.3em] mb-4 italic">Product Description</label>
                                    <textarea wire:model="description" rows="4" class="w-full bg-slate-50 dark:bg-slate-800 border-none rounded-[2.5rem] p-8 text-slate-900 dark:text-white focus:ring-2 focus:ring-blue-500/20 transition-all font-medium text-sm italic placeholder:opacity-30 resize-none" placeholder="Provide description..."></textarea>
                                    @error('description') <span class="text-rose-500 text-[10px] font-black uppercase tracking-widest mt-2 block">{{ $message }}</span> @enderror
                                </div>

                                <!-- VARIANTS SECTION -->
                                <div class="col-span-2 pt-8 border-t border-slate-100 dark:border-white/5">
                                    <div class="flex justify-between items-center mb-6">
                                        <div class="flex items-center gap-3">
                                            <div class="w-1.5 h-1.5 bg-blue-600 rounded-full"></div>
                                            <label class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.3em] italic">Product Variants</label>
                                        </div>
                                        <button type="button" wire:click="addVariant" class="px-5 py-3 bg-blue-50 dark:bg-blue-600/10 text-blue-600 border border-blue-100 dark:border-blue-600/20 rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-blue-600 hover:text-white transition-all shadow-lg shadow-blue-600/5 hover:shadow-blue-600/20 active:scale-95 italic">
                                            + Add Variant
                                        </button>
                                    </div>

                                    <div class="space-y-3 max-h-[400px] overflow-y-auto pr-2 custom-scrollbar">
                                        @foreach($variants as $index => $variant)
                                            <div class="grid grid-cols-12 gap-4 p-4 bg-slate-50 dark:bg-slate-800/50 border border-slate-100 dark:border-white/5 rounded-3xl items-center relative group transition-all hover:bg-white hover:shadow-xl dark:hover:bg-slate-800" wire:key="variant-field-{{ $index }}">
                                                
                                                <!-- Type -->
                                                <div class="col-span-3">
                                                    <label class="text-[9px] uppercase font-black text-slate-400 mb-2 block tracking-widest ml-1">Type</label>
                                                    <input type="text" wire:model="variants.{{ $index }}.type" class="w-full bg-white dark:bg-slate-900 border-none rounded-xl p-3 text-slate-900 dark:text-white focus:ring-2 focus:ring-blue-500/20 transition-all font-bold text-xs uppercase" placeholder="Color">
                                                </div>

                                                <!-- Value -->
                                                <div class="col-span-3">
                                                     <label class="text-[9px] uppercase font-black text-slate-400 mb-2 block tracking-widest ml-1">Value</label>
                                                     <input type="text" wire:model="variants.{{ $index }}.value" class="w-full bg-white dark:bg-slate-900 border-none rounded-xl p-3 text-slate-900 dark:text-white focus:ring-2 focus:ring-blue-500/20 transition-all font-bold text-xs uppercase" placeholder="Red">
                                                </div>

                                                 <!-- Price Mod -->
                                                 <div class="col-span-2">
                                                     <label class="text-[9px] uppercase font-black text-slate-400 mb-2 block tracking-widest ml-1">Extra $</label>
                                                     <input type="number" step="0.01" wire:model="variants.{{ $index }}.price_modifier" class="w-full bg-white dark:bg-slate-900 border-none rounded-xl p-3 text-slate-900 dark:text-white focus:ring-2 focus:ring-blue-500/20 transition-all font-bold text-xs">
                                                </div>

                                                 <!-- Stock -->
                                                 <div class="col-span-2">
                                                     <label class="text-[9px] uppercase font-black text-slate-400 mb-2 block tracking-widest ml-1">Stock</label>
                                                     <input type="number" wire:model="variants.{{ $index }}.stock" class="w-full bg-white dark:bg-slate-900 border-none rounded-xl p-3 text-slate-900 dark:text-white focus:ring-2 focus:ring-blue-500/20 transition-all font-bold text-xs">
                                                </div>
                                                
                                                <!-- Image Upload -->
                                                 <div class="col-span-1">
                                                     <label class="text-[9px] uppercase font-black text-slate-400 mb-2 block tracking-widest ml-1">Img</label>
                                                     <div class="relative w-10 h-10 overflow-hidden rounded-xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-white/10 group-hover:border-blue-500 transition-colors">
                                                         @if(isset($variants[$index]['new_image']) && $variants[$index]['new_image'])
                                                            <img src="{{ $variants[$index]['new_image']->temporaryUrl() }}" class="w-full h-full object-cover">
                                                         @elseif(isset($variants[$index]['image_path']))
                                                             @php
                                                                 try {
                                                                     $vImageUrl = str_starts_with($variants[$index]['image_path'], 'http') 
                                                                        ? $variants[$index]['image_path'] 
                                                                        : \Illuminate\Support\Facades\Storage::url($variants[$index]['image_path']);
                                                                 } catch (\Exception $e) {
                                                                     $vImageUrl = 'https://placehold.co/50x50?text=x';
                                                                 }
                                                             @endphp
                                                             <img src="{{ $vImageUrl }}" class="w-full h-full object-cover">
                                                         @else
                                                             <div class="w-full h-full flex items-center justify-center text-slate-300 text-[8px] font-black">+</div>
                                                         @endif
                                                         <input type="file" wire:model="variants.{{ $index }}.new_image" class="absolute inset-0 opacity-0 cursor-pointer z-10" title="Upload Variant Image">
                                                     </div>
                                                </div>

                                                 <div class="col-span-1 flex justify-end">
                                                     <button type="button" wire:click="removeVariant({{ $index }})" class="p-2 text-slate-300 hover:text-rose-500 transition-colors hover:bg-rose-50 rounded-lg"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg></button>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    @error('variants.*.type') <span class="text-rose-500 text-[10px] font-black uppercase tracking-widest mt-2 block">All variants must have a type.</span> @enderror
                                </div>
                            </div>

                            <div class="flex flex-col sm:row items-center gap-6 pt-10">
                                <button type="submit" class="group relative flex-1 w-full px-12 py-7 bg-blue-600 hover:bg-blue-700 text-white rounded-[2.5rem] font-black text-xs uppercase tracking-[0.4em] shadow-2xl shadow-blue-600/20 transition-all active:scale-95 overflow-hidden">
                                    <span class="relative z-10">{{ $isEdit ? 'Save Changes' : 'Add Product' }}</span>
                                    <div class="absolute inset-0 bg-gradient-to-r from-blue-400/20 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
                                </button>
                                <button type="button" wire:click="closeModal" class="px-10 py-7 text-slate-400 hover:text-rose-500 font-black text-[10px] uppercase tracking-[0.4em] transition-colors italic">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
