<div class="pt-32 pb-24 bg-slate-50 dark:bg-slate-950 min-h-screen transition-colors duration-500">
    <div class="max-w-[1600px] mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Dashboard Header -->
        <div class="mb-12 flex flex-col md:flex-row md:items-end justify-between gap-8">
            <div class="space-y-4">
                <div class="flex items-center gap-4">
                    <div class="w-2 h-10 bg-blue-600 rounded-full"></div>
                    <h1 class="text-5xl font-['Outfit'] font-black text-slate-900 dark:text-white uppercase italic tracking-tighter">Admin Dashboard</h1>
                </div>
                <p class="text-slate-500 dark:text-slate-400 font-medium italic">Overview of your store's performance and management.</p>
            </div>
            
            <!-- Quick Actions / Tabs -->
            <div class="flex bg-white dark:bg-slate-900 p-2 rounded-[2rem] border border-slate-100 dark:border-white/5 shadow-sm">
                @foreach(['stats' => 'Dashboard', 'users' => 'Users', 'transactions' => 'Orders'] as $tab => $label)
                    <button wire:click="setTab('{{ $tab }}')" 
                            class="px-8 py-3 rounded-full text-[10px] font-black uppercase tracking-widest transition-all {{ $activeTab === $tab ? 'bg-blue-600 text-white shadow-lg shadow-blue-600/20' : 'text-slate-400 hover:text-blue-600' }}">
                        {{ $label }}
                    </button>
                @endforeach
                <a href="{{ route('admin.products') }}" class="px-8 py-3 rounded-full text-[10px] font-black uppercase tracking-widest text-slate-400 hover:text-blue-600 transition-all">
                    Products
                </a>
            </div>
        </div>

        @if($activeTab === 'stats')
            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-16">
                @foreach([
                    ['Total Revenue', '$' . number_format($stats['total_sales'], 2), 'dollar-sign', 'text-emerald-500'],
                    ['Orders', $stats['total_orders'], 'package', 'text-blue-500'],
                    ['Users', $stats['total_users'], 'users', 'text-indigo-500'],
                    ['Products', $stats['total_products'], 'layout-grid', 'text-amber-500']
                ] as $stat)
                    @if($stat[0] === 'Total Revenue')
                        <div class="bg-white dark:bg-slate-900 p-10 rounded-[3rem] border border-slate-100 dark:border-white/5 shadow-premium hover:shadow-2xl transition-all group">
                            <div class="flex justify-between items-start mb-6">
                                <div class="group-hover:scale-110 transition-transform">
                                    <i data-lucide="dollar-sign" class="w-10 h-10 text-emerald-500"></i>
                                </div>
                                <div class="text-[10px] font-black uppercase tracking-widest text-emerald-500">Live Feedback</div>
                            </div>
                            <h3 class="text-4xl font-['Outfit'] font-black text-slate-950 dark:text-white tracking-tighter mb-1">${{ number_format($stats['total_sales'], 2) }}</h3>
                            <div class="flex items-center justify-between">
                                <p class="text-[10px] font-black uppercase tracking-[0.2em] text-emerald-500">Total Generated</p>
                                <span class="text-[9px] font-bold text-slate-400">Confirmed: ${{ number_format($stats['confirmed_sales'], 2) }}</span>
                            </div>
                        </div>
                    @else
                        <div class="bg-white dark:bg-slate-900 p-10 rounded-[3rem] border border-slate-100 dark:border-white/5 shadow-premium hover:shadow-2xl transition-all group">
                            <div class="flex justify-between items-start mb-6">
                                <div class="group-hover:scale-110 transition-transform">
                                    <i data-lucide="{{ $stat[2] }}" class="w-10 h-10 {{ $stat[3] }}"></i>
                                </div>
                                <div class="text-[10px] font-black uppercase tracking-widest text-slate-400">Live Feedback</div>
                            </div>
                            <h3 class="text-4xl font-['Outfit'] font-black text-slate-950 dark:text-white tracking-tighter mb-1">{{ $stat[1] }}</h3>
                            <p class="text-[10px] font-black uppercase tracking-[0.2em] {{ $stat[3] }}">{{ $stat[0] }}</p>
                        </div>
                    @endif
                @endforeach
            </div>

            <div class="grid lg:grid-cols-2 gap-12">
                <!-- Recent Transactions -->
                <div class="bg-white dark:bg-slate-900 rounded-[3rem] border border-slate-100 dark:border-white/5 shadow-xl overflow-hidden p-10">
                    <div class="flex items-center justify-between mb-10">
                        <h4 class="text-2xl font-['Outfit'] font-black uppercase italic tracking-tighter text-slate-950 dark:text-white">Recent Orders</h4>
                        <button wire:click="setTab('transactions')" class="text-[10px] font-black text-blue-600 uppercase tracking-widest border-b-2 border-blue-600/20 pb-1">View All</button>
                    </div>
                    <div class="space-y-6">
                        @foreach($recent_orders as $order)
                            <div class="flex items-center justify-between p-6 bg-slate-50 dark:bg-slate-800/50 rounded-2xl border border-transparent hover:border-blue-600/10 hover:bg-white dark:hover:bg-slate-800 transition-all group">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 bg-white dark:bg-slate-900 border border-slate-100 dark:border-white/5 rounded-xl flex items-center justify-center font-black text-xs text-slate-400 group-hover:text-blue-600 transition-colors">#{{ $order->id }}</div>
                                    <div>
                                        <p class="text-sm font-black text-slate-900 dark:text-white uppercase tracking-tight">{{ $order->user->name }}</p>
                                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">{{ $order->created_at->format('M d, Y') }}</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="text-lg font-black text-slate-900 dark:text-white leading-none">${{ number_format($order->total_amount, 2) }}</p>
                                    <span class="text-[8px] font-black uppercase tracking-[0.2em] {{ $order->status === 'completed' ? 'text-emerald-500' : 'text-amber-500' }}">{{ $order->status }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Recent Users -->
                <div class="bg-white dark:bg-slate-900 rounded-[3rem] border border-slate-100 dark:border-white/5 shadow-xl overflow-hidden p-10">
                    <div class="flex items-center justify-between mb-10">
                        <h4 class="text-2xl font-['Outfit'] font-black uppercase italic tracking-tighter text-slate-950 dark:text-white">Recent Users</h4>
                        <button wire:click="setTab('users')" class="text-[10px] font-black text-blue-600 uppercase tracking-widest border-b-2 border-blue-600/20 pb-1">Manage Users</button>
                    </div>
                    <div class="space-y-6">
                        @foreach($recent_users as $user)
                            <div class="flex items-center justify-between p-6 bg-slate-50 dark:bg-slate-800/50 rounded-2xl">
                                <div class="flex items-center gap-4">
                                    <img src="{{ $user->profile_photo_url }}" class="w-10 h-10 rounded-full border-2 border-white dark:border-slate-700 shadow-sm">
                                    <div>
                                        <p class="text-sm font-black text-slate-900 dark:text-white uppercase tracking-tight">{{ $user->name }}</p>
                                        <p class="text-[10px] font-bold text-slate-400 lowercase tracking-widest opacity-60">{{ $user->email }}</p>
                                    </div>
                                </div>
                                <span class="text-[9px] font-black uppercase tracking-[0.3em] px-3 py-1 bg-white dark:bg-slate-900 rounded-lg text-slate-400">{{ $user->role }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

        @if($activeTab === 'users')
            <!-- All Users Table -->
            <div class="bg-white dark:bg-slate-900 rounded-[3rem] border border-slate-100 dark:border-white/5 shadow-2xl overflow-hidden">
                <div class="p-10 border-b border-slate-50 dark:border-slate-800">
                    <h4 class="text-2xl font-['Outfit'] font-black uppercase italic tracking-tighter text-slate-950 dark:text-white">User Management</h4>
                </div>

                @if (session()->has('message'))
                    <div class="m-10 p-6 bg-emerald-50 dark:bg-emerald-600/10 text-emerald-600 rounded-2xl font-black text-[10px] uppercase tracking-widest border border-emerald-100 dark:border-emerald-600/20 italic animate-blur-in">
                        {{ session('message') }}
                    </div>
                @endif

                @if (session()->has('error'))
                    <div class="m-10 p-6 bg-rose-50 dark:bg-rose-600/10 text-rose-500 rounded-2xl font-black text-[10px] uppercase tracking-widest border border-rose-100 dark:border-rose-600/20 italic animate-blur-in">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="bg-slate-50 dark:bg-slate-800/30 text-[10px] font-black uppercase tracking-[0.3em] text-slate-400">
                                <th class="px-10 py-6">User</th>
                                <th class="px-10 py-6">Contact Info</th>
                                <th class="px-10 py-6">Role</th>
                                <th class="px-10 py-6">Joined Date</th>
                                <th class="px-10 py-6">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50 dark:divide-slate-800">
                            @foreach($users_list as $user)
                                <tr class="group hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors">
                                    <td class="px-10 py-8">
                                        <div class="flex items-center gap-4">
                                            <div class="w-12 h-12 rounded-2xl bg-slate-100 dark:bg-slate-800 flex items-center justify-center font-black uppercase italic text-slate-400 group-hover:text-blue-600 transition-colors shadow-inner overflow-hidden">
                                                <img src="{{ $user->profile_photo_url }}" alt="" class="w-full h-full object-cover">
                                            </div>
                                            <div>
                                                <p class="text-lg font-black text-slate-900 dark:text-white uppercase italic tracking-tight leading-none">{{ $user->name }}</p>
                                                <p class="text-[9px] font-bold text-slate-400 mt-2 uppercase tracking-widest">ID: #{{ $user->id }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-10 py-8">
                                        <p class="text-sm font-bold text-slate-600 dark:text-slate-400 lowercase tracking-tight">{{ $user->email }}</p>
                                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1 italic">{{ $user->phone ?: 'No Link Established' }}</p>
                                    </td>
                                    <td class="px-10 py-8">
                                        <span class="px-4 py-1.5 rounded-xl text-[10px] font-black uppercase tracking-[0.2em] {{ $user->isAdmin() ? 'bg-blue-600 text-white' : 'bg-slate-100 dark:bg-slate-800 text-slate-500' }}">
                                            {{ $user->role }}
                                        </span>
                                    </td>
                                    <td class="px-10 py-8 text-sm font-bold text-slate-500 italic">
                                        {{ $user->created_at->format('M d, Y') }}
                                    </td>
                                    <td class="px-10 py-8">
                                        <button 
                                            wire:click="confirmUserDeletion({{ $user->id }}, '{{ $user->name }}')" 
                                            class="text-[10px] font-black uppercase tracking-widest text-slate-400 hover:text-rose-500 transition-colors bg-slate-50 dark:bg-slate-800/50 px-5 py-2.5 rounded-xl border border-transparent hover:border-rose-500/20"
                                        >
                                            Purge Account
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="p-10 border-t border-slate-50 dark:border-slate-800">
                    {{ $users_list->links() }}
                </div>
            </div>

            <!-- Premium Custom Confirmation Modal -->
            @if($confirmingUserDeletion)
                <div class="fixed inset-0 z-[100] flex items-center justify-center px-4 overflow-hidden">
                    <!-- Backdrop -->
                    <div class="absolute inset-0 bg-slate-950/40 backdrop-blur-xl animate-fade-in" wire:click="cancelUserDeletion"></div>
                    
                    <!-- Modal Content -->
                    <div class="relative w-full max-w-lg bg-white dark:bg-slate-900 rounded-[3rem] border border-slate-100 dark:border-white/5 shadow-2xl overflow-hidden animate-zoom-in">
                        <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-rose-500 to-rose-600"></div>
                        
                        <div class="p-12 space-y-8">
                            <div class="flex items-center gap-6">
                                <div class="w-16 h-16 bg-rose-50 dark:bg-rose-950/30 rounded-2xl flex items-center justify-center shrink-0">
                                    <svg class="w-8 h-8 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
                                </div>
                                <div>
                                    <h4 class="text-3xl font-['Outfit'] font-black uppercase italic tracking-tighter text-slate-950 dark:text-white leading-none">Critical Purge</h4>
                                    <p class="text-[10px] font-black uppercase tracking-widest text-rose-500 mt-2">Database Integrity Protocol</p>
                                </div>
                            </div>

                            <div class="space-y-4">
                                <p class="text-slate-600 dark:text-slate-400 font-bold italic text-sm leading-relaxed">
                                    Are you absolutely sure you want to permanently erase <span class="text-slate-950 dark:text-white font-black underline decoration-rose-500/30 underline-offset-4">{{ $userToDeleteName }}</span>?
                                </p>
                                <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wide bg-slate-50 dark:bg-slate-800/50 p-6 rounded-2xl border border-slate-100 dark:border-white/5">
                                    This action will <span class="text-rose-500">destroy</span> their account profile, login credentials, and their <span class="text-rose-500 italic">entire shopping & order history</span>. This operation is non-reversible.
                                </p>
                            </div>

                            <div class="flex items-center gap-4 pt-4">
                                <button wire:click="cancelUserDeletion" class="flex-1 px-8 py-5 bg-slate-50 dark:bg-slate-800 text-slate-500 font-black text-[10px] uppercase tracking-[0.2em] rounded-2xl hover:bg-slate-100 dark:hover:bg-slate-700 transition-all italic">
                                    Abort
                                </button>
                                <button wire:click="deleteUser" class="flex-[2] px-8 py-5 bg-rose-600 text-white font-black text-[10px] uppercase tracking-[0.2em] rounded-2xl shadow-xl shadow-rose-600/20 hover:bg-rose-700 transition-all hover:scale-105 active:scale-95 italic text-center">
                                    Confirm Purge
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endif

        @if($activeTab === 'transactions')
            <!-- Transactions Table -->
            <div class="bg-white dark:bg-slate-900 rounded-[3rem] border border-slate-100 dark:border-white/5 shadow-2xl overflow-hidden">
                <div class="p-10 border-b border-slate-50 dark:border-slate-800">
                    <h4 class="text-2xl font-['Outfit'] font-black uppercase italic tracking-tighter text-slate-950 dark:text-white">Order History</h4>
                </div>

                @if (session()->has('message'))
                    <div class="m-10 p-6 bg-emerald-50 dark:bg-emerald-600/10 text-emerald-600 rounded-2xl font-black text-[10px] uppercase tracking-widest border border-emerald-100 dark:border-emerald-600/20 italic animate-blur-in">
                        {{ session('message') }}
                    </div>
                @endif

                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="bg-slate-50 dark:bg-slate-800/30 text-[10px] font-black uppercase tracking-[0.3em] text-slate-400">
                                <th class="px-10 py-6">Order ID</th>
                                <th class="px-10 py-6">Customer</th>
                                <th class="px-10 py-6">Total Amount</th>
                                <th class="px-10 py-6">Status</th>
                                <th class="px-10 py-6">Date</th>
                                <th class="px-10 py-6">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50 dark:divide-slate-800">
                            @foreach($orders_list as $order)
                                <tr class="group hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors">
                                    <td class="px-10 py-8">
                                        <span class="text-lg font-black text-slate-900 dark:text-white group-hover:text-blue-600 transition-colors tracking-tighter">#{{ $order->id }}</span>
                                    </td>
                                    <td class="px-10 py-8">
                                        <div class="flex items-center gap-3">
                                            <p class="text-sm font-black text-slate-900 dark:text-white uppercase italic tracking-tight">{{ $order->user->name }}</p>
                                        </div>
                                    </td>
                                    <td class="px-10 py-8">
                                        <p class="text-xl font-['Outfit'] font-black text-slate-950 dark:text-white tracking-tighter">${{ number_format($order->total_amount, 2) }}</p>
                                    </td>
                                    <td class="px-10 py-8">
                                        <span class="px-4 py-1.5 rounded-xl text-[9px] font-black uppercase tracking-[0.2em] {{ $order->status === 'completed' ? 'bg-emerald-50 text-emerald-600' : ($order->status === 'cancelled' ? 'bg-rose-50 text-rose-600' : 'bg-amber-50 text-amber-600') }}">
                                            {{ $order->status }}
                                        </span>
                                    </td>
                                    <td class="px-10 py-8 text-sm font-bold text-slate-500 italic">
                                        {{ $order->created_at->format('M d, Y H:i') }}
                                    </td>
                                    <td class="px-10 py-8">
                                        <div class="flex items-center gap-2">
                                            @if($order->status !== 'completed')
                                                <button wire:click="updateOrderStatus({{ $order->id }}, 'completed')" class="p-2.5 bg-emerald-50 dark:bg-emerald-600/10 text-emerald-600 rounded-xl hover:bg-emerald-100 transition-all border border-transparent hover:border-emerald-200" title="Mark as Completed">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                                </button>
                                            @endif
                                            
                                            @if($order->status !== 'cancelled')
                                                <button wire:click="updateOrderStatus({{ $order->id }}, 'cancelled')" class="p-2.5 bg-rose-50 dark:bg-rose-600/10 text-rose-600 rounded-xl hover:bg-rose-100 transition-all border border-transparent hover:border-rose-200" title="Cancel Order">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                                                </button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="p-10 border-t border-slate-50 dark:border-slate-800">
                    {{ $orders_list->links() }}
                </div>
            </div>
        @endif
    </div>
</div>
