<div class="space-y-12">
    <div>
        <h2 class="text-4xl font-black text-slate-900 dark:text-white uppercase italic tracking-tighter mb-8">Customer Reviews</h2>
        
        <!-- Review Form -->
        <div class="bg-white dark:bg-slate-900 border border-slate-100 dark:border-white/5 rounded-3xl p-8 mb-12 shadow-sm">
            @auth
                <h3 class="text-lg font-black text-slate-900 dark:text-white uppercase tracking-tight mb-6">Write a Review</h3>
                <form wire:submit.prevent="submitReview" class="space-y-6">
                    <div>
                        <label class="block text-slate-400 dark:text-slate-500 text-[10px] font-black uppercase tracking-widest mb-2">Rating</label>
                        <div class="flex gap-2">
                            @foreach(range(1, 5) as $i)
                                <button type="button" wire:click="$set('rating', {{ $i }})" class="focus:outline-none">
                                    <svg class="w-8 h-8 {{ $rating >= $i ? 'text-yellow-400 fill-yellow-400' : 'text-slate-300 dark:text-slate-700' }} transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                    </svg>
                                </button>
                            @endforeach
                        </div>
                        @error('rating') <span class="text-rose-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-slate-400 dark:text-slate-500 text-[10px] font-black uppercase tracking-widest mb-2">Review</label>
                        <textarea wire:model="comment" rows="4" class="w-full bg-slate-50 dark:bg-slate-800 border-0 rounded-xl focus:ring-2 focus:ring-blue-600 text-slate-900 dark:text-white placeholder-slate-400" placeholder="Share your experience..."></textarea>
                        @error('comment') <span class="text-rose-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <button type="submit" class="px-8 py-4 bg-blue-600 text-white rounded-xl font-black text-xs uppercase tracking-widest hover:bg-blue-700 transition-colors shadow-lg shadow-blue-600/20">
                        Post Review
                    </button>

                    @if (session()->has('message'))
                        <div class="mt-4 text-green-500 text-sm font-bold">
                            {{ session('message') }}
                        </div>
                    @endif
                </form>
            @else
                <div class="text-center py-8">
                    <p class="text-slate-500 dark:text-slate-400 italic mb-4">Please log in to submit a review.</p>
                    <a href="{{ route('login') }}" class="inline-block px-8 py-3 bg-blue-600 text-white rounded-xl font-black text-xs uppercase tracking-widest hover:bg-blue-700 transition-colors">Log In</a>
                </div>
            @endauth
        </div>

        <!-- Reviews List -->
        <div class="space-y-8">
            @forelse($reviews as $review)
                <div class="flex gap-4 p-6 bg-slate-50 dark:bg-slate-900/50 rounded-3xl">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900/30 rounded-full flex items-center justify-center text-blue-600 font-black">
                            {{ substr($review->user->name, 0, 1) }}
                        </div>
                    </div>
                    <div>
                        <div class="flex items-center gap-2 mb-1">
                            <h4 class="font-black text-slate-900 dark:text-white">{{ $review->user->name }}</h4>
                            <span class="text-xs text-slate-400">•</span>
                            <span class="text-xs text-slate-400">{{ $review->created_at->diffForHumans() }}</span>
                        </div>
                        <div class="flex text-yellow-400 mb-3">
                            @for($i = 1; $i <= 5; $i++)
                                <svg class="w-4 h-4 {{ $i <= $review->rating ? 'fill-current' : 'text-slate-300 dark:text-slate-700' }}" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                            @endfor
                        </div>
                        <p class="text-slate-600 dark:text-slate-300 leading-relaxed">{{ $review->comment }}</p>
                    </div>
                </div>
            @empty
                <div class="text-center py-12 text-slate-400 dark:text-slate-500 italic">
                    No reviews yet. Be the first to share your thoughts!
                </div>
            @endforelse
        </div>
    </div>
</div>
