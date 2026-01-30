<?php

namespace App\Livewire;

use Livewire\Component;

class ProductReviews extends Component
{
    public $product;
    public $rating = 5;
    public $comment = '';

    protected $rules = [
        'rating' => 'required|integer|min:1|max:5',
        'comment' => 'required|string|min:5|max:500',
    ];

    public function mount($product)
    {
        $this->product = $product;
    }

    public function submitReview()
    {
        if (!\Illuminate\Support\Facades\Auth::check()) {
            return redirect()->route('login');
        }

        $this->validate();

        \App\Models\Review::create([
            'user_id' => \Illuminate\Support\Facades\Auth::id(),
            'product_id' => $this->product->id,
            'rating' => $this->rating,
            'comment' => $this->comment,
        ]);

        $this->reset(['rating', 'comment']);
        session()->flash('message', 'Review submitted successfully!');
    }

    public function render()
    {
        return view('livewire.product-reviews', [
            'reviews' => $this->product->reviews()->with('user')->latest()->get()
        ]);
    }
}
