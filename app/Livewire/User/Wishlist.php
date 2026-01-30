<?php

namespace App\Livewire\User;

use Livewire\Component;

class Wishlist extends Component
{
    public function removeFromWishlist($wishlistId)
    {
        \App\Models\Wishlist::where('id', $wishlistId)
            ->where('user_id', \Illuminate\Support\Facades\Auth::id())
            ->delete();
    }

    public function render()
    {
        return view('livewire.user.wishlist', [
            'wishlistItems' => \App\Models\Wishlist::where('user_id', \Illuminate\Support\Facades\Auth::id())
                ->with('product')
                ->latest()
                ->get()
        ])->layout('layouts.app');
    }
}
